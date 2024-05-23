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
 * Settings for block_disealytics database tables.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Installs the database tables.
 * @return void
 * @throws dml_exception
 * @throws dml_transaction_exception
 * @throws ddl_exception|coding_exception
 */
function xmldb_block_disealytics_install(): void {
    global $DB;
    $tables = [
            "disea_consent_all" => "block_disealytics_consent",
            "block_learningdashboard_goal" => "block_disealytics_user_goals",
            "block_learningdashboard_opin" => "block_disealytics_user_pages",
            "block_my_consent_block_tasks" => "block_disealytics_user_tasks",
    ];

    foreach ($tables as $from => $to) {
        $dbman = $DB->get_manager();
        if ($dbman->table_exists($from) && $dbman->table_exists($to)) {
            $transaction = $DB->start_delegated_transaction();
            $data = $DB->get_records($from);
            if ($data && count($data) > 0) {
                $DB->insert_records($to, $data);
            }
            $transaction->allow_commit();
        }
    }
    $transaction = $DB->start_delegated_transaction();
    $data = $DB->get_records_select('user_preferences', "name LIKE '%block_learningdashboard%'");
    if ($data && count($data) > 0) {
        foreach ($data as $pref) {
            $pref->name = str_replace('learningdashboard', 'disealytics', $pref->name);
        }
        $DB->insert_records('user_preferences', $data);
    }
    $transaction->allow_commit();
}
