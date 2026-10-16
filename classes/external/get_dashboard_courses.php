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
 * Web service to get a list of courses the dashboard is active in.
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
use moodle_exception;
use required_capability_exception;
use restricted_context_exception;

/**
 * Class get_dashboard_courses
 */
class get_dashboard_courses extends external_api {

    /**
     * Describes the parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    /**
     * Returns a list of courses the dashboard is active in.
     *
     * @return array
     * @throws \core_external\restricted_context_exception
     * @throws dml_exception
     * @throws invalid_parameter_exception
     */
    public static function execute(): array {
        global $DB;

        // Security checks.

        self::validate_context(\context_system::instance());

        $ids = $DB->get_fieldset_sql("SELECT DISTINCT ctx.instanceid
                FROM {block_instances} bi
                JOIN {context} ctx ON ctx.id = bi.parentcontextid
                WHERE bi.blockname = :name AND ctx.contextlevel = :level",
                ['name' => 'disealytics', 'level' => CONTEXT_COURSE]
        );

        return array_map('intval', $ids);

    }

    /**
     * Describes the return structure of the service
     *
     * @return external_multiple_structure The structure of the returned data.
     */
    public static function execute_returns(): external_multiple_structure {

        return new external_multiple_structure(
                new external_value(PARAM_INT, 'Course id')
        );
    }

}
