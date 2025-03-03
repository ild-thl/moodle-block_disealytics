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

namespace block_disealytics\analytics\time_splitting;

/**
 * All previous days analysis interval is defined here.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class days_accum extends \core_analytics\local\time_splitting\accumulative_parts {

    /**
     *  The number of parts to split the analysable duration in. Divides the analysable timeframe into days.
     *
     * @return false|int
     */
    protected function get_number_parts() {
        $start = \DateTime::createFromFormat("U", "{$this->analysable->get_start()}");
        $end = \DateTime::createFromFormat("U", "{$this->analysable->get_end()}");
        $diff = $start->diff($end);
        return $diff->days;
    }

    /**
     *  Returns a lang_string object representing the name for the time splitting method.
     *
     *  Used as column identificator.
     *
     *  If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name(): \lang_string {
        return new \lang_string('analytics_daysaccum', 'block_disealytics');
    }
}
