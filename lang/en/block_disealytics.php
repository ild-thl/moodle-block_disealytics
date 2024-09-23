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
 * Plugin strings are defined here.
 *
 * @category    string
 * @package    block_disealytics
 * @copyright 2021 onwards https://disea-projekt.de/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Learner Dashboard';
$string['plugin-title'] = 'Learner Dashboard';
$string['plugin-version-details'] = 'DiSEA Learner Dashboard 2024 - Version 0.3.0 2024092300';
$string['disea'] = 'Learner Dashboard';
$string['disealytics:addinstance'] = 'Add a new Learner Dashboard block.';
$string['disealytics:myaddinstance'] = 'Add a new Learner Dashboard block to my dashboard.';
$string['disealytics:editlearnerdashboard'] = 'Edit the Learner Dashboard.';
$string['languagesetting'] = 'en';
$string['login_alert'] = 'Please log in to use the Learner Dashboard.';
$string['course_alert'] = 'The Learner Dashboard can only be displayed on the main course page.';
$string['consent_start_msg'] = 'Please consent to data processing in order to use the plugin.';
$string['consent_start_btn'] = 'Consent and use plugin';
$string['change-to-expandable-view'] = 'Go to the detail view ...';

$string['nouserconsent'] = 'Consent to required data processing.';

$string['diseasettings'] = 'Learner Dashboard settings';
$string['activityviewsetting'] = 'Show activity overview';
$string['assignmentviewsetting'] = 'Show assignment overview';
$string['editing_mode_setting'] = 'Activate editing mode';
$string['exit_editing_mode'] = 'Exit editing mode';
$string['study_progress_setting'] = 'Show study progress overview';

$string['assignment'] = 'Assignment';
$string['due'] = 'Due until';
$string['submitted'] = 'Submitted';
$string['grade'] = 'Grade';

$string['activityview'] = 'Activity overview';
$string['loginspermonth'] = 'Logins per month';
$string['loginsperweek'] = 'Logins per week';
$string['logins'] = 'Logins';
$string['months'] = 'Months';

$string['courseviews'] = 'Course views';
$string['courseviewsperweek'] = 'Course views per week';
$string['courseviewsAM'] = 'Course views AM';
$string['courseviewsPM'] = 'Course views PM';
$string['courseviewsperday'] = 'Course views per day';

$string['Monday'] = 'Monday';
$string['Tuesday'] = 'Tuesday';
$string['Wednesday'] = 'Wednesday';
$string['Thursday'] = 'Thursday';
$string['Friday'] = 'Friday';
$string['Saturday'] = 'Saturday';
$string['Sunday'] = 'Sunday';

$string['Jan'] = 'January';
$string['Feb'] = 'February';
$string['Mar'] = 'March';
$string['Apr'] = 'April';
$string['May'] = 'May';
$string['Jun'] = 'June';
$string['Jul'] = 'July';
$string['Aug'] = 'August';
$string['Sep'] = 'September';
$string['Oct'] = 'October';
$string['Nov'] = 'November';
$string['Dec'] = 'December';

$string['calendarweeks'] = 'calendar weeks';

$string['testcontent'] = 'This is test content.';
$string['testfooter'] = 'The Learner Dashboard is loading.';

// Selection Form.
$string['select_view'] = 'Select view';

// Activity view.
$string['activity-view'] = "Activity";
$string['activity-view_help_info_text'] = "Take a look at your learning time! The colored segments represent different activities, and their height indicates the duration of each activity. In the activity diagram, various values are grouped according to your activities in Moodle. These values may vary depending on the activity. The system analyzes all activities and groups them, and activities with the longest duration are displayed in the activity diagram.";
$string['activity-view_help_info_text_expanded'] = "In the activity card’s detail view, you can see the familiar diagram of summaries from your course and additional graphs of your activities with extra information.";

