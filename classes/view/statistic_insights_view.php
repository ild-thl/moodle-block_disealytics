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

    private function load_prediction(): prediction {
        global $DB, $USER, $COURSE;

        $sql = "SELECT *
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

        // Fetch a single record.
        $data = $DB->get_record_sql($sql, $params);

        $this->prediction = new prediction($data->id, $data);

        return $this->prediction;
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

        if ($this->load_prediction()) {
            // Calculated indicators values.
            $this->output['insights']['calculations'] = json_encode($this->prediction->get_calculations());

            // copied from report/insights/classes/output/insight.php
            //foreach ($calculations as $calculation) {
            //
            //    // Hook for indicators with extra features that should not be displayed (e.g. discrete indicators).
            //    if (!$calculation->indicator->should_be_displayed($calculation->value, $calculation->subtype)) {
            //        continue;
            //    }
            //
            //    if ($calculation->value === null) {
            //        // We don't show values that could not be calculated.
            //        continue;
            //    }
            //
            //    $obj = new \stdClass();
            //    $obj->name = call_user_func(array($calculation->indicator, 'get_name'));
            //    $obj->displayvalue = $calculation->indicator->get_display_value($calculation->value, $calculation->subtype);
            //    list($obj->style, $obj->outcomeicon) = insight::get_calculation_display($calculation->indicator,
            //            floatval($calculation->value), $output, $calculation->subtype);
            //
            //    $identifier = $calculation->indicator->get_name()->get_identifier() . 'def';
            //    $component = $calculation->indicator->get_name()->get_component();
            //    if (get_string_manager()->string_exists($identifier, $component)) {
            //        $obj->outcomehelp = (new \help_icon($identifier, $component))->export_for_template($output);
            //    }
            //    $this->output['insights']['calculations'] = $obj;
            //}
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
