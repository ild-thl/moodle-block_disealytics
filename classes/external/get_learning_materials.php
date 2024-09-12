<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Web service to get a list of learning materials for the course.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_disealytics\external;

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once($CFG->libdir . '/externallib.php');

use context_course;
use dml_exception;
use external_api;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;
use invalid_parameter_exception;
use moodle_database;
use required_capability_exception;
use restricted_context_exception;
use stdClass;

/**
 * Class get_learning_materials
 */
class get_learning_materials extends external_api {

    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
                'courseid' => new external_value(PARAM_INT, 'Course ID', VALUE_OPTIONAL),
        ]);
    }

    /**
     * @throws restricted_context_exception
     * @throws dml_exception
     * @throws \moodle_exception
     * @throws invalid_parameter_exception
     * @throws required_capability_exception
     */
    public static function execute($courseid = null): array {
        global $DB, $USER, $COURSE;

        // Security checks.
        $courseid = $courseid ?? $COURSE->id;
        $context = context_course::instance($courseid);
        self::validate_context($context);
        require_capability('block/disealytics:editlearnerdashboard', $context);

        // Fetch learning materials.
        $learningMaterialsData = $DB->get_records(
                'block_disealytics_user_pages',
                ['userid' => $USER->id, 'courseid' => $courseid]
        );

        $modinfo = get_fast_modinfo($COURSE);
        $cms = $modinfo->get_cms();
        $filescount = 0;
        $filenames = [];
        foreach ($cms as $cm) {
            if ($cm->visible && !$cm->deletioninprogress) {
                switch ($cm->modname) {
                    case "resource":
                    case "page":
                    case "url":
                        if (!self::check_name_exists($cm->name, $learningMaterialsData)) {
                            $addfile = new stdClass();
                            $addfile->name = $cm->name;
                            $filenames[] = $addfile;
                        }
                        $filescount++;
                        break;
                    case "folder":
                        // Gets the context associated with the folder ($cm->id == folder.instanceid).
                        // Sometimes more than one context is associated with the instanceid,
                        // therefore we need to get all the records.
                        $possiblecontexts = $DB->get_records("context", ["instanceid" => $cm->id]);
                        foreach ($possiblecontexts as $foldercontext) {
                            // Gets files stored in that context.
                            $foldercontents = $DB->get_records("files", ["contextid" => $foldercontext->id]);
                            foreach ($foldercontents as $file) {
                                if ($file->filename != ".") {
                                    $addfile = new stdClass();
                                    $addfile->name = $cm->name . $file->filepath . $file->filename;
                                    $filenames[] = $addfile;
                                    $filescount++;
                                }
                            }
                        }
                        break;
                    default:
                }
            }
        }

        $learningMaterials = [];

        if (!empty($learningMaterialsData)) {
            foreach ($learningMaterialsData as $lm) {
                $learningMaterials[] = [
                        'learningmaterialid' => $lm->id,
                        'documentname' => $lm->name,
                        'currentpage' => $lm->currentpage,
                        'lastpage' => $lm->lastpage,
                        'expenditureoftime' => $lm->expenditureoftime,
                ];
            }
        }

        return [
                'file_names' => $filenames,
                'files_left' => ($filescount > count($learningMaterials)),
                'data' => $learningMaterials,
                'number_of_documents' => $filescount,
                'nodata' => empty($learningMaterials),
        ];

    }

    /**
     * Checks if name exists.
     *
     * @param string $name
     * @param array $array
     * @return bool
     */
    private static function check_name_exists(string $name, array $array): bool {
        foreach ($array as $obj) {
            if ($name === $obj->name) {
                return true;
            }
        }
        return false;
    }

    /**
     * Describes the return structure of the service
     *
     * @return external_single_structure The structure of the returned data.
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
                'file_names' => new external_multiple_structure(
                        new external_single_structure([
                                'name' => new external_value(PARAM_TEXT, 'Name of the file')
                        ])
                ),
                'files_left' => new external_value(PARAM_BOOL, 'Files left flag'),
                'data' => new external_multiple_structure(
                        new external_single_structure([
                                'learningmaterialid' => new external_value(PARAM_INT, 'ID of the learning material'),
                                'documentname' => new external_value(PARAM_TEXT, 'Name of the document'),
                                'currentpage' => new external_value(PARAM_INT, 'Current page of the document'),
                                'lastpage' => new external_value(PARAM_INT, 'Last page of the document'),
                                'expenditureoftime' => new external_value(PARAM_INT, 'Time spent on the document')
                        ])
                ),
                'number_of_documents' => new external_value(PARAM_INT, 'Number of documents'),
                'nodata' => new external_value(PARAM_BOOL, 'No data flag')
        ]);
    }

}