// Assignment view.
$string['assignment-view'] = 'Assignments';
$string['assignment-view_help_info_text'] = "<p>The 'Assignments' card lists all the assignments of the course available to you and shows the current status of the assignment. When you click on the link of an assignment, you will be forwarded to the page with the details of that assignment.</p> <p style='color: var(--primary)'>Symbol meanings:</p> <p> <span style='color: var(--primary)'>Neutral status (grey circle):</span> The grey circle represents the neutral status of the assignment. No action is required. <p> <span style='color: var(--primary)'>Not passed (red 'X'):</span> The red 'X' indicates that the respective assignment has been assessed but not passed. For more details, please click on the assignment link. <p> <span style='color: var(--primary)'>Not yet attempted (grey \'X\'):</span> The grey \'X\' indicates that the respective assignment has not yet been submitted / attempted. For more details, please click on the assignment link. <p><span style='color: var(--primary)'>Incomplete (yellow warning sign):</span> The yellow warning sign indicates that the assignment is incomplete, cannot be attempted yet because of missing requirements, or may have been submitted after the due date. Additionally, it may indicate that the assignment has not been passed but further attempts are possible. For more details, please click on the assignment link.  <p><span style='color: var(--primary)'>Submitted on time (grey check mark):</span> The grey check mark indicates that the submission was made on time. For more details, please click on the assignment link. <p> <span style='color: var(--primary)'>Incomplete/Warning (yellow warning sign):</span> The yellow warning sign indicates that the assignment is incomplete, cannot be attempted yet because of missing requirements, or may have been submitted after the due date. Additionally, it may indicate that the assignment has not been passed but further attempts are possible. For more details, please click on the assignment link.  <p> <span style='color: var(--primary)'>Submitted on time (Grey check mark): </span> The grey check mark indicates that the submission was made on time. For more details, please click on the assignment link. <p> <span style='color: var(--primary)'>Marked as completed by yourself (Yellow check mark): </span> The yellow check mark indicates that the assignment has been self-marked as complete by the student, but may still need to be reviewed by the instructor. For more details, please click on the assignment link. <p><span style='color: var(--primary)'>Passed (Green check mark): </span> The green check mark indicates that the assignment was passed. For more details, please click on the assignment link.";
$string['assignment-view_help_info_text_expanded'] = "<p>The 'Assignments' card lists all the assignments of the course available to you and shows the current status of the assignment. When you click on the link of an assignment, you will be forwarded to the page with the details of that assignment.</p> <p style='color: var(--primary)'>Symbol meanings:</p> <p> <span style='color: var(--primary)'>Neutral status (grey circle):</span> The grey circle represents the neutral status of the assignment. No action is required. <p> <span style='color: var(--primary)'>Not passed (red 'X'):</span> The red 'X' indicates that the respective assignment has been assessed but not passed. For more details, please click on the assignment link. <p> <span style='color: var(--primary)'>Not yet attempted (grey \'X\'):</span> The grey \'X\' indicates that the respective assignment has not yet been submitted / attempted. For more details, please click on the assignment link. <p><span style='color: var(--primary)'>Incomplete (yellow warning sign):</span> The yellow warning sign indicates that the assignment is incomplete, cannot be attempted yet because of missing requirements, or may have been submitted after the due date. Additionally, it may indicate that the assignment has not been passed but further attempts are possible. For more details, please click on the assignment link.  <p><span style='color: var(--primary)'>Submitted on time (grey check mark):</span> The grey check mark indicates that the submission was made on time. For more details, please click on the assignment link. <p> <span style='color: var(--primary)'>Incomplete/Warning (yellow warning sign):</span> The yellow warning sign indicates that the assignment is incomplete, cannot be attempted yet because of missing requirements, or may have been submitted after the due date. Additionally, it may indicate that the assignment has not been passed but further attempts are possible. For more details, please click on the assignment link.  <p> <span style='color: var(--primary)'>Submitted on time (Grey check mark): </span> The grey check mark indicates that the submission was made on time. For more details, please click on the assignment link. <p> <span style='color: var(--primary)'>Marked as completed by yourself (Yellow check mark): </span> The yellow check mark indicates that the assignment has been self-marked as complete by the student, but may still need to be reviewed by the instructor. For more details, please click on the assignment link. <p><span style='color: var(--primary)'>Passed (Green check mark): </span> The green check mark indicates that the assignment was passed. For more details, please click on the assignment link.";
$string['assignment_info_text'] = "Here you can see the status of the assignments available in the course.";
$string['assignment_view_hover_failed'] = 'Assignment failed';
$string['assignment_view_hover_okay'] = 'Assignment passed';
$string['assignment_view_hover_notsubmitted'] = 'Assignment not yet submitted';
$string['assignment_view_hover_submitted'] = 'Assignment submitted but not yet evaluated';
$string['assignment_view_hover_incomplete'] = 'Assignment incomplete, submitted after the due date, with missing requirements or failed on first attempt';
$string['assignment_view_hover_selfcheck'] = 'Assignment has been self-marked as completed, but may still need to be reviewed by the instructor';
$string['assignment_view_hover_neutral'] = 'Neutral status. No action is required';
$string['assignment_view_load-less-assignments'] = 'Show less';
$string['assignment_view_specific_scale'] = 'failed, rework, passed';
$string['assignment_view_no_assignments_available'] = 'You are not enrolled in any course in the selected semester that contains assignments.';

