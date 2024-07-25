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

namespace block_disealytics\data;

use DateInterval;
use DateTime;
use dml_exception;
/**
 * Class course
 * @package block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course {
    /**
     * Get all courses of a user in the current semester.
     *
     * @param int $userid
     * @return array
     * @throws dml_exception
     */
    public static function get_all_courses_of_user_current_semester(int $userid): array {
        global $DB;
        $now = (new DateTime())->format("U");
        $sql = "SELECT c.instanceid AS courseid, cr.fullname AS coursename, cr.enddate AS coursetimestamp
            FROM {context} c
            JOIN {role_assignments} ra ON c.id = ra.contextid
            JOIN {user} u ON ra.userid = u.id
            JOIN {course} cr ON c.instanceid = cr.id
            WHERE c.contextlevel = :contextlevel
              AND u.id = :userid
              AND cr.startdate <= :now
              ";
        $params = [
            'contextlevel' => CONTEXT_COURSE,
            'userid' => $userid,
            'now' => $now,
        ];
        $data = $DB->get_records_sql($sql, $params);
        return array_filter($data, function($item) use ($now) {
            if ($item->enddate == 0) {
                return true;
            }
            $end = DateTime::createFromFormat("U", $item->enddate)->add(new DateInterval("P1M"));
            return $end->format("U") >= $now;
        });
    }

    /**
     * Get all courses of a user.
     *
     * @param int $userid
     * @return array
     * @throws dml_exception
     */
    public static function get_all_courses_of_user(int $userid): array {
        global $DB;
        $sql = "SELECT c.instanceid AS courseid, cr.fullname AS coursename, cat.name AS categoryname, cr.enddate AS coursetimestamp
            FROM {context} c
            JOIN {role_assignments} ra ON c.id = ra.contextid
            JOIN {user} u ON ra.userid = u.id
            JOIN {course} cr ON c.instanceid = cr.id
            LEFT JOIN {context} catc ON cr.category = catc.instanceid
            LEFT JOIN {course_categories} cat ON catc.instanceid = cat.id
            WHERE c.contextlevel = :contextlevel
              AND u.id = :userid
              ORDER BY cr.enddate DESC";

        $params = [
            'contextlevel' => CONTEXT_COURSE,
            'userid' => $userid,
        ];

        return $DB->get_records_sql($sql, $params);
    }
}
