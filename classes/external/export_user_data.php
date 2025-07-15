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
 * Web service to export all goal data of current user.
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
use core_external\restricted_context_exception;
use external_api;
use external_function_parameters;
use external_value;
use invalid_parameter_exception;
use required_capability_exception;

/**
 *
 */
class export_user_data extends external_api {
    /**
     * Executes the service.
     *
     *
     * @return string $result
     * @throws invalid_parameter_exception|dml_exception
     * @throws restricted_context_exception
     * @throws required_capability_exception
     */
    public static function execute(string $type): string {
        global $CFG, $COURSE, $DB, $USER;
        self::validate_parameters(self::execute_parameters(), ['type' => $type]);
        require_once($CFG->dirroot . '/blocks/disealytics/classes/learningdata.php');

        // Security checks.
        $context = context_course::instance($COURSE->id);
        self::validate_context($context);
        require_capability('block/disealytics:editlearnerdashboard', $context);
        $data = $DB->get_records("block_disealytics_user_$type", ['userid' => $USER->id]);
        foreach ($data as $entry) {
            if ($entry->courseid) {
                $entry->coursename = get_course($entry->courseid)->fullname;
            } else {
                $entry->fromcoursename = "";
            }
            $entry->courseid = 'COURSEID';
            $entry->userid = 'USERID';
            $entry->usermodified = 'USERID';
        }
        return json_encode($data);
    }

    /**
     * Describes the parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
                'type' => new external_value(
                        PARAM_ALPHA,
                        'type of data to export',
                        VALUE_REQUIRED
                ),
        ]);
    }

    /**
     * Describes the return structure of the service
     *
     * @return external_value jsonobj
     */
    public static function execute_returns(): external_value {
        return new external_value(PARAM_RAW);
    }
}
