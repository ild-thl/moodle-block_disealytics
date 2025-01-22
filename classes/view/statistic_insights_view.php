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
// phpcs:ignore
namespace block_disealytics\view;

use block_completionstatus;
use coding_exception;
use core\chart_bar;
use core\chart_series;
use core_analytics\prediction;
use dml_exception;
use Exception;
use moodle_exception;
use report_insights\output\insight;
use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * Class statistic_insight_view
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class statistic_insights_view extends base_view {
    /**
     * Title of the view.
     */
    private const TITLE = 'statistic-insights-view';

    private prediction $prediction;

    private function any_course_predictions(): bool {
        global $DB, $COURSE;

        $sql = "SELECT ap.*
            FROM {analytics_predictions} ap
            JOIN {context} cx ON cx.id = ap.contextid
            JOIN {course} c ON (c.id = cx.instanceid AND cx.contextlevel = 50)
            JOIN {user_enrolments} ue ON ue.id = ap.sampleid
            JOIN {user} u ON u.id = ue.userid
            WHERE c.id = :courseid";

        $params = [
                'courseid' => $COURSE->id
        ];

        $predictions = $DB->get_records_sql($sql, $params);

        return !empty($predictions);
    }

    private function create_prediction_for_user(): bool {
        global $DB, $USER, $COURSE;

        $sql = "SELECT ap.*
        FROM {analytics_predictions} ap
        JOIN {context} cx ON cx.id = ap.contextid
        JOIN {course} c ON (c.id = cx.instanceid AND cx.contextlevel = 50)
        JOIN {user_enrolments} ue ON ue.id = ap.sampleid
        JOIN {user} u ON u.id = ue.userid
        WHERE u.id = :userid
        AND c.id = :courseid";

        $params = [
                'userid' => $USER->id,
                'courseid' => $COURSE->id
        ];

        $data = $DB->get_record_sql($sql, $params);

        if ($data && $this->prediction = new prediction($data->id, $data)) {
            return true;
        }

        return false;
    }

    private function is_completion_enabled(): bool {
        global $COURSE, $USER;

        $coursecompletion = new \completion_info($COURSE);
        return ($coursecompletion->is_enabled() && $coursecompletion->has_criteria());
    }

    private function user_has_completed_course(): bool {
        global $COURSE, $USER;

        $coursecompletion = new \completion_info($COURSE);
        if ($coursecompletion->is_enabled() && $coursecompletion->has_criteria()) {
            $usercompletion = new \completion_completion(array('userid' => $USER->userid, 'course' => $COURSE->id));
            return $usercompletion->is_complete();
        }
        return false;
    }

    private function render_help_popup_message($identifier, $component = "block_disealytics"): array {
        global $PAGE;
        $output = $PAGE->get_renderer('core'); // Get a generic core renderer.
        $details = [];

        // Add help icon if available.
        if (get_string_manager()->string_exists($identifier, $component)) {
            $helpicon = new \help_icon($identifier, $component);
            $details[] = $helpicon->export_for_template($output);
        }
        return $details;
    }

    private function get_completion_status_block() {
        global $PAGE, $CFG;

        require_once($CFG->dirroot . '/blocks/moodleblock.class.php');
        require_once($CFG->dirroot . '/blocks/completionstatus/block_completionstatus.php');

        $completionstatus_block = new block_completionstatus();
        $completionstatus_block->page = $PAGE;
        $completion_content = $completionstatus_block->get_content();

        return $completion_content->text;
    }

    /**
     * Get the output for the viewmode: module.
     *
     * @return void
     * @throws coding_exception
     */
    protected function get_module_output(): void {
        global $PAGE;
        $output = $PAGE->get_renderer('core'); // Get a generic core renderer.
        // Viewmode settings.
        $iseditmode = get_user_preferences("block_disealytics_editing", "0");
        $this->output["isexpanded"] = get_user_preferences("block_disealytics_expanded_view", 'none') == self::TITLE;
        // If in editing mode.
        if ($iseditmode == 1) {
            $this->output["editmode"] = true;
        } else {
            $this->output["viewmode"] = true;
        }
        $this->output["viewmode_module"] = true;

        // Texts.
        $this->output["title"] = get_string(self::TITLE, 'block_disealytics');
        $this->output["help_info_text"] = get_string(self::TITLE . '_help_info_text', 'block_disealytics');
        $this->output["help_info_text_expanded"] = get_string(self::TITLE . '_help_info_text_expanded', 'block_disealytics');

        if ($this->is_completion_enabled()) {
            $this->output["completion_enabled"] = true;
            $this->output["completion"]['completion_title'] = get_string(self::TITLE . '_completion_title', 'block_disealytics');
            $this->output["completion"]['outcomehelp'] = $this->render_help_popup_message('analytics_completion:explanation');
            $this->output["completion"]['completion_status'] = $this->get_completion_status_block();
        } else {
            $this->output["completion_enabled"] = false;
        }

        if (!$this->any_course_predictions()) {
            $this->output['nodata'] = [
                    'no_prediction_in_course' => get_string('statistic-insights-view_course_not_available', 'block_disealytics')
            ];
            return;
        }

        if (!$this->create_prediction_for_user()) {
            $this->output["user_prediction_available"] = false;
            $this->output["student_at_risk"] = get_string(self::TITLE . '_not_at_risk', 'block_disealytics');
            return;
        }

        $this->output["user_prediction_available"] = true;
        $this->output["student_at_risk"] = [
                'status' => get_string(self::TITLE . '_at_risk', 'block_disealytics'),
                'outcomehelp' => $this->render_help_popup_message('analytics_at_risk:explanation')
        ];

        $calculations = $this->prediction->get_calculations();
        $generalIndicators = [];
        $modIndicators = [];

        foreach ($calculations as $calculation) {
            if ($calculation->value === null ||
                    !$calculation->indicator->should_be_displayed($calculation->value, $calculation->subtype)) {
                continue;
            }

            $indicatortype = $calculation->indicator->get_name()->get_identifier();

            if (strpos($indicatortype, 'potential') !== false) {
                continue;
            }

            if (!preg_match('/indicator:(activitiesdue|readactions|anywriteincourse|cognitive|social)/', $indicatortype)) {
                continue;
            }

            $indicatorname = (string) $calculation->indicator->get_name();
            $indicatorvalue = $calculation->indicator->get_display_value($calculation->value, $calculation->subtype);

            $entry = [];

            // Handle general indicators first
            if ($indicatortype === 'indicator:activitiesdue') {
                $entry['activitiesdue']['id'] = $calculation->value == 1 ? 'activitiesdue' : 'noactivitiesdue';
                $indicatorvalue = get_string(self::TITLE . ($calculation->value == 1 ? '_activitiesdue' : '_noactivitiesdue'), 'block_disealytics');
                $entry['activitiesdue']['name'] = $indicatorname;
                $entry['activitiesdue']['value'] = $indicatorvalue;
                $generalIndicators[] = $entry;
            } else if ($indicatortype === 'indicator:readactions') {
                $indicatorvalue = rtrim($indicatorvalue, '%');
                $entry['readactions']['name'] = $indicatorname;
                $entry['readactions']['value'] = $indicatorvalue;
                $generalIndicators[] = $entry;
            } else if ($indicatortype === 'indicator:anywriteincourse') {
                $indicatorvalue = get_string(self::TITLE . ($calculation->value == 0 ? '_anywriteincourse' : '_nowriteincourse'), 'block_disealytics');
                $entry['anywriteincourse']['name'] = $indicatorname;
                $entry['anywriteincourse']['value'] = $indicatorvalue;
                $generalIndicators[] = $entry;
            } else {
                // Extract module name (e.g., "mod_assign") from the class path
                $modName = explode('\\', get_class($calculation->indicator))[0];

                // Skip "core" but only for module indicators (not general ones)
                if ($modName === 'core' || $modName === 'core_course') {
                    continue;
                }

                // Initialize module group if not set
                if (!isset($modIndicators[$modName])) {
                    $modIndicators[$modName] = [];
                }

                $entry['name'] = $indicatorname;
                $entry['value'] = $indicatorvalue;

                $identifier = $calculation->indicator->get_name()->get_identifier() . 'def';
                $component = $calculation->indicator->get_name()->get_component();
                if (get_string_manager()->string_exists($identifier, $component)) {
                    $helpicon = new \help_icon($identifier, $component);
                    $entry['outcomehelp'] = $helpicon->export_for_template($output);
                }

                // Add entry to the corresponding module's array
                $modIndicators[$modName][] = $entry;
            }
        }

        // Convert mod indicators to friendly names
        $modIndicatorsArray = [];
        foreach ($modIndicators as $moduleName => $indicators) {
            // Convert "mod_assign" to "Assignment"
            $friendlyName = get_string('pluginname', $moduleName);

            // If no readable name is found, fall back to original module name
            if ($friendlyName === "[[$moduleName]]") {
                $friendlyName = ucfirst(str_replace('mod_', '', $moduleName));
            }

            $modIndicatorsArray[] = [
                    'module_name' => $friendlyName,
                    'indicators' => $indicators
            ];
        }

        $this->output['insights'] = [
                'general' => $generalIndicators,
                'mod' => $modIndicatorsArray
        ];

    }

    /**
     * Get the output for the viewmode: halfyear.
     *
     * @return void
     * @throws coding_exception
     * @throws moodle_exception
     */
    protected function get_halfyear_output(): void {
        // Viewmode settings.
        $iseditmode = get_user_preferences("block_disealytics_editing", "0");
        $this->output["isexpanded"] = get_user_preferences("block_disealytics_expanded_view", 'none') == self::TITLE;
        // If in editing mode.
        if ($iseditmode == 1) {
            $this->output["editmode"] = true;
        } else {
            $this->output["viewmode"] = true;
            $this->output["viewmode_halfyear"] = true;
        }

        $this->output["title"] = get_string(self::TITLE, 'block_disealytics');
        $this->output["help_info_text"] = get_string(self::TITLE . '_help_info_text', 'block_disealytics');
        $this->output["help_info_text_expanded"] = get_string(self::TITLE . '_help_info_text_expanded', 'block_disealytics');
    }

    /**
     * Get the output for the viewmode: global.
     *
     * @return void
     * @throws coding_exception
     * @throws moodle_exception
     */
    protected function get_global_output(): void {
        // Viewmode settings.
        $iseditmode = get_user_preferences("block_disealytics_editing", "0");
        $this->output["isexpanded"] = get_user_preferences("block_disealytics_expanded_view", 'none') == self::TITLE;
        // If in editing mode.
        if ($iseditmode == 1) {
            $this->output["editmode"] = true;
        } else {
            $this->output["viewmode"] = true;
            $this->output["viewmode_global"] = true;
        }
        $this->output["title"] = get_string(self::TITLE, 'block_disealytics');
        $this->output["help_info_text"] = get_string(self::TITLE . '_help_info_text', 'block_disealytics');
        $this->output["help_info_text_expanded"] = get_string(self::TITLE . '_help_info_text_expanded', 'block_disealytics');
    }
}
