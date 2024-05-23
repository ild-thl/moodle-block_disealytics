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
namespace block_disealytics\view;

use block_disealytics\data\assignment;
use block_disealytics\data\course;
use coding_exception;
use core\chart_pie;
use core\chart_series;
use dml_exception;
use moodle_exception;
use stdClass;

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once($CFG->dirroot . '/blocks/disealytics/classes/view/base_view.php');
require_once($CFG->dirroot . '/blocks/disealytics/classes/learningdata.php');

/**
 * Class success_chance_view
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class success_chance_view extends base_view {
    /**
     * Title of the view.
     */
    const TITLE = 'success-chance-view';

    /**
     * Get the output for the viewmode: module.
     * @return void
     * @throws coding_exception
     * @throws moodle_exception
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
        global $COURSE;
        $this->output["title"] = get_string(self::TITLE, 'block_disealytics');
        $this->output["help_info_text"] = get_string('success-chance_help_info_text', 'block_disealytics');
        $this->output["help_info_text_expanded"] = get_string('success-chance_help_info_text_expanded', 'block_disealytics');

        if ($COURSE->id != 1) {
            $allassignments = assignment::block_disealytics_get_course_assignments($COURSE->id);
            if (count($allassignments) > 0) {
                $chartdatastatus = $this->calculate_chartdata_status($allassignments);
                $this->output['charts'][] = ['chartdata' => json_encode($chartdatastatus),
                        'uniqid' => uniqid('block_disealytics_')];
            } else {
                $this->output['nodata'] = get_string('success-chance-no-data', 'block_disealytics');
            }
        } else {
            $this->output['nodata'] = get_string('success-chance-no-data', 'block_disealytics');
        }
        $this->output["info_summary"] = get_string('success-chance_info_summary', 'block_disealytics');
    }

    /**
     * Generates default.
     *
     * @param assignment $assignment
     * @return void
     * @throws coding_exception
     * @throws dml_exception
     */
    private function gen_default(assignment $assignment): void {
        $htmlcontent = $assignment->block_disealytics_gen_status_html();

        // Use regular expressions to extract the text within the title attribute.
        if (preg_match('/<i[^>]*title="([^"]+)"/i', $htmlcontent, $matches)) {
            $titletext = $matches[1];
            $status = $titletext;
        } else {
            $status = false;
        }
        $this->output['table_elements'][] = [
            "assignment_link" => $assignment->block_disealytics_build_name_link(),
            "detail_description" => true,
            "status_type" => $status,
            "status" => get_string('success-chance-incomplete-text', 'block_disealytics'),
            "color" => "disea-orange"];
    }

    /**
     * Calculates the chart data status.
     *
     * @param array $assignments
     * @return chart_pie
     * @throws coding_exception
     * @throws dml_exception
     */
    private function calculate_chartdata_status(array $assignments): chart_pie {
        $chart = new chart_pie();
        $chart->set_doughnut(true);
        $chart->set_legend_options(['display' => false]);
        $labels = [];
        $values = [];

        // Here, the assignments are put into three categories.
        $okaycount = 0;
        $incompletecount = 0;
        $failedcount = 0;

        // Separate variables for all the relevant assignments (so the number of assignments is correct in the list).
        $passedcount = 0;
        $submittedcount = 0;
        $selfcheckcount = 0;
        $notsubmittedcount = 0;
        $notcompletedcount = 0;

        $incompletefactor = 0.5;
        foreach ($assignments as $assignment) {
            // Check if assignment is needed for pvl probability.
            if ($assignment->block_disealytics_gen_grade_status() === assignment::GRADE_STATUS_OKAY) {
                $okaycount++;
                $passedcount++;
                $this->output['table_elements'][] = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-okay-text', 'block_disealytics'),
                        "color" => "disea-green"];
            } else if ($assignment->block_disealytics_gen_grade_status() === assignment::GRADE_STATUS_FAILED) {
                $failedcount++;
                $this->output['table_elements'][] = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-failed-text', 'block_disealytics'),
                        "color" => "disea-red"];
            } else if ($assignment->block_disealytics_gen_grade_status() === assignment::GRADE_STATUS_INCOMPLETE) {
                $incompletecount++;
                $notcompletedcount++;
                $this->gen_default($assignment);
            } else if ($assignment->block_disealytics_gen_submission_status() === assignment::SUBMISSION_STATUS_SUBMITTED) {
                $okaycount++;
                $submittedcount++;
                $this->output['table_elements'][] = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-submitted-text', 'block_disealytics'),
                        "color" => "disea-green"];
            } else if ($assignment->block_disealytics_gen_submission_status() === assignment::SUBMISSION_STATUS_NOTSUBMITTED) {
                $incompletecount++;
                $notsubmittedcount++;
                $this->output['table_elements'][] = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-notsubmitted-text', 'block_disealytics'),
                        "color" => "disea-orange"];
            } else {
                $incompletecount++;
                $notcompletedcount++;
                $this->gen_default($assignment);
            }
            if ($assignment->block_disealytics_gen_submission_status() === assignment::SUBMISSION_STATUS_SELFCHECK) {
                $selfcheckcount++;
                $this->output['table_elements'][] = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-selfcheck-text', 'block_disealytics'),
                        "color" => "disea-gray"];
            }
        }

        if ($failedcount > 0) {
            $pvlprobability = 0;
        } else {
            if (count($assignments) > 0) {
                $pvlprobability = ($okaycount + ($incompletecount * $incompletefactor)) / count($assignments) * 100;
            }
            if ($pvlprobability < 0) {
                $pvlprobability = 0;
            }
        }
        $pvlprobability = round($pvlprobability);
        $this->output['pvlProbability'] = $pvlprobability;

        if ($pvlprobability == 0) {
            $labels[] = get_string('success-chance-label-failed', 'block_disealytics') . ' ' . $pvlprobability . "%";
            $values[] = $failedcount;
            $series = new chart_series(get_string('assignment_view_hover_failed', 'block_disealytics'), $values);
            // Colors: #077D55 = green, #D91F11 = red, #FF9500 = orange.
            $series->set_colors(["#D91F11"]);
            $chart->add_series($series);
        } else {
            $labels[] = ($okaycount) . " " .
                    get_string('pvl_assignment_view_hover_okay', 'block_disealytics');
            $values[] = $pvlprobability;
            $labels[] = ($incompletecount) . " " .
                    get_string('pvl_assignment_view_hover_incomplete', 'block_disealytics');
            $values[] = 100 - $pvlprobability;
            $series = new chart_series(get_string('pvl_success-chance-chart-text', 'block_disealytics'), $values);
            // Colors: #077D55 = green, #D91F11 = red, #FF9500 = orange.
            $series->set_colors(["#077D55", "#FF9500"]);
            $chart->add_series($series);
        }

        $this->output['assignment_info_text_summary'] = get_string('pvl_assignment_info_text_summary', 'block_disealytics');

        $this->output['assignment_info_text_okay'] =
                "→ " . $passedcount . " " . get_string('pvl_assignment_info_text_okay', 'block_disealytics');
        $this->output['assignment_info_text_submitted'] =
                "→ " . $submittedcount . " " . get_string('pvl_assignment_info_text_submitted', 'block_disealytics');
        $this->output['assignment_info_text_selfcheck'] =
                "→ " . $selfcheckcount . " " . get_string('pvl_assignment_info_text_selfcheck', 'block_disealytics');
        $this->output['assignment_info_text_notsubmitted'] =
                "→ " . $notsubmittedcount . " " . get_string('pvl_assignment_info_text_notsubmitted', 'block_disealytics');
        $this->output['assignment_info_text_incomplete'] =
                "→ " . $notcompletedcount . " " . get_string('pvl_assignment_info_text_incomplete', 'block_disealytics');
        $this->output['assignment_info_text_failed'] =
                "→ " . $failedcount . " " . get_string('pvl_assignment_info_text_failed', 'block_disealytics');

        $chart->set_labels($labels);
        return $chart;
    }

    /**
     * Get the output for the viewmode: halfyear.
     * @return void
     * @throws coding_exception
     * @throws dml_exception
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
            $this->output["viewmode_halfyear"] = true;
        }

        $this->output["title"] = get_string(self::TITLE, 'block_disealytics');
        $this->output["help_info_text"] = get_string('success-chance_help_info_text', 'block_disealytics');
        $this->output["help_info_text_expanded"] = get_string('success-chance_help_info_text_expanded', 'block_disealytics');

        $allusercourses = course::get_all_courses_of_user_current_semester($USER->id);
        $assignments = [];

        foreach ($allusercourses as $course) {
            $courseassignments = assignment::block_disealytics_get_course_assignments($course->courseid);
            $table = [];
            $table["coursename"] = $course->coursename;
            foreach ($courseassignments as $assignment) {
                $assignments[] = $assignment;
            }
            $this->generate_describtions_for_each_course($courseassignments, $table);
        }

        $chartdatastatus = $this->calculate_chartdata_status($assignments, $course->courseid);
        $this->output['charts'][] = ['chartdata' => json_encode($chartdatastatus),
                'uniqid' => uniqid('block_disealytics_')];
    }

    /**
     * Generates describtions for each course.
     * @param array $assignments
     * @param array $table
     * @return void
     * @throws coding_exception
     */
    private function generate_describtions_for_each_course(array $assignments, array $table): void {
        $table["assigns"] = [];
        foreach ($assignments as $assignment) {
            if ($assignment->block_disealytics_gen_grade_status() === assignment::GRADE_STATUS_OKAY) {
                $tableelement = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-okay-text', 'block_disealytics'),
                        "color" => "disea-green"];
            } else if ($assignment->block_disealytics_gen_grade_status() === assignment::GRADE_STATUS_FAILED) {
                $tableelement = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-failed-text', 'block_disealytics'),
                        "color" => "disea-red"];
            } else if ($assignment->block_disealytics_gen_submission_status() === assignment::SUBMISSION_STATUS_SUBMITTED) {
                $tableelement = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-submitted-text', 'block_disealytics'),
                        "color" => "disea-green"];
            } else if ($assignment->block_disealytics_gen_submission_status() === assignment::SUBMISSION_STATUS_NOTSUBMITTED) {
                $tableelement = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-notsubmitted-text', 'block_disealytics'),
                        "color" => "disea-orange"];
            } else {
                $htmlcontent = $assignment->block_disealytics_gen_status_html();

                // Use regular expressions to extract the text within the title attribute.
                if (preg_match('/<i[^>]*title="([^"]+)"/i', $htmlcontent, $matches)) {
                    $titletext = $matches[1];
                    $status = $titletext;
                } else {
                    $status = false;
                }
                $tableelement = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "detail_description" => true,
                        "status_type" => $status,
                        "status" => get_string('success-chance-incomplete-text', 'block_disealytics'),
                        "color" => "disea-orange"];
            }
            if ($assignment->block_disealytics_gen_submission_status() === assignment::SUBMISSION_STATUS_SELFCHECK) {
                $tableelement = [
                        "assignment_link" => $assignment->block_disealytics_build_name_link(),
                        "small_description" => true,
                        "status" => get_string('success-chance-selfcheck-text', 'block_disealytics'),
                        "color" => "disea-gray"];
            }
            $table["assigns"][] = $tableelement;
        }
        $this->output["tablesNew"][] = $table;
    }

    /**
     * Get the output for the viewmode: global.
     * @return void
     * @throws coding_exception
     * @throws dml_exception
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
            $this->output["viewmode_global"] = true;
        }

        $this->output["title"] = get_string(self::TITLE, 'block_disealytics');
        $this->output["help_info_text"] = get_string('success-chance_help_info_text', 'block_disealytics');
        $this->output["help_info_text_expanded"] = get_string('success-chance_help_info_text_expanded', 'block_disealytics');

        $this->output["categories"] = [];
        $allusercourses = course::get_all_courses_of_user($USER->id);
        $semesterfilter = get_user_preferences("block_disealytics_" . self::TITLE, reset($allusercourses)->categoryname);
        $assignments = [];

        foreach ($allusercourses as $course) {
            if ($semesterfilter === $course->categoryname || !$semesterfilter) {
                $courseassignments = assignment::block_disealytics_get_course_assignments($course->courseid);
                $table = [];
                $table["coursename"] = $course->coursename;
                foreach ($courseassignments as $assignment) {
                    $assignments[] = $assignment;
                }
                $this->generate_describtions_for_each_course($courseassignments, $table);
            }
            $categorydata = $course->categoryname;

            $issemesterfilter = ($semesterfilter === $categorydata);
            $categoryexists = false;
            foreach ($this->output["categories"] as $category) {
                if ($category["name"] === $categorydata) {
                    $categoryexists = true;
                    break;
                }
            }

            if (!$categoryexists) {
                $this->output["categories"][] = ["name" => $categorydata, "selected" => $issemesterfilter];
            }
        }

        $chartdatastatus = $this->calculate_chartdata_status($assignments);
        $this->output['charts'][] = ['chartdata' => json_encode($chartdatastatus),
                'uniqid' => uniqid('block_disealytics_')];
    }
}