// Learninggoals view.
$string['learning-goals-view'] = 'Learning Goals';
$string['learning-goals_info_text'] = 'Set individual learning goals that you want to achieve by a fixed date.';
$string['learning-goals-view_help_info_text'] = "The card 'Learning Goals' shows you the individual goals for your studies. By pressing the button 'New learning goal' in the upper area you can enter a short description for the goal and set an individual date, by which you want to reach the goal. Once you have reached the goal, you can mark it as complete using the checkbox. The goals can be found chronologically in the tabs 'Today', 'Tomorrow', 'This week', 'This month' and 'In the future'. In the tab 'Achieved' you will find all the goals that are already checked and can delete them from the list.";
$string['learning-goals-view_help_info_text_expanded'] = "The card 'Learning Goals' shows you the individual goals for your studies. By pressing the button 'New learning goal' in the upper area you can enter a short description of the goal and set an individual date by which you want to reach the goal. Once you have reached the goal, you can mark it as completed using the checkbox. The goals can be found chronologically in the tabs 'Today', 'Tomorrow', 'This week', 'This month' and 'In the future'. In the tab 'Achieved' you will find all the goals that are already checked and can delete them from the list.";
$string['goal_editing'] = 'Turn editing off';
// Goal input fields.
$string['goal_date_input'] = 'Date';
$string['goals_reached'] = 'learning goals achieved.';
$string['learning-goals_add_goal'] = 'New learning goal';
// Goals timeline.
$string['goals_finished_past'] = 'Achieved';
$string['goals_today'] = 'Today';
$string['goals_tomorrow'] = 'Tomorrow';
$string['goals_thisweek'] = 'This week';
$string['goals_thismonth'] = 'This month';
$string['goals_infuture'] = 'In the future';
// Settings for each goal.
$string['goal_placeholder'] = 'New learning goal...';
$string['goal_input_save'] = 'Add learning goal';
$string['goal_input_update'] = 'Update';
$string['goal_input_cancel'] = 'Cancel';
$string['goal_limit'] = 'You have reached the maximum number of learning goals.';
$string['goal_name_missing'] = 'Please enter a title for the learning goal.';
$string['goal_name_invalid'] = 'Please use only letters, numbers, spaces and the special characters "?!".';
$string['goal_date_missing'] = 'Please enter a due date for the learning goal.';

// Progressbar view.
$string['progress-bar-view'] = 'Progressbar';
$string['progress_config_title'] = 'Progressbar';
$string['progress_config_help_title'] = 'Reading Progressbar: Add learning material';
$string['progress-bar-view_help_info_text'] = "<p>The 'Progressbar' card shows you the reading progress of your current learning material.</p><p style='color: var(--primary)'>Add learning material</p><p>By default, the card is empty. You can add the progress of learning materials belonging to this course to the card through the gear icon at the top right corner.</p><p style='color: var(--primary)'>Viewing graphic data</p><p>This will show you a detailed table of the learning materials you have submitted.";

$string['study-progress-view'] = "Study Progress";
$string['data_entry_view'] = "Data entry";
$string['assignment_view'] = "Assignments";

$string['add_view_button'] = 'Add card';
$string['add_activity_view'] = "Add 'Activity'";
$string['add_study_progress_view'] = "Add 'Study Progress'";
$string['add_learning_goals_view'] = "Add 'Learning Goals'";
$string['add_assignment_view'] = "Add 'Assignments'";
$string['add_progress_bar_view'] = "Add 'Progressbar'";
$string['add_success_chance_view'] = "Add 'PVL-Probability'";
$string['add_planner_view'] = "Add 'Planning Assistent'";

$string['learning-materials-view'] = "Add learning material";

$string['select_timeframe'] = 'Time period selection';
$string['total_study_period'] = 'Entire study program';
$string['current_semester'] = 'Current semester';

// Optional input fields.
$string['progress_bar_add_learning_material'] = 'Add course learning material';
$string['progress_bar_manage_learning_material'] = 'Manage course learning material';
$string['progress_bar_modal_intro'] = 'Here you can add documents, videos or links that have been uploaded in the selected course as learning material.';
$string['progress_bar_additional_help'] = 'Further help with managing learning materials';
$string['add-learning-material'] = 'Add course learning material';
$string['learning_material_no_selection'] = 'No selection';
$string['learning_material_all_inputs_set'] = 'You added all available learning materials of the course.';
$string['learning_material_document'] = 'Select document';
$string['learning_material_pages'] = 'Pages read';
$string['learning_material_current_page'] = 'Current page';
$string['learning_material_last_page'] = 'Last page';
$string['learning_material_expenditureoftime'] = 'Expenditure of time (in hours)';
$string['learning_material_save'] = 'Save';
$string['learning_material_edit'] = 'Edit';
$string['learning_material_delete'] = 'Delete';
$string['learning_material_cancel'] = 'Cancel';
$string['learning_material_page_error'] = 'Current page cannot be higher than the last page.';
$string['learning_material_no_document_selected_error'] = 'Please select a document before saving.';
$string['learning_material_page_zero_error'] = 'The last page cannot be 0.';
$string['learning_material_negative_page_error'] = 'Negative numbers cannot be saved as page numbers or as expenditure of time.';
$string['learning_material_page_overflow_error'] = 'Page numbers greater than 1000 cannot be saved.';
$string['learning_material_expenditure_of_time_overflow_error'] = 'Time expenditure greater than 500 cannot be saved.';
$string['learning_material_pattern_error'] = 'Please use numbers only.';
$string['learning_material_save_success'] = 'The reading progress was saved successfully.';
$string['learning_material_delete_success'] = 'The reading progress was deleted successfully.';
$string['progress_bar_title'] = "Reading progress";
$string['pages_read'] = "Pages read";
$string['pages_left'] = "Pages left";
$string['missing_points'] = "Points not reached";

