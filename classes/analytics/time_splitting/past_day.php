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
 * Daily analysis interval is defined here.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class past_day extends \core_analytics\local\time_splitting\past_periodic {

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
        return new \lang_string('analytics_pastday', 'block_disealytics');
    }

    /**
     * The periodicity of the predictions / training data generation.
     *
     * @return \DateInterval
     */
    protected function periodicity() {
        return new \DateInterval('P1D');
    }
}
