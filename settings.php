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

/**
 * Settings for block_disealytics
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    // Consent.
    $settings->add(new admin_setting_configtextarea(
        'block_disealytics/consent_text',
        get_string('config_consent_text', 'block_disealytics'),
        get_string('config_consent_description', 'block_disealytics'),
        '',
        PARAM_RAW,
        80
    ));
    // Counter to reset view of consent.
    $settings->add(new admin_setting_configtextarea(
        'block_disealytics/counter',
        get_string('config_counter_title', 'block_disealytics'),
        get_string('config_counter_text', 'block_disealytics'),
        1,
        PARAM_INT,
        80
    ));

    $settings->add(new admin_setting_configstoredfile(
        'block_disealytics/filterblacklist',
        get_string('config_eventblacklist_title', 'block_disealytics'),
        get_string('config_eventblacklist_text', 'block_disealytics'),
        'disea',
        10
    ));

    $settings->add(new admin_setting_configstoredfile(
        'block_disealytics/components',
        get_string('config_componentlist_title', 'block_disealytics'),
        get_string('config_componentlist_text', 'block_disealytics'),
        'disea',
        20
    ));
}
