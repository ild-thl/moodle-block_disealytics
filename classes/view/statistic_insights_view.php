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
use block_disealytics\data\course;
use coding_exception;
use core_analytics\prediction;
use core_course\analytics\indicator\completion_enabled;
use moodle_exception;
use stdClass;

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

    /**
     * @var prediction
     */
    private prediction $prediction;

    /**
     * Return whether predictions are available for the given course.
     *
     * @param stdClass $course course to check for predictions.
     * @return bool True if predictions are available, false otherwise.
     * @throws \dml_exception
     */
    private function any_course_predictions(stdClass $course): bool {
        global $DB;

        $sql = "SELECT ap.*
            FROM {analytics_predictions} ap
            JOIN {context} cx ON cx.id = ap.contextid
            JOIN {course} c ON (c.id = cx.instanceid AND cx.contextlevel = 50)
            JOIN {user_enrolments} ue ON ue.id = ap.sampleid
            JOIN {user} u ON u.id = ue.userid
            WHERE c.id = :courseid";

        $params = [
                'courseid' => $course->id,
        ];

        $predictions = $DB->get_records_sql($sql, $params);

        return !empty($predictions);
    }

    /**
     * Create a prediction for the current user in the given course.
     *
     * @param stdClass $course course to create the prediction for.
     * @return bool True if a prediction was created, false otherwise.
     * @throws \dml_exception
     */
    private function create_prediction_for_user(stdClass $course): bool {
        global $DB, $USER;

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
                'courseid' => $course->id,
        ];

        $data = $DB->get_record_sql($sql, $params);

        if ($data && $this->prediction = new prediction($data->id, $data)) {
            return true;
        }

        return false;
    }

    /**
     * Return whether completion is enabled for the given course.
     *
     * @param stdClass $course course to check for completion.
     * @return bool True if completion is enabled, false otherwise.
     */
    private function is_completion_enabled(stdClass $course): bool {
        $coursecompletion = new \completion_info($course);
        return ($coursecompletion->is_enabled() && $coursecompletion->has_criteria());
    }

    /**
     * Render help popup message.
     *
     * @param string $identifier identifier of the help icon.
     * @param string $component component of the help icon.
     * @return array help popup message.
     */
    private function render_help_popup_message(string $identifier, string $component = "block_disealytics"): array {
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

    /**
     * Get the completion status block.
     *
     * @return string completion status block.
     */
    private function get_completion_status_block(): string {
        global $PAGE, $CFG;

        require_once($CFG->dirroot . '/blocks/moodleblock.class.php');
        require_once($CFG->dirroot . '/blocks/completionstatus/block_completionstatus.php');

        $blockcompletionstatus = new block_completionstatus();
        $blockcompletionstatus->page = $PAGE;
        $completioncontent = $blockcompletionstatus->get_content();

        return $completioncontent->text;
    }

    /**
     * Generate the output for the course completion if enabled.
     * If completion is disabled, the accordion starts at 1 with the predictions,
     * skipping the completion output in the view completely.
     *
     * @return void
     * @throws coding_exception
     */
    private function get_course_completion_output() {
        global $COURSE;
        if ($this->is_completion_enabled($COURSE)) {
            $this->output["completion_enabled"] = true;
            $this->output["completion"]['completion_title'] = get_string(self::TITLE . '_completion_title', 'block_disealytics');
            $this->output["completion"]['outcomehelp'] = $this->render_help_popup_message('analytics_completion:explanation');
            $this->output["completion"]['completion_status'] = $this->get_completion_status_block();
            $this->output["prediction_accordion_number"] = 2;
        } else {
            $this->output["completion_enabled"] = false;
            // If completion is disabled, the accordion starts at 1 with the predictions.
            $this->output["prediction_accordion_number"] = 1;
        }
    }

    /**
     * Get the prediction output for the given course.
     * If no prediction is available, the output will contain a message.
     * If a prediction is available, the output will contain the prediction data.
     *
     * @param stdClass $course course to get the prediction output for.
     * @return array prediction output.
     * @throws \dml_exception
     * @throws coding_exception
     */
    private function get_prediction_output(stdClass $course): array {
        global $PAGE;
        $pageoutput = $PAGE->get_renderer('core'); // Get a generic core renderer.
        $predictionoutput = [];
        $predictionoutput['coursename'] = $course->fullname;

        // Check if predictions for the course are available.
        if (!$this->any_course_predictions($course)) {
            $predictionoutput['nodata'] = ['no_prediction_in_course' => get_string(
                    'statistic-insights-view_course_prediction_not_initialized', 'block_disealytics'
            )];
            return $predictionoutput;
        }

        // Check if a prediction is available for the current user.
        if (!$this->create_prediction_for_user($course)) {
            $predictionoutput["user_prediction_available"] = false;
            $predictionoutput["student_at_risk"] = get_string(self::TITLE . '_not_at_risk', 'block_disealytics');
            return $predictionoutput;
        }

        // Prediction is available.
        $predictionoutput["user_prediction_available"] = true;
        $predictionoutput["student_at_risk"] = [
                'status' => get_string(self::TITLE . '_at_risk', 'block_disealytics'),
                'outcomehelp' => $this->render_help_popup_message('analytics_at_risk:explanation'),
        ];

        $calculations = $this->prediction->get_calculations();
        $generalindicators = [];
        $modindicators = [];

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

            // Handle general indicators first.
            if ($indicatortype === 'indicator:activitiesdue') {
                $entry['activitiesdue']['class'] = $calculation->value == 1 ? 'activitiesdue' : 'noactivitiesdue';
                $indicatorvalue = get_string(self::TITLE . ($calculation->value == 1 ? '_activitiesdue' : '_noactivitiesdue'),
                        'block_disealytics');
                $entry['activitiesdue']['name'] = $indicatorname;
                $entry['activitiesdue']['value'] = $indicatorvalue;
                $generalindicators[] = $entry;
            } else if ($indicatortype === 'indicator:readactions') {
                $indicatorvalue = rtrim($indicatorvalue, '%');
                $entry['readactions']['name'] = $indicatorname;
                $entry['readactions']['value'] = $indicatorvalue;
                $generalindicators[] = $entry;
            } else if ($indicatortype === 'indicator:anywriteincourse') {
                $indicatorvalue = get_string(self::TITLE . ($calculation->value == 0 ? '_anywriteincourse' : '_nowriteincourse'),
                        'block_disealytics');
                $entry['anywriteincourse']['name'] = $indicatorname;
                $entry['anywriteincourse']['value'] = $indicatorvalue;
                $generalindicators[] = $entry;
            } else {
                // Extract module name (e.g., "mod_assign") from the class path.
                $modname = explode('\\', get_class($calculation->indicator))[0];

                // Skip "core" but only for module indicators (not general ones).
                if ($modname === 'core' || $modname === 'core_course') {
                    continue;
                }

                // Initialize module group if not set.
                if (!isset($modindicators[$modname])) {
                    $modindicators[$modname] = [];
                }

                $entry['name'] = $indicatorname;
                $entry['value'] = $indicatorvalue;

                $identifier = $calculation->indicator->get_name()->get_identifier() . 'def';
                $entry['identifier'] = $identifier;

                $component = $calculation->indicator->get_name()->get_component();
                if (get_string_manager()->string_exists($identifier, $component)) {
                    $helpicon = new \help_icon($identifier, $component);
                    $entry['outcomehelp'] = $helpicon->export_for_template($pageoutput);
                }

                // Add entry to the corresponding module's array.
                $modindicators[$modname][] = $entry;
            }
        }

        // Convert mod indicators to structured data.
        $scructuredmodindicators = [];

        foreach ($modindicators as $modulename => $indicators) {
            // Convert "mod_assign" to "Assignment".
            $friendlyname = get_string('pluginname', $modulename);

            // If no readable name is found, fall back to the original module name.
            if ($friendlyname === "[[$modulename]]") {
                $friendlyname = ucfirst(str_replace('mod_', '', $modulename));
            }

            // Ensure that we prepare cognitive and social indicators separately.
            $cognitivevalue = 0;
            $socialvalue = 0;
            $cognitivehelp = null;
            $socialhelp = null;

            // Loop through indicators and assign values.
            foreach ($indicators as $indicator) {
                if (isset($indicator['name']) && isset($indicator['value'])) {
                    $cleanvalue = floatval(str_replace('%', '', $indicator['value']));

                    // Determine if it's cognitive or social based on name.
                    if (strpos(strtolower($indicator['identifier']), 'cognitive') !== false) {
                        $cognitivevalue = $cleanvalue;
                        $cognitivehelp = $indicator['outcomehelp'] ?? null; // Store cognitive help if available.
                    } else if (strpos(strtolower($indicator['identifier']), 'social') !== false) {
                        $socialvalue = $cleanvalue;
                        $socialhelp = $indicator['outcomehelp'] ?? null; // Store social help if available.
                    }
                }
            }

            // Store structured data.
            $scructuredmodindicators[] = [
                    'module_name' => $friendlyname,
                    'cognitive' => [
                            'value' => $cognitivevalue,
                            'name' => get_string('cognitive_indicators', 'block_disealytics'),
                            'outcomehelp' => $cognitivehelp, // Assign cognitive outcome help.
                    ],
                    'social' => [
                            'value' => $socialvalue,
                            'name' => get_string('social_indicators', 'block_disealytics'),
                            'outcomehelp' => $socialhelp, // Assign social outcome help.
                    ],
            ];

        }

        $predictionoutput['insights'] = [
                'general' => $generalindicators,
                'mod' => $scructuredmodindicators,
        ];

        return $predictionoutput;
    }

    /**
     * Get the output for the viewmode: module.
     *
     * @return void
     * @throws coding_exception|\dml_exception
     */
    protected function get_module_output(): void {
        global $COURSE;
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

        $this->get_course_completion_output();
        $this->output['prediction_output'] = $this->get_prediction_output($COURSE);
    }

    /**
     * Get the output for the viewmode: halfyear.
     *
     * @return void
     * @throws coding_exception
     * @throws moodle_exception
     */
    protected function get_halfyear_output(): void {
        global $USER;
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

        $allusercourses = course::get_all_courses_of_user_current_semester($USER->id);

        if (count($allusercourses) == 0) {
            $this->output['nocourses'] = get_string(self::TITLE . '_no_course_available', 'block_disealytics');
            return;
        }
        $outputs = [];
        $i = 1;
        foreach ($allusercourses as $usercourse) {
            $course = get_course($usercourse->courseid);
            $output = $this->get_prediction_output($course);
            $output['output_index'] = $i; // Add index inside the output.
            $outputs[] = $output; // Append to the outputs array.
            $i++;
        }
        $this->output["courseoutputs"] = $outputs;

    }

    /**
     * Get the output for the viewmode: global.
     *
     * @return void
     * @throws coding_exception
     * @throws moodle_exception
     */
    protected function get_global_output(): void {
        global $USER;
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
        $this->output["additional_info"] = get_string(self::TITLE . '_global_additional_info', 'block_disealytics');

        $allusercourses = course::get_all_courses_of_user_current_semester($USER->id);

        if (count($allusercourses) == 0) {
            $this->output['nocourses'] = get_string(self::TITLE . '_no_course_available', 'block_disealytics');
            return;
        }
        $outputs = [];
        $i = 1;
        foreach ($allusercourses as $usercourse) {
            $course = get_course($usercourse->courseid);
            $output = $this->get_prediction_output($course);
            $output['output_index'] = $i; // Add index inside the output.
            $outputs[] = $output; // Append to the outputs array.
            $i++;
        }
        $this->output["courseoutputs"] = $outputs;
    }
}
