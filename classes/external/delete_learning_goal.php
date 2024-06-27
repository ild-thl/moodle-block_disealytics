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
 * Web service to delete a learning goal.
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
use block_disealytics\learningdata;
use external_api;
use external_function_parameters;
use external_value;
use invalid_parameter_exception;
use required_capability_exception;
use restricted_context_exception;

/**
 * Class delete_learning_goal
 */
class delete_learning_goal extends external_api {
    /**
     * Describes the parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'goalid' => new external_value(
                PARAM_RAW,
                'Goal id',
                VALUE_REQUIRED
            ),
        ]);
    }

    /**
     * Executes the service.
     *
     *
     * @param string $goalid the goal ID
     * @return string $result
     * @throws invalid_parameter_exception|dml_exception
     * @throws restricted_context_exception
     * @throws required_capability_exception
     */
    public static function execute(string $goalid): string {
        global $CFG, $COURSE;
        self::validate_parameters(self::execute_parameters(), ['goalid' => $goalid]);
        require_once($CFG->dirroot . '/blocks/disealytics/classes/learningdata.php');

        // Security checks.
        $context = context_course::instance($COURSE->id);
        self::validate_context($context);
        require_capability('block/disealytics:editlearningdashboard', $context);

        learningdata::delete_goal($goalid);
        return 'Goal ID: ' . $goalid . ' deleted.';
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
