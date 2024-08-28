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

namespace block_disealytics\task;

use ArrayIterator;
use coding_exception;
use core\task\scheduled_task;
use dml_exception;
use lang_string;
use stdClass;

/**
 * Version details.
 *
 * {statistics} class definition
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class statistics extends scheduled_task {

    /**
     * Get the name of the task.
     *
     * @throws coding_exception
     */
    public function get_name() {
        return get_string('task_statistics', 'block_disealytics');
    }

    /**
     * Execute the task.
     *
     * @return void
     * @throws dml_exception
     */
    public function execute(): void {

        $now = (new \DateTimeImmutable("now"))->format("U");

        global $DB;
        $stats = new stdClass();
        $get = $DB->start_delegated_transaction();
        $stats->instances = $DB->count_records_select("block_instances", "blockname = 'disealytics'");
        $stats->acceptancecount = $DB->count_records_select("block_disealytics_consent", "choice = 1");
        // Get all block_disealytics_view preferences of users that gave consent to use their data.
        $preferences = $DB->get_records_sql(
                "SELECT prefs.id, prefs.value
                       FROM {user_preferences} prefs
                       JOIN {block_disealytics_consent} consent ON prefs.userid = consent.userid
                      WHERE prefs.name = 'block_disealytics_views'
                            AND consent.choice = 1");
        $DB->commit_delegated_transaction($get);
        $preferences = array_map(function($pref) {
            return json_decode($pref->value, true);
        }, $preferences);
        global $CFG;
        $viewnames =
                array_map(fn($name) => str_replace('_', '', basename($name, '.php')),
                        glob($CFG->dirroot . '/blocks/disealytics/classes/view/*.php'));
        $viewnames = array_diff($viewnames, ["baseview"]);
        $viewcounts = array_fill_keys($viewnames, 0);
        $total = 0;
        foreach ($preferences as $viewsettings) {
            foreach ($viewsettings as $viewsetting) {
                $enabled = $viewsetting["enabled"];
                if ($enabled) {
                    $viewcounts[str_replace("-", "", $viewsetting["viewname"])] += $enabled;
                    $total += $enabled;
                }
            }
        }
        $stats->cardstotal = $total;
        array_walk($viewcounts, function($count, $key) use ($stats) {
            $newkey = str_replace('-', "", $key);
            $stats->$newkey = $count;
        });
        $stats->timecreated = $now;
        $DB->insert_record("block_disealytics_statistics", $stats);
    }

}
