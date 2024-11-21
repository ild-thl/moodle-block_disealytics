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
global $CFG;

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

    private function create_prediction(): bool {
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

        if ($this->prediction = new prediction($data->id, $data)) return true;

        return false;
    }



    /**
     * Get the output for the viewmode: module.
     *
     * @return void
     * @throws coding_exception
     */
    protected function get_module_output(): void {
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

        if ($this->create_prediction()) {
            global $PAGE;
            $output = $PAGE->get_renderer('core'); // Get a generic core renderer.

            if ($this->prediction->get_prediction_data()->prediction > 0) {
                $this->output["student_at_risk"] = get_string(self::TITLE . '_at_risk', 'block_disealytics');
            } else {
                $this->output["student_at_risk"] = get_string(self::TITLE . '_not_at_risk', 'block_disealytics');
            }

            $calculations = $this->prediction->get_calculations();
            $firstThreeIndicators = [];
            $fourthIndicator = [];
            $allCalculations = [];
            $count = 0;

            foreach ($calculations as $calculation) {
                if (!$calculation->indicator->should_be_displayed($calculation->value, $calculation->subtype)) {
                    continue;
                }
                if ($calculation->value === null) {
                    continue;
                }

                // Construct the entry with name and display value.
                $entry = [
                        'name' => (string) call_user_func([$calculation->indicator, 'get_name']),
                        'displayvalue' => $calculation->indicator->get_display_value($calculation->value, $calculation->subtype)
                ];

                // Add style and icon to the entry.
                list($entry['style'], $entry['outcomeicon']) = insight::get_calculation_display(
                        $calculation->indicator,
                        floatval($calculation->value),
                        $output,
                        $calculation->subtype
                );

                // Add help icon if available.
                $identifier = $calculation->indicator->get_name()->get_identifier() . 'def';
                $component = $calculation->indicator->get_name()->get_component();
                if (get_string_manager()->string_exists($identifier, $component)) {
                    $helpicon = new \help_icon($identifier, $component);
                    $entry['outcomehelp'] = $helpicon->export_for_template($output);
                }


                // If the name contains 'cognitive', add to a separate list.
                if ((strpos($entry['name'], 'cognitive') !== false) || (strpos($entry['name'], 'kognitiv') !== false)) {
                    $cognitiveIndicators[] = $entry;
                } else if ((strpos($entry['name'], 'social') !== false) || (strpos($entry['name'], 'sozial') !== false)) {
                    $socialIndicators[] = $entry;
                } else {
                    $restIndicators[] = $entry;
                }

                // Add to all calculations list.
                $allCalculations[] = $entry;

                // Separate into first three and fourth indicators.
                if ($count < 3) {
                    $firstThreeIndicators[] = $entry;
                } elseif ($count == 3) {
                    $fourthIndicator[] = $entry;
                }
                $count++;
            }

            // Add the indicators to the output structure.
            $this->output['insights'] = [
                    'first_three' => $firstThreeIndicators,
                    'fourth' => $fourthIndicator,
                    'all_calculations' => $allCalculations,
                    'cognitive' => $cognitiveIndicators,
                    'social' => $socialIndicators,
                    'rest' => $restIndicators
            ];

        } else {
            $this->output['nodata'] = get_string('nodata', 'block_disealytics');
        }
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
