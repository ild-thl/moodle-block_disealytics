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
 * Web service to get an event from the planner
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
use external_single_structure;
use external_value;
use invalid_parameter_exception;
use required_capability_exception;
use restricted_context_exception;
use stdClass;

/**
 * Class get_planner_event
 */
class get_planner_event extends external_api {
    /**
     * Describes the parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
                'dateid' => new external_value(
                        PARAM_INT,
                        'ID of a planner date (=event)',
                        VALUE_REQUIRED
                ),
        ]);
    }

    /**
     * Executes the web service to get an event from the planner.
     *
     * @param int $dateid The ID of the planner date (event).
     * @return stdClass|false The event record from the database, or false if not found.
     * @throws invalid_parameter_exception If the parameters are invalid.
     * @throws required_capability_exception If the user does not have the required capability.
     * @throws restricted_context_exception If the context is restricted.
     * @throws dml_exception If there is an error with the database query.
     */
    public static function execute(int $dateid) {
        // Validate the parameters.
        self::validate_parameters(self::execute_parameters(), [
                'dateid' => $dateid,
        ]);

        global $DB, $COURSE;

        // Security checks.
        $context = context_course::instance($COURSE->id);
        self::validate_context($context);
        require_capability('block/disealytics:editlearnerdashboard', $context);

        // Retrieve the event record from the database.
        $event = $DB->get_record('block_disealytics_user_dates', ['id' => $dateid]);

        // Retrieve the course information.
        $course = $DB->get_record('course', ['id' => $event->courseid], 'id, fullname');

        // Combine event and course data.
        $event->coursefullname = $course->fullname;

        return $event;
    }

    /**
     * Describes the return structure of the service
     *
     * @return external_single_structure The structure of the returned data.
     */
    public static function execute_returns(): external_single_structure {
        $fields = [
                'id' => PARAM_INT,
                'name' => PARAM_TEXT,
                'userid' => PARAM_INT,
                'courseid' => PARAM_INT,
                'usermodified' => PARAM_INT,
                'timecreated' => PARAM_INT,
                'timemodified' => PARAM_INT,
                'timestart' => PARAM_INT,
                'timeduration' => PARAM_INT,
                'location' => PARAM_TEXT,
                'eventtype' => PARAM_TEXT,
                'repeatid' => PARAM_INT,
                'coursefullname' => PARAM_TEXT,
        ];

        $structure = [];
        foreach ($fields as $field => $type) {
            $structure[$field] = new external_value($type, ucfirst($field) . ' of the event');
        }

        return new external_single_structure($structure);
    }
}