$string['title_detail_name'] = "Detail view";
$string['modal_info_title'] = "Information about the card";
$string['modal_remove_title'] = "Remove card from dashboard";
$string['modal_remove_text_1'] = "Are you sure you would like to remove the card ";
$string['modal_remove_text_2'] = " from the dashboard? You can add it back to your Learner Dashboard any time.";
$string['modal_remove_cancel'] = "Cancel";
$string['modal_remove_check'] = "Remove card from Learner Dashboard";

// Main help modal.
$string['main_help_title'] = "Help page for the Learner Dashboard";

$string['main_help_views_title'] = "Cards classification";
$string['main_help_views_summary'] = 'The Learner Dashboard (LD) contains so-called <span style="color:var(--primary)">cards</span> with different information and functions. You can <span style="color:var(--primary)">add</span> or <span style="color:var(--primary)">remove</span> cards to/from your LD. There are numerous themes to choose from to put together your personal LD.<br><br>Further information on the individual topics can be obtained via the <span style="color:var(--primary)">help modals</span> in the corresponding cards.';

$string['main_help_viewmodes_title'] = 'Different views';
$string['main_help_viewmodes_summary'] = 'In the Learner Dashboard, you can view all content in the <span style="color:var(--primary)">module, semester</span> or <span style="color:var(--primary)">full view</span><br><br><strong>Module view</strong><br>In the module view, the content is displayed specifically for the module you are currently in. You receive a detailed overview of all resources and activities that belong to this module.<br><br><strong>Semester view</strong><br>The semester view shows you all the content of the modules you are taking in the current semester. This view allows you to gain a comprehensive insight into your current semester.<br><br><strong>Full view</strong><br>In the full view, you can access all the content of your degree programme. This includes all modules and activities that you have completed or are currently completing during your entire degree programme.';

$string['main_help_add_remove_title'] = "Adding or removing cards";
$string['main_help_add_remove_summary'] = 'To add or remove cards in the Learner Dashboard, you can proceed as follows:<br>
1. Click on the pencil icon to activate the editing mode.<br>
2. To remove a card: Find the desired card and click on the X symbol in the top right-hand corner of the card.<br>
3. To add new cards: Scroll below your already selected cards. There, you will find the option to add additional cards to the dashboard. Select the desired cards and add them to your dashboard.';

$string['main_help_functionality_title'] = "Recurring functions within the cards";
$string['main_help_functionality_summary'] = '<strong>Help icon on the dashboard</strong><br>
There is a help icon on the entire dashboard, which can be accessed via a <span style="color:var(--primary)">“?”-Icon</span>. This icon provides users with quick access to context-related support and explanations of how the dashboard works.
<br><br><strong>Help symbol on the cards</strong><br>
Each individual card in the dashboard also has a help symbol. Clicking on this icon on a specific card opens a detailed view. This view provides detailed information on the content of the respective card.';

$string['main_help_edit_title'] = "Editing function";
$string['main_help_edit_summary'] = 'Click on the pencil icon to start the editing function for adding or deleting cards in the dashboard. You can use this function to customise your dashboard with the cards that are relevant to you. Click on the red X on the relevant card to remove it. You can add a new card by selecting the ‘Add card’ button. This button opens a new dialogue with the available cards.';

// Main help cards.
$string['main_help_assignment-view'] = 'The card <span style="color:var(--primary)">Assignments</span> lists all submission tasks that are available to you in the corresponding modules and shows the current status of the task.';
$string['main_help_activity-view'] = 'The card <span style="color:var(--primary)">Activity</span> views your learning time at a glance! The coloured segments represent different activities and their height shows the duration of each activity.';
$string['main_help_learning-goals-view'] = 'In the card <span style="color:var(--primary)">Learning Goals</span> you can record any learning objectives. You can also use this function across semesters.';
$string['main_help_planner-view'] = 'The card <span style="color:var(--primary)">Planning Assistent</span> shows you an overview of your upcoming web conference, submission tasks or other activities.';
$string['main_help_progress-bar-view'] = 'In the card <span style="color:var(--primary)">Progressbar</span> you can add learning materials manually and receive the current reading progress of your current reading in the form of a diagram.';
$string['main_help_study-progress-view'] = 'The speedometer on the card <span style="color:var(--primary)">Study Progress</span> shows you your learning progress and how far you are towards your goal. The calculation is based on the assessments in the tasks that are assigned to you in the course.';
$string['main_help_success-chance-view'] = 'In the card <span style="color:var(--primary)">PVL-Probability</span> all submissions (including assessment points) are displayed. The respective PVL probability is calculated from the assessment points of the individual submissions and displayed as a percentage.';

