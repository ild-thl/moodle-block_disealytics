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

namespace block_disealytics;

use block_disealytics\data\course;
use DateTime;
use dml_exception;
use Exception;
use stdClass;

/**
 * Class learningdata
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class learningdata {
    /**
     * Goal table that holds all learning goals.
     */
    private const GOALTABLE = 'block_disealytics_user_goals';
    /**
     * Table that holds all learning materials.
     */
    private const PAGESTABLE = 'block_disealytics_user_pages';
    /**
     * helper number
     * @var int
     */
    private static int $number = 0;
    /**
     * storage to hold data.
     * @var array
     */
    private array $storage;

    /**
     * learningdata constructor.
     */
    public function __construct() {
        $this->storage = [];
        $this->storage['assignments'] = [];
        $this->storage['submissions'] = [];
        $this->storage['grades'] = [];
        $this->storage['logs'] = [];
        $this->storage['goals'] = [];
        $this->storage['finished_goals'] = [];
        $this->storage['learning_materials'] = [];
    }

    /**
     * Add a goal to the database.
     * @param stdClass $newgoal
     * @return bool|int
     * @throws dml_exception
     */
    public static function add_goal_to_database(stdClass $newgoal) {
        global $DB;
        $now = (new DateTime())->format('U');
        $newgoal->timecreated = $now;
        $newgoal->timemodified = $now;
        return $DB->insert_record(self::GOALTABLE, $newgoal);
    }

    /**
     * Update a goal.
     * @param stdClass $updatedgoal
     * @return void
     * @throws dml_exception
     */
    public static function update_goal(stdClass $updatedgoal): void {
        global $DB;
        $now = (new DateTime())->format('U');
        if ($DB->record_exists(self::GOALTABLE, ['id' => $updatedgoal->id])) {
            $updatedgoal->timemodified = $now;
            $DB->update_record(self::GOALTABLE, $updatedgoal);
        }
    }

    /**
     * Delete a goal.
     * @param int $id
     * @return void
     * @throws dml_exception
     */
    public static function delete_goal(int $id): void {
        global $DB;
        if ($DB->record_exists(self::GOALTABLE, ['id' => $id])) {
            $DB->delete_records(self::GOALTABLE, ['id' => $id]);
        }
    }

    /**
     * Write learning material.
     * @param stdClass $data
     * @return bool
     * @throws dml_exception
     */
    public static function write_learning_material(stdClass $data): bool {
        global $DB, $USER;
        $now = (new DateTime())->format('U');
        $data->userid = $USER->id;
        $data->timecreated = $now;
        $data->timemodified = $now;
        return $DB->insert_record(self::PAGESTABLE, $data);
    }

    /**
     * Update learning material.
     * @param stdClass $data
     * @return void
     * @throws dml_exception
     */
    public static function update_learning_material(stdClass $data): void {
        global $DB;
        $now = (new DateTime())->format('U');
        if ($DB->record_exists(self::PAGESTABLE, ['id' => $data->id])) {
            $data->timemodified = $now;
            $DB->update_record(self::PAGESTABLE, $data);
        }
    }

    /**
     * Delete learning material
     * @param int $id
     * @return void
     * @throws dml_exception
     */
    public static function delete_learning_material(int $id): void {
        global $DB;
        if ($DB->record_exists(self::PAGESTABLE, ['id' => $id])) {
            $DB->delete_records(self::PAGESTABLE, ['id' => $id]);
        }
    }

    /**
     * Get submissions
     * @return array
     * @throws dml_exception
     */
    public function get_submissions(): array {
        if (!$this->storage['submissions']) {
            foreach ($this->get_assignments() as $assignment) {
                global $DB, $USER;
                $this->storage['submissions'][$assignment->id] =
                        $DB->get_record(
                            'assign_submission',
                            ['userid' => $USER->id, 'assignment' => $assignment->id],
                            'id, status, timemodified'
                        );
            }
        }
        return $this->storage['submissions'];
    }

    /**
     * Get assignments
     * @return array
     * @throws dml_exception
     */
    public function get_assignments(): array {
        if (!$this->storage['assignments']) {
            global $DB, $COURSE;
            $this->storage['assignments'] =
                    $DB->get_records('assign', ['course' => $COURSE->id], '', 'id, name, duedate, grade, nosubmissions');
        }
        return $this->storage['assignments'];
    }

    /**
     * Get grades
     * @return array
     * @throws dml_exception
     */
    public function get_grades(): array {
        if (!$this->storage['grades']) {
            foreach ($this->get_assignments() as $assignment) {
                global $DB, $USER;
                $this->storage['grades'][$assignment->id] =
                        $DB->get_record('assign_grades', ['userid' => $USER->id, 'assignment' => $assignment->id], 'id, grade');
            }
        }
        return $this->storage['grades'];
    }

    /**
     * Get logs
     * @param ?callable $filter
     * @return mixed
     * @throws dml_exception
     */
    public function get_logs(?callable $filter = null) {
        if (!$this->storage['logs']) {
            global $DB, $USER;
            $this->storage['logs'] = $DB->get_records(
                'logstore_standard_log',
                ['userid' => $USER->id],
                '',
                'id, courseid, timecreated, action, target'
            );
        }
        return $filter ? array_filter($this->storage['logs'], $filter) : $this->storage['logs'];
    }

    /**
     * Get goals
     * @return array
     * @throws dml_exception
     * @throws Exception
     */
    public function get_goals(): array {
        if (!$this->storage['goals']) {
            global $DB, $USER, $COURSE;
            $goals = $DB->get_records(
                self::GOALTABLE,
                ['userid' => $USER->id, 'courseid' => $COURSE->id]
            );
            $resultgoals = [];
            foreach ($goals as $goal) {
                $resultgoals[] = $this->add_goal_to_storage($goal);
            }
            $this->storage['goals'] = $resultgoals;
        }
        return $this->storage['goals'];
    }

    /**
     * Add goal to storage
     *
     * @param object $dbgoal
     * @return stdClass
     * @throws dml_exception
     */
    private function add_goal_to_storage(object $dbgoal): stdClass {
        global $COURSE;
        $target = self::generate_unique_number();
        // Implement attributes to use in the mustache template.
        $storagegoal = new stdClass();
        $storagegoal->target = $target;
        $storagegoal->goalid = $dbgoal->id;
        $storagegoal->name = $dbgoal->description;
        $storagegoal->coursename =
                $COURSE->id != $dbgoal->courseid ?
                        $this->get_coursename_from_id($dbgoal->courseid) :
                        $this->get_coursename_from_id($COURSE->id);
        $storagegoal->finished = $dbgoal->finished === '1' ? 'true' : 'false';
        $storagegoal->timestamp = $dbgoal->duedate;
        $timestamp = $dbgoal->duedate;
        $storagegoal->formattedduedate = $dbgoal->duedate === '0' ? '' : date('Y-m-d', ($timestamp));
        return $storagegoal;
    }

    /**
     * Generate unique number
     * @return string
     *
     */
    public static function generate_unique_number(): string {
        return self::$number++;
    }

    /**
     * Get coursename from id
     * @param int $courseid
     * @return mixed
     * @throws dml_exception
     */
    private function get_coursename_from_id(int $courseid) {
        global $DB;
        return $DB->get_field('course', 'fullname', ['id' => $courseid]);
    }

    /**
     * Get goals for semester
     * @return array
     * @throws dml_exception
     * @throws Exception
     */
    public function get_goals_semester(): array {
        global $DB, $USER;
        $semestercourseids = course::get_all_courses_of_current_semester();
        $courseids = array_column($semestercourseids, 'courseid');
        $resultgoals = [];
        foreach ($courseids as $courseid) {
            $goals = $DB->get_records(self::GOALTABLE, ['userid' => $USER->id, 'courseid' => $courseid]);

            foreach ($goals as $goal) {
                $resultgoals[] = $this->add_goal_to_storage($goal);
            }
        }
        $this->storage['goals'] = $resultgoals;
        return $this->storage['goals'];
    }

    /**
     * Get goals globally
     *
     * @param null $semestercourseids
     * @return array
     * @throws dml_exception
     */
    public function get_goals_global($semestercourseids = null): array {
        global $DB, $USER;
        $resultgoals = [];

        foreach ($semestercourseids as $courseid) {
            $goals = $DB->get_records(self::GOALTABLE, ['userid' => $USER->id, 'courseid' => $courseid]);
            foreach ($goals as $goal) {
                $resultgoals[] = $this->add_goal_to_storage($goal);
            }
        }

        $this->storage['goals'] = $resultgoals;

        return $this->storage['goals'];
    }

    /**
     * Get finished goals
     *
     * @param int|null $courseid
     * @return mixed
     * @throws dml_exception
     */
    public function get_finished_goals(?int $courseid = null) {
        if (!$this->storage['finished_goals']) {
            global $DB, $USER, $COURSE;
            $goals = $DB->get_records(
                self::GOALTABLE,
                ['userid' => $USER->id, 'courseid' => $courseid ?? $COURSE->id]
            );
            $finishedgoals = [];
            foreach ($goals as $goal) {
                if ($goal->finished === '1') {
                    $finishedgoals[] = $this->add_goal_to_storage($goal);
                }
            }
            $this->storage['finished_goals'] = $finishedgoals;
        }
        return $this->storage['finished_goals'];
    }

    /**
     * Get finished goals for the semester
     * @return array
     * @throws dml_exception
     * @throws Exception
     */
    public function get_finished_goals_semester(): array {
        global $DB, $USER;
        $semestercourseids = course::get_all_courses_of_current_semester();
        $courseids = array_column($semestercourseids, 'courseid');
        $finishedgoals = [];
        foreach ($courseids as $courseid) {
            $goals = $DB->get_records(self::GOALTABLE, ['userid' => $USER->id, 'courseid' => $courseid]);
            foreach ($goals as $goal) {
                if ($goal->finished === '1') {
                    $finishedgoals[] = $this->add_goal_to_storage($goal);
                }
            }
        }
        $this->storage['finished_goals'] = $finishedgoals;
        return $this->storage['finished_goals'];
    }

    /**
     * Get finished goals globally
     *
     * @param null $semestercourseids
     * @return array
     * @throws dml_exception
     */
    public function get_finished_goals_global($semestercourseids = null): array {
        global $DB, $USER;
        $finishedgoals = [];
        foreach ($semestercourseids as $courseid) {
            $goals = $DB->get_records(self::GOALTABLE, ['userid' => $USER->id, 'courseid' => $courseid]);
            foreach ($goals as $goal) {
                if ($goal->finished === '1') {
                    $finishedgoals[] = $this->add_goal_to_storage($goal);
                }
            }
            $this->storage['finished_goals'] = $finishedgoals;
        }
        return $this->storage['finished_goals'];
    }

    /**
     * Get learning materials
     *
     * @param null $filter
     * @param null $courseid
     * @return array
     * @throws dml_exception
     */
    public function get_learning_materials($filter = null, $courseid = null): array {
        global $DB, $USER, $COURSE;
        if ($courseid != null) {
            $learningmaterials = $DB->get_records(
                self::PAGESTABLE,
                ['userid' => $USER->id, 'courseid' => $courseid]
            );
        } else {
            $learningmaterials = $DB->get_records(
                self::PAGESTABLE,
                ['userid' => $USER->id, 'courseid' => $COURSE->id]
            );
        }
        $resultlearningmaterials = [];
        foreach ($learningmaterials as $learningmaterial) {
            $target = self::generate_unique_number();
            $newlearningmaterial = new stdClass();
            $newlearningmaterial->target = $target;
            $newlearningmaterial->learningmaterialid = $learningmaterial->id;
            $newlearningmaterial->documentname = $learningmaterial->name;
            $newlearningmaterial->currentpage = $learningmaterial->currentpage;
            $newlearningmaterial->lastpage = $learningmaterial->lastpage;
            $newlearningmaterial->expenditureoftime = $learningmaterial->expenditureoftime;
            $resultlearningmaterials[] = $newlearningmaterial;
        }
        $this->storage['learning_materials'] = $resultlearningmaterials;

        return $filter ? array_filter($this->storage['learning_materials'], $filter) : $this->storage['learning_materials'];
    }

    /**
     * Get current halfyear dates
     *
     * @return array
     * @throws Exception
     */
    public static function get_current_halfyear_dates(): array {
        $now = new DateTime("now");
        $month = intval($now->format("m"));
        $year = intval($now->format("Y"));
        // Start of Year, current semester started last year.
        if ($month <= 2) {
            return ["start" => new DateTime(($year - 1) . "-08-01"), "end" => new DateTime($year . "-04-00")];
            // During the year, semester is this year.
        } else if ($month <= 8) {
            return ["start" => new DateTime($year . "-01-01"), "end" => new DateTime($year . "-10-00")];
            // End of year, semester starts this year, ends next year.
        } else {
            return ["start" => new DateTime($year . "-08-01"), "end" => new DateTime(($year + 1) . "-10-00")];
        }
    }
}
