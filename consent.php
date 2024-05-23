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

/**
 * Consent file.
 *
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_login();
global $CFG;
require_once($CFG->dirroot . '/blocks/disealytics/classes/form/consent_form.php');
use block_disealytics\form\consent_form;

global $DB, $USER, $PAGE, $OUTPUT;

$PAGE->set_url(new moodle_url('/blocks/disealytics/consent.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('pluginname', 'block_disealytics'));

// Get Course ID from url to be able to redirect.
$courseid = optional_param('id', null, PARAM_INT);
// Check id user is already in Database.
$user = $DB->get_record('block_disealytics_consent', ['userid' => $USER->id]);

// Create redirecting url.
$url = $CFG->wwwroot.'/blocks/disealytics/consent.php?id=' . $courseid;
$courseurl = $CFG->wwwroot . '/course/view.php?id=' . $courseid;

$counter = get_config("block_disealytics", "counter") ?: 1;

// Make the form.
$mform = new consent_form($url);
if ($user) {
    $mform->set_data(['agreedis' => $user->choice]);
}

// Check response from consent_form.
if ($mform->is_cancelled()) {
    if (!$user || $user->counter < $counter) {
        // If user wasn't in database and wants to cancel, stay on this page.
        redirect($url);
    } else {
        // If user is already in database and cancels, return to course.
        redirect($courseurl);
    }
} else if ($fromform = $mform->get_data()) {
    $id = $_POST['agreedis'];

    if ($id == null) {
        redirect($url, get_string('no_choice', 'block_disealytics'), \core\output\notification::NOTIFY_ERROR);
    }

    $choice = 0;
    if ($id === '1') {
        $choice = 1;
    }

    if (!$user) {
        // If user is not in the database.
        $recordtoinsert = new stdClass();
        $recordtoinsert->userid = $USER->id;
        $recordtoinsert->counter = $counter;
        $recordtoinsert->choice = $choice;
        $recordtoinsert->timecreated = time();
        $recordtoinsert->timemodified = time();
        $DB->insert_record('block_disealytics_consent', $recordtoinsert);
        redirect($courseurl, get_string('database_insert', 'block_disealytics'));
    } else {
        // If user is in database, it needs to be updated.
        $user->choice = $choice;
        $user->counter = $counter;
        $user->timemodified = time();
        $DB->update_record('block_disealytics_consent', $user);
        redirect($courseurl, get_string('database_update', 'block_disealytics'));
    }
}

echo $OUTPUT->header();

$templatecontext = (object)[
    'consent' => get_config("block_disealytics", 'consent_text') ?: "",
];

echo $OUTPUT->render_from_template('block_disealytics/agreement', $templatecontext);
$mform->display();
echo $OUTPUT->footer();