$string['main_add_view_title'] = "Add cards";
$string['main_add_view_info_text'] = "Select the cards you would like to have displayed in the Learner Dashboard.";
$string['main_add_view_info_text_empty'] = "You have added all available cards.";

$string['main_config_title'] = "Configuration";
$string['main_config_desc'] = "You can configure the Learner Dashboard here.";
$string['main_config_consent_title'] = "Data processing";
$string['main_config_consent_desc'] = "You have consented to the data processing.";
$string['consent_config_title'] = "Data processing";
$string['consent_config_desc'] = "Would you like to withdraw your consent to data processing? The Learner Dashboard can then no longer be used and the following data will be deleted:";
$string['consent_config_list_item_1'] = "Self-defined learning goals";
$string['consent_config_list_item_2'] = "Settings of the progress bar (input learning materials)";
$string['consent_config_list_item_3'] = "Dates of the 'Planning Assistant'";
$string['consent_config_link'] = "Read privacy policy";
$string['consent_config_btn_cancel'] = "Cancel";
$string['consent_config_btn_delete'] = "Delete data and revoke consent";
$string['consent_config_btn_save'] = "Keep data and revoke consent";
$string['no-view-exists'] = "Start the editing mode for adding cards by clicking on the pencil icon.";

$string['learning_materials-view_help_info_text'] = '<p>Stay up to date with your learning progress and indicate your progress here on the course documents provided. To add a document, click on the button under "Add course learning materials".</p><p><strong>Document:</strong > Select a document provided in the course.<p><strong>Current page:</strong> Enter the page you are on in the document.<p><strong>Last page:</strong> Enter here Enter how many pages the document has in total.</p><p><strong>Time required (in hours):</strong> Enter the estimated time required here.</p>
<p>Use the "Save" button to complete the process and save the progress in your personal area.</p>

<p>Under "Manage course learning materials" you can edit the materials you have already entered or remove individual reading progress from your personal area.</p>';


// Study progress view.
$string['study-progress-view'] = "Study Progress";
$string['study-progress_infotext_bad'] = "The study progress is not optimal at the moment.";
$string['study-progress_infotext_average'] = 'The study progress is currently <span style="color: var(--primary)">average</span>.';
$string['study-progress_infotext_good'] = "The study progress is currently very good.";
$string['study-progress-view_help_info_text'] = "The speedometer shows you your progress of studies and how far you are towards your goal. The calculation is based on the assessments in the tasks assigned to you in the course.";
$string['study-progress-view_help_info_text_expanded'] = "The speedometer shows you your progress of studies and how far you are towards your goal. The calculation is based on the assessments in the tasks assigned to you in the course. Below the speedometer you will find a list on which this calculation is based.";
$string['study-progress_expanded_title'] = "Evaluation of the influencing factors";
$string['study-progress_expanded_desc'] = "The overall assessment for the current semester is based on various values and is weighted differently:";
$string['study-progress_activity_weight'] = "% moodle activities";
$string['study-progress_doc_weight'] = "% progress in learning materials";
$string['study-progress_assign_weight'] = "% progress in assignments";
$string['study-progress_activity'] = "moodle activities";
$string['study-progress_doc'] = "learning materials";
$string['study-progress_assign'] = "assignments";
$string['study-progress_score_is'] = "The score is ";
$string['study-progress_eval_course'] = "Evaluation for this course";
$string['study-progress_eval_halfyear'] = "Evaluation for this semester";
$string['study-progress_eval_global'] = "Evaluation for your studies";

