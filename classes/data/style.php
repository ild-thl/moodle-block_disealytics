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

/**
 * Class style
 * @package block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class style {
    /**
     * Highlight color.
     */
    const BLOCK_DISEALYTICS_PRIMARY = "#419999";
    /**
     * Secondary color.
     */
    const BLOCK_DISEALYTICS_SECONDARY = "#ced4da";
    /**
     * Dark accent color.
     */
    const BLOCK_DISEALYTICS_DARK = "#343a40";

    /**
     * Map a value from one range to another.
     *
     * @param float $val
     * @param float $inputmin
     * @param float $inputmax
     * @param float $outputmin
     * @param float $outputmax
     * @return float
     */
    public static function map(float $val, float $inputmin, float $inputmax, float $outputmin, float $outputmax) {
        $inputrange = $inputmax - $inputmin;
        $outputrange = $outputmax - $outputmin;
        $scale = $outputrange / $inputrange;
        $trueval = $val - $inputmin;
        return $outputmin + ($trueval * $scale);
    }
}
