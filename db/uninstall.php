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
 * Settings for block_disealytics database uninstalls.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Uninstall database tables.
 *
 * @throws dml_exception
 * @throws coding_exception
 */
function xmldb_block_disealytics_uninstall(): void {
    global $DB;
    $prefs = $DB->get_records_sql("SELECT id, name, userid FROM mdl_user_preferences WHERE name LIKE '%block_disealytics%'");
    foreach ($prefs as $pref) {
        unset_user_preference($pref->name, $pref->userid);
    }
}