// Success chance view.
$string['success-chance-view'] = 'PVL-Probability';
$string['success-chance-view_help_info_text'] = "<p>All submitted assignments (including assessment points) are displayed in full on the 'PVL-Probability' card. The respective PVL-Probability is calculated from the status of the individual submissions and represents this as a percentage.</p><p><span style=\"color: var(--primary)\">NOTE</span><br> Please note, that the value of the PVL-Probability is only calculated based on the past assignments submitted. It is important to understand that a high PVL-Probability does not therefore mean a guarantee of success and that there is some uncertainty. Ultimately, your success depends on many factors, including your efforts and circumstances beyond our control. Use the PVL-Probability as a guide, but do not be discouraged if your actual results differ.";
$string['success-chance-view_help_info_text_expanded'] = "In the detailed view of the card 'PVL-Probability', you will find a complete list of the submission assignments and their status, which contribute to the calculation of the PVL-Probability.";
$string['success-chance_info_text'] = 'Look at the PVL-Probability: The PVL-Probability shows you how many assessment points you have received.';
$string['success-chance_info_text_expanded'] = 'The PVL-Probability shows you the status of the submitted assignments.';
$string['pvl_success-chance-chart-text'] = 'PVL-Probability';
$string['success-chance-label-failed'] = 'PVL-Probability';
$string['success-chance_no_course_available'] = 'You are not enrolled in any course in this semester a PVL-Probability can be calculated for.';

$string['pvl_assignment_info_text_summary_modul'] = 'Your PVL-Probability for the current module is as follows:';
$string['pvl_assignment_info_text_summary_semester'] = 'Your PVL-Probability for the current semester is as follows:';
$string['pvl_assignment_info_text_summary_global'] = 'Your overall PVL-Probability is as follows:';

$string['pvl_assignment_info_text_okay'] = 'assignments have been passed.';
$string['pvl_assignment_info_text_incomplete'] = 'assignments are incomplete.';
$string['pvl_assignment_info_text_submitted'] = 'assignments have been submitted.';
$string['pvl_assignment_info_text_notsubmitted'] = 'assignments have not yet been submitted.';
$string['pvl_assignment_info_text_selfcheck'] = 'assignments are marked as completed.';
$string['pvl_assignment_info_text_failed'] = 'assignments are not passed.';
$string['pvl_assignment_view_hover_okay'] = 'assignments are complete.';
$string['pvl_assignment_view_hover_incomplete'] = 'assignments are not yet complete';

$string['status'] = 'Status';
$string['success-chance-failed-text'] = 'failed';
$string['success-chance-okay-text'] = 'passed';
$string['success-chance-submitted-text'] = 'submitted';
$string['success-chance-notsubmitted-text'] = 'not submitted';
$string['success-chance-incomplete-text'] = 'incomplete';
$string['success-chance-selfcheck-text'] = 'is marked as completed, may still need to be checked by the teacher';

$string['assignmentscore'] = 'Assignment rating';
$string['progress-bar_nodata'] = 'No reading progress is currently recorded. Add the reading progress of your learning material now.';
$string['activity_view_expanded_subtitle'] = "Monthly logins";
$string['study-progress_expanded_info_text'] = "The 'assignment rating' is calculated based on the assignments provided in this course. Each assignment is given a value depending on its status: 'negative (red X)', 'neutral (grey circle or yellow triangle)' or 'positive (green checkmark)'.";

$string['nodata'] = 'There is no data available.';
$string['activity_view_refresh'] = "Last update";

$string['task_tasktransform'] = 'Task transformation';
$string['task_statistics'] = 'Task usage statistics';

// Planner view.
$string['planner-view'] = 'Planning Assistant';
$string['planner-view_help_info_text'] = "This card gives you an overview of your upcoming web conferences, assignments or other activities. You can add further appointments for the currently displayed course by simply clicking on a day of your choice. You can view all appointments in the detailed view.";
$string['planner-view_help_info_text_expanded'] = "This card gives you an overview of your upcoming web conferences, assignments or other activities. You can add further appointments for the currently displayed course by simply clicking on a day of your choice. You can view all appointments in the detailed view.";
$string['planner-view_monday_short'] = "Mo";
$string['planner-view_tuesday_short'] = "Tu";
$string['planner-view_wednesday_short'] = "We";
$string['planner-view_thursday_short'] = "Th";
$string['planner-view_friday_short'] = "Fr";
$string['planner-view_saturday_short'] = "Sa";
$string['planner-view_sunday_short'] = "Su";
$string['planner-view_today_label'] = "Today";
$string['planner-view_global_label'] = "Dates in the month";
$string['planner-view_tomorrow_label'] = "Tomorrow";
$string['planner-view_thismonth_label'] = "This month";
$string['planner-view_infuture_label'] = "In future";
$string['planner_add_event_modal'] = "Add event to the Planning Assistant";
$string['planner_add_event_modal_desc'] = "You can add an event to your Planning Assistant here";
$string['planner_event_name_label'] = "Title";
$string['planner_event_name_placeholder'] = "New event";
$string['planner_event_date_label'] = "Date";
$string['planner_event_location_label'] = "Location";
$string['planner_event_location_placeholder'] = "This is the location";
$string['planner_event_course_label'] = "Associated course";
$string['planner_event_type_label'] = "Type of event";
$string['planner_event_type_value_1'] = "Web conference";
$string['planner_event_type_value_2'] = "In-person event";
$string['planner_event_type_value_3'] = "Miscellaneous";
$string['planner_event_duration_label'] = "Duration";
$string['planner_event_no-end_label'] = "Without time specification";
$string['planner_event_until_label'] = "Until";
$string['planner_event_duration-in-min_label'] = "Duration in minutes";
$string['planner_event_repetitions_label'] = "Weekly repetition, automatic generation";
$string['planner_event_repetitions_text'] = "Repeat event";
$string['planner_required_attribute'] = "necessary";
$string['planner_cancel_event'] = "Cancel";
$string['planner_save_event'] = "Save";
$string['planner_delete_event'] = "Delete";
$string['planner_edit_event'] = "Edit";
$string['planner_date_invalid'] = "Please enter a correct time for the event.";
$string['planner_name_missing'] = "Please enter a title for the event.";
$string['planner_name_invalid'] = 'Please use only letters, numbers, spaces and the special characters "?!.:-/@".';
$string['planner_input_invalid'] = 'The event could not be created. Please check your inputs.';
$string['planner_repetition_invalid'] = 'Please enter a correct number for the repetitions.';
$string['planner_event-details-activity'] = 'About the event';


