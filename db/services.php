<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Service to load the web services.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

$functions = [
        'block_disealytics_refresh_view' => [
                'classname' => 'block_disealytics\external\refresh_view',
                'methodname' => 'execute',
                'description' => 'Refresh the view/plugin',
                'type' => 'read',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_write_user_preference' => [
                'classname' => 'block_disealytics\external\write_user_preference',
                'methodname' => 'execute',
                'description' => 'Toggle the user preferences of the plugin',
                'type' => 'read',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_add_learning_goal' => [
                'classname' => 'block_disealytics\external\add_learning_goal',
                'methodname' => 'execute',
                'description' => 'Add a description for a goal',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_update_learning_goal' => [
                'classname' => 'block_disealytics\external\update_learning_goal',
                'methodname' => 'execute',
                'description' => 'Update a description for a goal',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_delete_learning_goal' => [
                'classname' => 'block_disealytics\external\delete_learning_goal',
                'methodname' => 'execute',
                'description' => 'Deletes a goal',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_update_planner_event' => [
                'classname' => 'block_disealytics\external\update_planner_event',
                'methodname' => 'execute',
                'description' => 'Adds/deletes or updates a planner event/date',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_get_planner_event' => [
                'classname'   => 'block_disealytics\external\get_planner_event',
                'methodname'  => 'execute',
                'classpath'   => 'blocks/disealytics/classes/external/get_planner_event.php',
                'description' => 'Get an event from the planner',
                'type'        => 'read',
                'ajax'        => true,
                'loginrequired' => true,
        ],
        'block_disealytics_change_planner_view' => [
                'classname' => 'block_disealytics\external\change_planner_view',
                'methodname' => 'execute',
                'description' => 'Change the month display of planner',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_optional_input' => [
                'classname' => 'block_disealytics\external\optional_input',
                'methodname' => 'execute',
                'description' => 'Update optional inputs',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],
        'block_disealytics_modid_to_courseid' => [
                'classname' => 'block_disealytics\external\modid_to_courseid',
                'methodname' => 'execute',
                'description' => 'Get a course ID for a given CourseModuleID',
                'type' => 'read',
                'ajax' => true,
                'loginrequired' => true,
        ],

];