// Views.
$string['viewmode_module'] = 'Module view';
$string['viewmode_global'] = 'Full view';
$string['viewmode_halfyear'] = 'Semester view';


$string['config_consent_text'] = 'Your declaration of consent';
$string['config_consent_description'] = 'Please enter your declaration of consent here as HTML formatted text.';

$string['config_counter_title'] = 'Counter for displaying the declaration of consent';
$string['config_counter_text'] = 'This counter can be used to control when the declaration of consent should be displayed again for the students.';

$string['config_filterfile_title'] = 'csv file for event filtering';
$string['config_filterfile_text'] = 'This setting allows you to upload a CSV file with event, target and action names to be filtered.';

$string['config_componentlist_title'] = 'Component CSV for component redefinition';
$string['config_componentlist_text'] = 'This setting allows you to upload a CSV file with component names to be replaced.';

$string['agree'] = '<strong>I agree</strong> that my Moodle log data, as well as the examination data, will be passed on to the DiSEA project, stored and used for research purposes.';
$string['disagree'] = '<strong>I do not consent</strong> to my Moodle log data, as well as the examination data, being passed on to the DiSEA project, stored and used for research purposes.';
$string['no_choice'] = 'Please decide on an answer.';

$string['database_insert'] = 'Successfully registered in the database';
$string['database_update'] = 'Database successfully updated';

$string['edit'] = 'Edit';

$string['choice_no'] = 'You have declined consent';
$string['choice_yes'] = 'You have accepted consent';

$string['messageprovider'] = 'DiSEA message provider';
$string['messageprovider:logdata_disea'] = 'DiSEA message provider';

$string['download'] = 'Download';
$string['back'] = 'Back';
$string['delete'] = 'Delete';

$string['activity_view_axislabel_y'] = 'y-axis: minutes';
$string['activity_view_main_axislabel_x'] = 'x-axis: days';
$string['activity_view_detail_axislabel_x'] = 'x-axis: calendarweeks';
// Privacy API.
// For: block_disealytics_consent.
$string['privacy:metadata:block_disealytics_consent'] = 'Agreement to the privacy policy.';
$string['privacy:metadata:consent_userid'] = 'The ID of the user with this consent information.';
$string['privacy:metadata:consent_counter'] = 'A counter to keep track of when to reset the consent information.';
$string['privacy:metadata:consent_choice'] = 'The choice of the user, 0 for declined 1 for agreed.';
$string['privacy:metadata:consent_timecreated'] = 'The time this consent record was created at.';
$string['privacy:metadata:consent_timemodified'] = 'The last time this consent record was modified.';

// For: block_disealytics_user_goals.
$string['privacy:metadata:block_disealytics_user_goals'] = 'Learning goals created by the users of the Learner Dashboard.';
$string['privacy:metadata:user_goal_usermodified'] = 'The ID of the user that modified the goal record.';
$string['privacy:metadata:user_goal_courseid'] = 'The ID of the course the goal record was created in.';
$string['privacy:metadata:user_goal_userid'] = 'The ID of the user with this goal information.';
$string['privacy:metadata:user_goal_timecreated'] = 'The time this goal record was created at.';
$string['privacy:metadata:user_goal_timemodified'] = 'The last time this goal record was modified.';
$string['privacy:metadata:user_goal_timecompleted'] = 'The time the user marked this goal as completed.';
$string['privacy:metadata:user_goal_duedate'] = 'The time completion of this goal is due.';
$string['privacy:metadata:user_goal_description'] = 'A description of the goal.';
$string['privacy:metadata:user_goal_finished'] = 'Indicates if the goal is finished.';

// For: block_disealytics_pages.
$string['privacy:metadata:block_disealytics_user_pages'] = 'Information about read document pages, crated by the users of the Learner Dashboard.';
$string['privacy:metadata:user_pages_usermodified'] = 'The ID of the user that modified the pages record.';
$string['privacy:metadata:user_pages_courseid'] = 'The ID of the course the pages record was created in.';
$string['privacy:metadata:user_pages_userid'] = 'The ID of the user with this page information.';
$string['privacy:metadata:user_pages_timecreated'] = 'The time this pages record was created at.';
$string['privacy:metadata:user_pages_timemodified'] = 'The last time this pages record was modified.';
$string['privacy:metadata:user_pages_timecompleted'] = 'The time the user marked this pages entry as completed.';
$string['privacy:metadata:user_pages_name'] = 'The name of the document the user read.';
$string['privacy:metadata:user_pages_currentpage'] = 'The number of the pages the user read.';
$string['privacy:metadata:user_pages_lastpage'] = 'The total number of pages the document has.';
$string['privacy:metadata:user_pages_expenditureoftime'] = 'The amount of time the user spent reading the document.';

// For: block_disealytics_user_tasks.
$string['privacy:metadata:block_disealytics_user_tasks'] = 'Task information created by the tasktransform task, grouping activities in log data.';
$string['privacy:metadata:user_tasks_component'] = 'The component, taken from the logs.';
$string['privacy:metadata:user_tasks_target'] = 'The target, taken from the logs.';
$string['privacy:metadata:user_tasks_action'] = 'The action, taken from the logs.';
$string['privacy:metadata:user_tasks_eventname'] = 'The name of the event, combines component, target and action names.';
$string['privacy:metadata:user_tasks_courseid'] = 'The ID of the course the tasks record was created in.';
$string['privacy:metadata:user_tasks_userid'] = 'The ID of the user with this task information.';
$string['privacy:metadata:user_tasks_timestart'] = 'The time the first event of the task happened.';
$string['privacy:metadata:user_tasks_n_events'] = 'The number of events grouped into the task.';
$string['privacy:metadata:user_tasks_duration'] = 'The duration of the task in seconds.';
$string['privacy:metadata:user_tasks_timecreated'] = 'The time this tasks record was created at.';

// For: block_disealytics_user_dates.
$string['privacy:metadata:block_disealytics_user_dates'] = 'User created events for the planning assistant.';
$string['privacy:metadata:user_dates_name'] = 'The name of the entry.';
$string['privacy:metadata:user_dates_usermodified'] = 'The ID of the user that modified the dates record.';
$string['privacy:metadata:user_dates_courseid'] = 'The ID of the course the dates record was created in.';
$string['privacy:metadata:user_dates_userid'] = 'The ID of the user with this planner date information.';
$string['privacy:metadata:user_dates_timecreated'] = 'The time this dates record was created at.';
$string['privacy:metadata:user_dates_timemodified'] = 'The last time this dates record was modified.';
$string['privacy:metadata:user_dates_timestart'] = 'The time the event starts at.';
$string['privacy:metadata:user_dates_timeduration'] = 'The duration of the event.';
$string['privacy:metadata:user_dates_location'] = 'The location of the event.';
$string['privacy:metadata:user_dates_eventtype'] = 'The type of event.';
$string['privacy:metadata:user_dates_repeatid'] = 'The ID used to keep track of periodically repeating events.';

// For: block_disealytics_statistics.
$string['privacy:metadata:block_disealytics_statistics']  = "Usage Statistics generated by statistics task.";

$string['privacy:metadata:preference:block_disealytics_editing'] = "Indicates if the user activated the edititing mode in the Learner Dashboard.";
$string['privacy:metadata:preference:block_disealytics_expanded_view'] = "The view that the user views details of in the Learner Dashboard.";
$string['privacy:metadata:preference:block_disealytics_planner_currentdate'] = "The date the planner view uses to select the displayed month.";
$string['privacy:metadata:preference:block_disealytics_views'] = "Stores which views are active in the Learner Dashboard.";
$string['privacy:metadata:preference:block_disealytics_viewmode'] = "Stores the viewmode the user selected in the viewmode dropdown.";

$string['privacy:metadata:preference:block_disealytics_viewsdescription'] = "Serialised data that describes which view are displayed in the Learner Dashboard. Stored as objects containing the view name and if that view is enabled ('1') or disabled ('0').";

$string['editingno'] = "Editing mode in Learner Dashboard turned off.";
$string['editingyes'] = "Editing mode in Learner Dashboard turned on.";

$string['expandedno'] = "No view in Learner Dashboard is expanded.";
$string['plannerdateno'] = "The default value of the planning assistant, now.";
$string['viewmode_selected'] = "is the currently selected viewmode of the Learner Dashboard.";
