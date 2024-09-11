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
$string['plugin-version-details'] = 'DiSEA Learner Dashboard 2024 - Version 0.2.4 2024091100';
$string['disea'] = 'Learner Dashboard';
$string['disealytics:addinstance'] = 'Füge einen neuen Learner Dashboard Block hinzu.';
$string['disealytics:myaddinstance'] = 'Füge einen neuen Learner Dashboard Block zu meinem Dashboard hinzu.';
$string['disealytics:editlearningdashboard'] = 'Bearbeite den Learner Dashboard.';
$string['languagesetting'] = 'de';
$string['login_alert'] = 'Bitte melden Sie sich an, um das Learner Dashboard benutzten zu können.';
$string['course_alert'] = 'Das Learner Dashboard kann nur auf der Kurshauptseite angezeigt werden.';
$string['consent_start_msg'] = 'Um das Plugin nutzen zu können, müssen Sie der Datenverarbeitung zustimmen.';
$string['consent_start_btn'] = 'Einwilligen und Dashboard nutzen';
$string['change-to-expandable-view'] = 'Zur Detailansicht ...';

$string['nouserconsent'] = 'Einwilligung für die Datenverarbeitung erforderlich.';

$string['diseasettings'] = 'Learner Dashboard Einstellungen';
$string['activityviewsetting'] = 'Aktivitätsübersicht anzeigen';
$string['assignmentviewsetting'] = 'Aufgabenübersicht anzeigen';
$string['editing_mode_setting'] = 'Aktiviere den Editiermodus';
$string['exit_editing_mode'] = 'Bearbeitungsmodus beenden';
$string['study_progress_setting'] = 'Lernfortschrittübersicht anzeigen';

$string['assignment'] = 'Aufgabe';
$string['due'] = 'Fällig bis';
$string['submitted'] = 'Abgegeben';
$string['grade'] = 'Note';

$string['activityview'] = 'Aktivitätsübersicht';
$string['loginspermonth'] = 'Anmeldungen im Monat';
$string['loginsperweek'] = 'Anmeldungen pro Woche';
$string['logins'] = 'Anmeldungen';
$string['months'] = 'Monate';

$string['courseviews'] = 'Kursansichten';
$string['courseviewsperweek'] = 'Kursansichten pro Woche';
$string['courseviewsAM'] = 'Kursansichten AM';
$string['courseviewsPM'] = 'Kursansichten PM';
$string['courseviewsperday'] = 'Kursansichten nach Wochentag';

$string['Monday'] = 'Montag';
$string['Tuesday'] = 'Dienstag';
$string['Wednesday'] = 'Mittwoch';
$string['Thursday'] = 'Donnerstag';
$string['Friday'] = 'Freitag';
$string['Saturday'] = 'Samstag';
$string['Sunday'] = 'Sonntag';

$string['Jan'] = 'Januar';
$string['Feb'] = 'Februar';
$string['Mar'] = 'März';
$string['Apr'] = 'April';
$string['May'] = 'Mai';
$string['Jun'] = 'Juni';
$string['Jul'] = 'Juli';
$string['Aug'] = 'August';
$string['Sep'] = 'September';
$string['Oct'] = 'Oktober';
$string['Nov'] = 'November';
$string['Dec'] = 'Dezember';

$string['calendarweeks'] = 'Kalenderwochen';

$string['testcontent'] = 'Dies ist etwas Test-Inhalt';
$string['testfooter'] = 'Das Learner Dashboard wird geladen.';

// Selection Form.
$string['select_view'] = 'Ansichtauswahl';

// Activity view.
$string['activity-view'] = "Nutzungsaktivität";
$string['activity-view_help_info_text'] = "Betrachten Sie Ihre Lernzeit im Überblick! Die farbigen Segmente repräsentieren unterschiedliche Aktivitäten und ihre Höhe zeigt die Dauer jeder Aktivität. Im Aktivitätsdiagramm werden verschiedene Werte entsprechend den Aktivitäten in Moodle gruppiert dargestellt. Diese Werte können je nach Aktivität unterschiedlich sein. Das System analysiert alle Aktivitäten und gruppiert sie, wobei die Aktivitäten mit der längsten Dauer im Aktivitätsdiagramm angezeigt werden.";
$string['activity-view_help_info_text_expanded'] = "Die Detailansicht der Karte \"Aktivität\" zeigt Ihnen das bekannte Diagramm zu den Zusammenfassungen in Ihrem Kurs und weitere Graphen zu Ihren Aktivitäten mit zusätzlichen Informationen.";

// Assignment view.
$string['assignment-view'] = 'Aufgabenübersicht';
$string['assignment-view_help_info_text'] = "<p>Die Karte \"Aufgaben\" listet alle Aufgaben des Kurses auf, die Ihnen zur Verfügung stehen und zeigt einen aktuellen Status der Aufgabe. Wenn Sie auf den Link zu einer Aufgabe klicken, gelangen Sie auf die Seite mit den Details zu dieser Aufgabe.</p> <p style='color: var(--diseablue)'>Symbolbedeutung:</p> <p> <span style='color: var(--diseablue)'>Neutraler Status (Grauer Kreis):</span> Der grau ausgefüllte Kreis steht für einen neutralen Status der Aufgabe. Hier besteht kein Handlungsbedarf. <p> <span style='color: var(--diseablue)'>Nicht bestanden (Rotes 'X')</span> Das rote  \"X\" weist darauf hin, dass die entsprechende Aufgabe bewertet, aber nicht bestanden wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>  Noch nicht bearbeitet (Graues \"X\"):</span> Das graue \"X\" weist darauf hin, dass die entsprechende Aufgabe noch nicht abgegeben / bearbeitet wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Unvollständig (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p><span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil):</span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>Unvollstaendig/Warnung (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p> <span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil): </span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'> Selbst als erledigt markiert (Gelber Pfeil): </span> Der gelbe Pfeil weist darauf hin, dass die Aufgabe vom Studierenden selbst als erledigt markiert wurde, aber gegebenenfalls noch vom Lehrenden überprüft werden muss. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Bestanden (Grüner Pfeil): </span> Der grüne Pfeil weist darauf hin, dass die Aufgabe bestanden ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.";
$string['assignment-view_help_info_text_expanded'] = "<p>Die Karte \"Aufgaben\" listet alle Aufgaben des Kurses auf, die Ihnen zur Verfügung stehen und zeigt einen aktuellen Status der Aufgabe. Wenn Sie auf den Link zu einer Aufgabe klicken, gelangen Sie auf die Seite mit den Details zu dieser Aufgabe.</p> <p style='color: var(--diseablue)'>Symbolbedeutung:</p> <p> <span style='color: var(--diseablue)'>Neutraler Status (Grauer Kreis):</span> Der grau ausgefüllte Kreis steht für einen neutralen Status der Aufgabe. Hier besteht kein Handlungsbedarf. <p> <span style='color: var(--diseablue)'>Nicht bestanden (Rotes 'X')</span> Das rote  \"X\" weist darauf hin, dass die entsprechende Aufgabe bewertet, aber nicht bestanden wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>  Noch nicht bearbeitet (Graues \"X\"):</span> Das graue \"X\" weist darauf hin, dass die entsprechende Aufgabe noch nicht abgegeben / bearbeitet wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Unvollständig (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p><span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil):</span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>Unvollstaendig/Warnung (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p> <span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil): </span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'> Selbst als erledigt markiert (Gelber Pfeil): </span> Der gelbe Pfeil weist darauf hin, dass die Aufgabe vom Studierenden selbst als erledigt markiert wurde, aber gegebenenfalls noch vom Lehrenden überprüft werden muss. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Bestanden (Grüner Pfeil): </span> Der grüne Pfeil weist darauf hin, dass die Aufgabe bestanden ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.";
$string['assignment_info_text'] = "Hier sehen Sie Ihren Status der zur Verfügung stehenden Aufgaben des Kurses.";
$string['assignment_view_hover_failed'] = 'Aufgaben nicht bestanden';
$string['assignment_view_hover_okay'] = 'Aufgaben bestanden';
$string['assignment_view_hover_notsubmitted'] = 'Aufgabe noch nicht abgegeben';
$string['assignment_view_hover_submitted'] = 'Aufgabe abgegeben, aber noch nicht bewertet';
$string['assignment_view_hover_incomplete'] = 'Aufgabe unvollständig, nach Fälligkeit eingereicht, mit fehlender Voraussetzung oder im ersten Versuch nicht bestanden';
$string['assignment_view_hover_selfcheck'] = 'Aufgabe wurde als erledigt markiert, ist ggf. aber noch vom Lehrenden zu prüfen';
$string['assignment_view_hover_neutral'] = 'Neutraler Status. Es besteht kein Handlungsbedarf';
$string['assignment_view_load-less-assignments'] = 'Weniger anzeigen';
$string['assignment_view_specific_scale'] = 'nicht bestanden, Nacharbeit, bestanden';
$string['assignment_view_no_assignments_available'] = 'Sie sind in keinem Kurs des ausgewählten Semesters eingeschrieben, der Aufgaben enthält.';

// Learninggoals view.
$string['learning-goals-view'] = 'Lernziele';
$string['learning-goals_info_text'] = 'Setzen Sie sich individuelle Lernziele, die Sie zu einem festen Zeitpunkt erreichen wollen.';
$string['learning-goals-view_help_info_text'] = "Die Karte \"Lernziele\" zeigt Ihnen die individuellen Ziele für Ihr Studium an. Im oberen Bereich können Sie über den Button \"Neues Lernziel hinzufügen\" eine kurze Beschreibung des Ziels eingeben und ein individuelles Datum festlegen, bis zu welchem Datum Sie das Ziel erreichen wollen. Sobald Sie das Ziel erreicht haben, können Sie es mithilfe des Kontrollkästchens als abgeschlossen markieren. Die Ziele sind chronologisch unter den Reitern \"Heute\", \"Morgen\", \"Diese Woche\", \"Dieser Monat\" und \"Zukünftig\" zu finden. Unter dem Reiter \"Erledigt\" finden Sie alle bereits markierten Ziele und können diese final aus der Liste löschen.";
$string['learning-goals-view_help_info_text_expanded'] = "Die Karte \"Lernziele\" zeigt Ihnen die individuellen Ziele für Ihr Studium an. Im oberen Bereich können Sie über den Button \"Neues Lernziel hinzufügen\" eine kurze Beschreibung des Ziels eingeben und ein individuelles Datum festlegen, bis zu welchem Datum Sie das Ziel erreichen wollen. Sobald Sie das Ziel erreicht haben, können Sie es mithilfe des Kontrollkästchens als abgeschlossen markieren. Die Ziele sind chronologisch unter den Reitern \"Heute\", \"Morgen\", \"Diese Woche\", \"Dieser Monat\" und \"Zukünftig\" zu finden. Unter dem Reiter \"Erledigt\" finden Sie alle bereits markierten Ziele und können diese final aus der Liste löschen.";
$string['goal_editing'] = 'Bearbeiten ausschalten';
// Goal input fields.
$string['goal_date_input'] = 'Datum';
$string['goals_reached'] = 'Lernziele erreicht.';
$string['learning-goals_add_goal'] = 'Neues Lernziel hinzufügen';
// Goals timeline.
$string['goals_finished_past'] = 'Erledigt';
$string['goals_today'] = 'Heute';
$string['goals_tomorrow'] = 'Morgen';
$string['goals_thisweek'] = 'Diese Woche';
$string['goals_thismonth'] = 'Dieser Monat';
$string['goals_infuture'] = 'Zukünftig';
// Settings for each goal.
$string['goal_placeholder'] = 'Neues Lernziel...';
$string['goal_input_save'] = 'Lernziel hinzufügen';
$string['goal_input_update'] = 'Aktualisieren';
$string['goal_input_cancel'] = 'Abbrechen';
$string['goal_limit'] = 'Sie haben die maximale Anzahl an Lernzielen erreicht.';
$string['goal_name_missing'] = 'Bitte geben Sie einen Titel für das Lernziel ein.';
$string['goal_name_invalid'] = 'Bitte verwenden Sie nur Buchstaben, Zahlen, Leerzeichen und die Sonderzeichen "?!".';
$string['goal_date_missing'] = 'Bitte geben Sie ein Fälligkeitsdatum für das Lernziel ein.';

// Progressbar view.
$string['progress-bar-view'] = 'Lesefortschrittsbalken';
$string['progress_config_title'] = 'Lesefortschrittsbalken';
$string['progress_config_help_title'] = 'Lesefortschrittsbalken: Hinzufügen von Lernmaterialien';
$string['progress-bar-view_help_info_text'] = '<p>Der Lesefortschrittsbalken zeigt Ihnen den Lesefortschritt Ihrer aktuellen Lektüre.</p><p style="color: var(--diseablue)">Hinzufügen von Lernmaterialien</p><p>In der Standardeinstellung ist die Karte leer. Sie können dieser Karte den Fortschritt der Lernmaterialien dieses Kurses über das Zahnrad rechts oben in der Karte hinzufügen.</p><p style="color: var(--diseablue)">Grafikdaten anzeigen</p><p>Dies zeigt Ihnen eine detaillierte Tabelle mit den Lernmaterialien, die Sie eingegeben haben, an.';

$string['study-progress-view'] = "Lernfortschritt";
$string['data_entry_view'] = "Dateneingabe";
$string['assignment_view'] = "Aufgaben";

$string['add_view_button'] = 'Karte hinzufügen';
$string['add_activity_view'] = '"Nutzungsaktivität" hinzufügen';
$string['add_study_progress_view'] = '"Lernfortschrittsanzeige" hinzufügen';
$string['add_learning_goals_view'] = '"Lernziele" hinzufügen';
$string['add_assignment_view'] = '"Aufgabenübersicht" hinzufügen';
$string['add_progress_bar_view'] = '"Lesefortschrittsbalken" hinzufügen';
$string['add_success_chance_view'] = '"PVL-Wahrscheinlichkeit" hinzufügen';
$string['add_planner_view'] = '"Planungsassistent" hinzufügen';

$string['optional-inputs-view'] = 'Lernmaterialien hinzufügen';

$string['select_timeframe'] = 'Zeitraumauswahl';
$string['total_study_period'] = 'Gesamtes Studium';
$string['current_semester'] = 'Aktuelles Semester';

// Optional input fields.
$string['progress_bar_add_optional_input'] = 'Lernmaterialien des Kurses hinzufügen';
$string['progress_bar_manage_optional_input'] = 'Lernmaterialien des Kurses verwalten';
$string['progress_bar_modal_intro'] = 'Sie können hier Dokumente, Videos oder Links, die im aufgerufenen Kurs hochgeladen sind, als Lernmaterialien hinzufügen oder die vorhandenen Lernmaterialien des aufgerufenen Kurses bearbeiten.';
$string['add-optional-input'] = 'Lernmaterial aus dem Kurs hinzufügen';
$string['optional_input_no_selection'] = 'Keine Auswahl';
$string['optional_input_all_inputs_set'] = 'Sie haben alle verfügbaren Lernmaterialien des Kurses hinzugefügt.';
$string['optional_input_document'] = 'Dokument auswählen';
$string['optional_input_pages'] = 'Gelesene Seiten';
$string['optional_input_current_page'] = 'Aktuelle Seite';
$string['optional_input_last_page'] = 'Letzte Seite';
$string['optional_input_expenditureoftime'] = 'Zeitaufwand (in Stunden)';
$string['optional_input_save'] = 'Speichern';
$string['optional_input_edit'] = 'Bearbeiten';
$string['optional_input_delete'] = 'Löschen';
$string['optional_input_cancel'] = 'Abbrechen';
$string['optional_input_page_error'] = 'Aktuelle Seite kann nicht höher sein als die letzte Seite.';
$string['optional_input_no_document_selected_error'] = 'Bitte wählen Sie ein Dokument, bevor Sie speichern.';
$string['optional_input_page_zero_error'] = 'Die letzte Seite kann nicht 0 sein.';
$string['optional_input_negative_page_error'] = 'Es können keine negativen Zahlen in den Seitenzahlen, oder im Zeitaufwand gespeichert werden.';
$string['optional_input_page_overflow_error'] = 'Es können keine Seitenzahlen größer als 1000 gespeichert werden.';
$string['optional_input_expenditure_of_time_overflow_error'] = 'Es kann kein Zeitaufwand größer als 500 gespeichert werden.';
$string['optional_input_pattern_error'] = 'Bitte verwenden Sie nur Zahlen.';
$string['optional_input_save_success'] = 'Der Lesefortschritt wurde erfolgreich gespeichert.';
$string['optional_input_delete_success'] = 'Der Lesefortschritt wurde erfolgreich gelöscht.';
$string['progress_bar_title'] = "Lesefortschritt";
$string['pages_read'] = "Gelesen";
$string['pages_left'] = "Verbleibend";
$string['missing_points'] = "Nicht erreichte Punkte";

$string['title_detail_name'] = "Detailansicht";
$string['modal_info_title'] = "Information zur Karte";
$string['modal_remove_title'] = "Karte aus dem Dashboard entfernen";
$string['modal_remove_text_1'] = "Möchten Sie die Karte ";
$string['modal_remove_text_2'] = " wirklich aus dem Dashboard entfernen? Sie können sie jederzeit wieder hinzufügen.";
$string['modal_remove_cancel'] = "Abbrechen";
$string['modal_remove_check'] = "Aus dem Dashboard entfernen";

// Main help modal.
$string['main_help_title'] = "Hilfeseite zum Learner Dashboard";

$string['main_help_views_title'] = "Systematik Karten";
$string['main_help_views_summary'] = 'Das Learner Dashboard (LD) enthält sogenannte <span style="color:var(--diseablue)">Karten</span> mit unterschiedlichen Informationen und Funktionen. Sie können dem LD Karten <span style="color:var(--diseablue)">hinzufügen</span> oder sie <span style="color:var(--diseablue)">entfernen</span>. Es stehen zahlreiche Themen zur Auswahl, um Ihr persönliches LD zusammenzustellen.<br><br>Weitere Informationen zu den einzelnen Themen erhalten Sie über die <span style="color:var(--diseablue)">Hilfefunktion</span> in den entsprechenden Karten.';

$string['main_help_viewmodes_title'] = 'Verschiedene Ansichten';
$string['main_help_viewmodes_summary'] = 'In dem Learner Dashboard können Sie sich alle Inhalte in einer <span style="color:var(--diseablue)">Modul-, Semester-</span> und <span style="color:var(--diseablue)">Gesamtansicht</span> anzeigen lassen.<br><br><strong>Modulansicht</strong><br>In der Modulansicht werden Ihnen die Inhalte spezifisch für das Modul angezeigt, in dem Sie sich gerade befinden. Sie erhalten einen detaillierten Überblick über alle Ressourcen und Aktivitäten, die zu diesem Modul gehören.<br><br><strong>Semesteransicht</strong><br>Die Semesteransicht präsentiert Ihnen sämtliche Inhalte der Module, die Sie im laufenden Semester belegen. Diese Ansicht ermöglicht es Ihnen, einen umfassenden Einblick in Ihr aktuellen Semester zu erhalten.<br><br><strong>Gesamtansicht</strong><br>In der Gesamtansicht können Sie auf alle Inhalte Ihres Studiums zugreifen. Diese umfasst sämtliche Module und Aktivitäten, die Sie während Ihres gesamten Studienverlaufs absolviert haben oder aktuell absolvieren.';

$string['main_help_add_remove_title'] = "Hinzufügen oder Entfernen von Karten";
$string['main_help_add_remove_summary'] = 'Für das Hinzufügen oder Entfernen von Karten im Learner Dashboard können Sie wie folgt vorgehen:<br>
1. Klicken Sie auf das Stift-Symbol, um den Bearbeitungsmodus zu aktivieren.<br>
2. Zum Entfernen einer Karte: Suchen Sie die gewünschte Karte und klicken Sie auf das X-Symbol in der rechten oberen Ecke der Karte.<br>
3. Zum Hinzufügen neuer Karten: Scrollen Sie unterhalb Ihrer bereits ausgewählten Karten. Dort finden Sie die Option, zusätzliche Karten zum Dashboard hinzuzufügen. Wählen Sie die gewünschten Karten aus und fügen Sie sie Ihrem Dashboard hinzu.';

$string['main_help_functionality_title'] = "Wiederkehrende Funktionen innerhalb der Karten";
$string['main_help_functionality_summary'] = '<strong>Hilfe-Symbol auf dem Dashboard</strong><br>
Auf dem gesamten Dashboard befindet sich ein Hilfe-Symbol, das durch ein <span style="color:var(--diseablue)">“?”-Icon</span> dargestellt wird. Dieses Icon bietet Nutzern schnellen Zugang zu kontextbezogener Unterstützung und Erklärungen zur Funktionsweise des Dashboards.
<br><br><strong>Hilfe-Symbol auf den Karten</strong><br>
Jede einzelne Karte im Dashboard ist ebenfalls mit einem Hilfe-Symbol ausgestattet. Durch Anklicken dieses Symbols auf einer bestimmten Karte öffnet sich eine Detailansicht. Diese Ansicht liefert detaillierte Informationen zum Inhalt der jeweiligen Karte.';

$string['main_help_edit_title'] = "Bearbeitungsfunktion";
$string['main_help_edit_summary'] = 'Ein Klick auf das Stift-Symbol startet die Bearbeitungsfunktion zum Hinzufügen oder Löschen von Karten im Dashboard. Mit dieser Funktion können Sie sich Ihr Dashboard nach den eigenen Vorstellungen und mit den für Sie relevanten Karten zusammenstellen. Klicken Sie auf das rote X an der entsprechenden Karte, um diese zu entfernen. Eine neue Karte fügen Sie hinzu, wenn Sie den Button "Karte hinzufügen" wählen. Dieser Button öffnet einen neuen Dialog mit den zur Verfügung stehenden Karten.';

// Main help cards.
$string['main_help_assignment-view'] = 'Die Karte <span style="color:var(--diseablue)">Aufgabenübersicht</span> listet alle Einsendeaufgaben auf, die Ihnen in den entsprechenden Modulen zur Verfügung stehen und zeigt einen aktuellen Status der Aufgabe.';
$string['main_help_activity-view'] = 'Die Karte <span style="color:var(--diseablue)">Nutzungsaktivität</span> betrachtet Ihre Lernzeit auf einen Blick! Die farbigen Segmente repräsentieren unterschiedliche Aktivitäten und ihre Höhe zeigt die Dauer jeder Aktivität.';
$string['main_help_learning-goals-view'] = 'In der Karte <span style="color:var(--diseablue)">Lernziele</span> können Sie jegliche Lernziele festhalten. Diese Funktion können Sie auch Semesterübergreifend verwenden.';
$string['main_help_planner-view'] = 'Diese Karte <span style="color:var(--diseablue)">Planungsassistent</span> zeigt Ihnen einen Überblick über Ihre anstehenden Webkonferenzen, Einsendeaufgaben oder andere Aktivitäten.';
$string['main_help_progress-bar-view'] = 'In der Karte <span style="color:var(--diseablue)">Lesefortschrittsbalken</span> können Sie manuell Lernmaterialien hinzufügen und erhalten in Form eines Diagramms den aktuellen Lesefortschritt Ihrer aktuellen Lektüre.';
$string['main_help_study-progress-view'] = 'Das Speedometer in der Karte <span style="color:var(--diseablue)">Lernfortschrittsanzeige</span> zeigt Ihnen Ihren Lernfortschritt an und stellt dar, wie weit Sie auf dem Weg zum Ziel sind. Die Grundlage der Berechnung sind die Bewertungen in den Aufgaben, die für Sie im Kurs zugeordnet sind.';
$string['main_help_success-chance-view'] = 'In der Karte <span style="color:var(--diseablue)">PVL-Wahrscheinlichkeit</span> werden alle Einsendeaufgaben (inkl. Bewertungspunkte) dargestellt. Die jeweilige PVL-Wahrscheinlichkeit errechnet sich aus den Bewertungspunkten der einzelnen Abgaben und stellt diese als Prozentsatz dar.';


$string['main_add_view_title'] = "Karten hinzufügen";
$string['main_add_view_info_text'] = "Wählen Sie die gewünschten Karten aus, die Sie im DiSEA-Dashboard angezeigt haben möchten.";
$string['main_add_view_info_text_empty'] = "Sie haben alle verfügbaren Karten hinzugefügt.";

$string['main_config_title'] = "Konfiguration";
$string['main_config_desc'] = "Hier können Sie die Konfiguration für das Learner Dashboard vornehmen.";
$string['main_config_consent_title'] = "Datenverarbeitung";
$string['main_config_consent_desc'] = "Sie haben der Datenverarbeitung zugestimmt.";
$string['consent_config_title'] = "Datenverarbeitung";
$string['consent_config_desc'] = "Möchten Sie die Einwilligung zur Datenverarbeitung widerrufen? Das Learner Dashboard kann daraufhin nicht mehr genutzt werden und es werden folgende Daten gelöscht:";
$string['consent_config_list_item_1'] = "Selbstdefinierte Lernziele";
$string['consent_config_list_item_2'] = "Einstellungen zum Lesefortschritt";
$string['consent_config_list_item_3'] = "Termine des Planungsassistenten";
$string['consent_config_link'] = "Datenschutzerklärung lesen";
$string['consent_config_btn_cancel'] = "Abbrechen";
$string['consent_config_btn_delete'] = "Daten löschen und widerrufen";
$string['consent_config_btn_save'] = "Daten behalten und widerrufen";
$string['no-view-exists'] = "Starten Sie die Bearbeitungsfunktion zum Hinzufügen von Karten, indem Sie das Stift-Symbol anklicken.";

$string['optional_inputs-view_help_info_text'] = 'Bleiben Sie bezüglich Ihres Lernfortschritts auf dem Laufenden und geben Sie hier zu den bereitgestellten Dokumenten des Kurses Ihren Fortschritt an, klicken Sie zum Hinzufügen eines Dokumentes unter "Lernmaterialien des Kurses hinzufügen" auf den Button.<p><strong>Dokument:</strong> Auswahl eines im Kurs zur Verfügung gestellten Dokumentes.<p><strong>Aktuelle Seite:</strong> Eingabe der Seite auf der Sie sich im Dokument befinden.<p><strong>Letzte Seite:</strong> Tragen Sie hier ein, wie viele Seiten das Dokument insgesamt hat.</p><p><strong>Zeitaufwand (in Stunden):</strong> Tragen Sie hier den geschätzten Zeitaufwand ein.</p>
<p>Mit dem Button "Speichern" schließen Sie den Vorgang ab und speichern den Fortschritt in Ihrem persönlichen Bereich.</p>

<p>Unter "Lernmaterialien des Kurses verwalten" können Sie Ihre bereits eingetragenen Materialien bearbeiten oder einzelne Lesefortschritte aus Ihrem persönlichen Bereich entfernen.</p>';

// Study progress view.
$string['study-progress-view'] = "Lernfortschrittsanzeige";
$string['study-progress_infotext_bad'] = "Der Lernfortschritt ist momentan nicht optimal.";
$string['study-progress_infotext_average'] = 'Der Lernfortschritt ist momentan <span style="color: var(--diseablue)">mittelmäßig</span>.';
$string['study-progress_infotext_good'] = "Der Lernfortschritt ist momentan sehr gut.";
$string['study-progress-view_help_info_text'] = "Das Speedometer zeigt Ihnen Ihren Lernfortschritt an und stellt dar, wie weit Sie auf dem Weg zum Ziel sind. Die Grundlage der Berechnung sind die Bewertungen in den Aufgaben, die für Sie im Kurs zugeordnet sind.";
$string['study-progress-view_help_info_text_expanded'] = "Das Speedometer zeigt Ihnen Ihren Lernfortschritt an und stellt dar, wie weit Sie auf dem Weg zum Ziel sind. Die Grundlage der Berechnung sind die Bewertungen in den Aufgaben, die für SIe im Kurs zugeordnet sind. Unterhalb des Speedometers finden Sie eine Aufstellung, der dieser Berechnung zu Grunde liegt.";
$string['study-progress_expanded_title'] = "Bewertung der Einflussgrößen";
$string['study-progress_expanded_desc'] = "Die Gesamtbewertung für das laufende Semester basiert auf verschiedenen Werten und wird unterschiedlich gewichtet:";
$string['study-progress_activity_weight'] = "% Moodle-Aktivitäten";
$string['study-progress_doc_weight'] = "% Fortschritt in den Lernmaterialien";
$string['study-progress_assign_weight'] = "% Bearbeitung von Einsendeaufgaben";
$string['study-progress_activity'] = "Moodle-Aktivitäten";
$string['study-progress_doc'] = "Lernmaterialien";
$string['study-progress_assign'] = "Einsendeaufgaben";
$string['study-progress_score_is'] = "Der Score ist ";
$string['study-progress_eval_course'] = "Bewertung für Ihren Kurs";
$string['study-progress_eval_halfyear'] = "Bewertung für Ihr Semester";
$string['study-progress_eval_global'] = "Bewertung für Ihr Studium";

// Success chance view.
$string['success-chance-view'] = 'PVL-Wahrscheinlichkeit';
$string['success-chance-view_help_info_text'] = '<p>In der Karte "PVL-Wahrscheinlichkeit" werden alle Einsendeaufgaben (inkl. Bewertungspunkte) vollständig dargestellt. Die jeweilige PVL-Wahrscheinlichkeit errechnet sich aus den Status der einzelnen Abgaben und stellt diese als Prozentsatz dar.</p> <p><span style="color: var(--diseablue)">HINWEIS</span><br> Bitte beachten Sie, dass der Wert der "PVL-Wahrscheinlichkeit" lediglich auf Basis der vergangenen Einsendeaufgaben berechnet wird. Es ist wichtig zu verstehen, dass eine hohe PVL-Wahrscheinlichkeit daher keine Garantie für Erfolg bedeutet und dass eine gewisse Unsicherheit besteht. Letztendlich hängt Ihr Erfolg von vielen Faktoren ab, einschließlich Ihrer Anstrengungen und Umstände, die außerhalb unserer Kontrolle liegen. Nutzen Sie die PVL-Wahrscheinlichkeit als eine Orientierungshilfe, aber lassen Sie sich nicht entmutigen, wenn Ihre tatsächlichen Ergebnisse davon abweichen.';
$string['success-chance-view_help_info_text_expanded'] = 'In der Detailansicht der "PVL-Wahrscheinlichkeit" erhalten Sie eine vollständige Auflistung der Einsendeaufgaben und deren Status, die zur Berechnung der PVL-Wahrscheinlichkeit beitragen.';
$string['success-chance_info_text'] = 'Betrachten Sie die PVL-Wahrscheinlichkeit: Die PVL-Wahrscheinlichkeit zeigt Ihnen, wie viele Bewertungspunkte Sie erhalten haben.';
$string['success-chance_info_text_expanded'] = 'Die PVL-Wahrscheinlichkeit zeigt Ihnen den Status der Einsendeaufgaben an.';
$string['pvl_success-chance-chart-text'] = 'PVL-Wahrscheinlichkeit';
$string['success-chance-label-failed'] = 'PVL-Wahrscheinlichkeit';
$string['success-chance_no_course_available'] = 'Sie sind in keinem Kurs des ausgewählten Semesters eingeschrieben, für den eine PVL-Wahrscheinlichkeit berechnet werden kann.';


$string['pvl_assignment_info_text_summary_modul'] = 'Im laufenden Modul sieht Ihre Bilanz wie folgt aus:';
$string['pvl_assignment_info_text_summary_semester'] = 'Im laufenden Semester sieht Ihre Bilanz wie folgt aus:';
$string['pvl_assignment_info_text_summary_global'] = 'Im gesamten Studium sieht Ihre Bilanz wie folgt aus:';
$string['pvl_assignment_info_text_okay'] = 'Einsendeaufgaben sind bestanden.';
$string['pvl_assignment_info_text_incomplete'] = 'Einsendeaufgaben sind unvollständig.';
$string['pvl_assignment_info_text_submitted'] = 'Einsendeaufgaben sind abgegeben.';
$string['pvl_assignment_info_text_notsubmitted'] = 'Einsendeaufgaben sind noch nicht abgegeben.';
$string['pvl_assignment_info_text_selfcheck'] = 'Einsendeaufgaben sind als erledigt markiert.';
$string['pvl_assignment_info_text_failed'] = 'Einsendeaufgaben sind nicht bestanden.';
$string['pvl_assignment_view_hover_okay'] = 'Einsendeaufgaben sind vollständig.';
$string['pvl_assignment_view_hover_incomplete'] = 'Einsendeaufgaben sind noch nicht vollständig';

$string['status'] = 'Status';
$string['success-chance-failed-text'] = 'nicht bestanden';
$string['success-chance-okay-text'] = 'bestanden';
$string['success-chance-submitted-text'] = 'abgegeben';
$string['success-chance-notsubmitted-text'] = 'nicht abgegeben';
$string['success-chance-incomplete-text'] = 'unvollständig';
$string['success-chance-selfcheck-text'] = 'ist als erledigt markiert, muss ggf. noch vom Lehrenden geprüft werden';

$string['assignmentscore'] = 'Aufgabengewichtung';
$string['progress-bar_nodata'] = 'Es sind derzeit keine Lesefortschritte festgehalten. Fügen Sie jetzt den Lesefortschritt Ihres Lernmaterials hinzu.';
$string['activity_view_expanded_subtitle'] = "Anmeldungen im Monat";
$string['study-progress_expanded_info_text'] = 'Die "Aufgabengewichtung" wird anhand der bereitgestellten Aufgaben in diesem Kurs berechnet. Jeder Aufgabe wird ein Wert zugewiesen, der sich nach dem Status richtet: "negativ (rotes X)", "neutral (grauer Kreis oder gelbes Dreieck)" oder "positiv (grünes Häkchen)".';

$string['nodata'] = 'Es sind keine Daten vorhanden.';
$string['activity_view_refresh'] = "Letzte Aktualisierung";

$string['task_tasktransform'] = 'Tasktransformation';
$string['task_statistics'] = 'Statistiken';

// Planner view.
$string['planner-view'] = 'Planungsassistent';
$string['planner-view_help_info_text'] = "Diese Karte zeigt Ihnen einen Überblick über Ihre anstehenden Webkonferenzen, Einsendeaufgaben oder andere Aktivitäten. Zudem können Sie Termine hinzufügen, indem Sie einen einfachen Klick auf einen Tag ihrer Wahl tätigen. In der Detailansicht können Sie alle Termine einsehen.";
$string['planner-view_help_info_text_expanded'] = "Diese Karte zeigt Ihnen einen Überblick über Ihre anstehenden Webkonferenzen, Einsendeaufgaben oder andere Aktivitäten. Zudem können Sie Termine hinzufügen, indem Sie einen einfachen Klick auf einen Tag ihrer Wahl tätigen. In der Detailansicht können Sie alle Termine einsehen.";
$string['planner-view_monday_short'] = "Mo";
$string['planner-view_tuesday_short'] = "Di";
$string['planner-view_wednesday_short'] = "Mi";
$string['planner-view_thursday_short'] = "Do";
$string['planner-view_friday_short'] = "Fr";
$string['planner-view_saturday_short'] = "Sa";
$string['planner-view_sunday_short'] = "So";
$string['planner-view_today_label'] = "Heute";
$string['planner-view_global_label'] = "Termine im Monat";
$string['planner-view_tomorrow_label'] = "Morgen";
$string['planner-view_thismonth_label'] = "Dieser Monat";
$string['planner-view_infuture_label'] = "Zukünftig";
$string['planner_add_event_modal'] = "Termin zum Planungsassistenten hinzufügen";
$string['planner_add_event_modal_desc'] = "Hier können Sie einen Termin zu Ihrem Planungsassistenten hinzufügen";
$string['planner_event_name_label'] = "Titel";
$string['planner_event_name_placeholder'] = "Neuer Termin";
$string['planner_event_date_label'] = "Datum";
$string['planner_event_location_label'] = "Ort";
$string['planner_event_location_placeholder'] = "Neuer Ort";
$string['planner_event_course_label'] = "Zugehöriger Kurs";
$string['planner_event_type_label'] = "Veranstaltungsart";
$string['planner_event_type_value_1'] = "Webkonferenz";
$string['planner_event_type_value_2'] = "Präsenzveranstaltung";
$string['planner_event_type_value_3'] = "Sonstiges";
$string['planner_event_duration_label'] = "Dauer";
$string['planner_event_no-end_label'] = "Ohne Zeitangabe";
$string['planner_event_until_label'] = "Bis";
$string['planner_event_duration-in-min_label'] = "Dauer in Minuten";
$string['planner_event_repetitions_label'] = "Wöchentliche Wiederholung, automatische Erstellung";
$string['planner_event_repetitions_text'] = "Termin wiederholen";
$string['planner_required_attribute'] = "notwendig";
$string['planner_cancel_event'] = "Abbrechen";
$string['planner_save_event'] = "Speichern";
$string['planner_delete_event'] = "Löschen";
$string['planner_edit_event'] = "Bearbeiten";
$string['planner_date_invalid'] = "Bitte geben Sie eine korrekte Zeit für den Termin an.";
$string['planner_name_missing'] = "Bitte geben Sie einen Titel für den Termin an.";
$string['planner_name_invalid'] = 'Bitte verwenden Sie nur Buchstaben, Zahlen, Leerzeichen und die Sonderzeichen "?!.:-/@".';
$string['planner_input_invalid'] = 'Der Termin konnte nicht angelegt werden. Bitte überprüfen Sie Ihre Eingaben.';
$string['planner_repetition_invalid'] = 'Bitte geben Sie eine korrekte Zahl für die Wiederholungen an.';
$string['planner_event-details-activity'] = 'Zur Aktivität';

// Views.
$string['viewmode_module'] = 'Modulansicht';
$string['viewmode_global'] = 'Gesamtansicht';
$string['viewmode_halfyear'] = 'Semesteransicht';

$string['task_tasktransform'] = 'Tasktransformation';


$string['config_title'] = 'Kurs f&uuml;r Logdaten';
$string['config_text'] = 'Bitte geben Sie hier die Kurs ID f&uuml;r den Kurs ein, in dem die Logdaten gespeichert werden sollen.';

$string['config_key_title'] = '&Ouml;ffentlicher Schl&uuml;ssel zum Verschl&uuml;sseln der Daten';
$string['config_key_text'] = 'Bitte f&uuml;gen Sie hier den &ouml;ffentlichen Schl&uuml;ssel ein.';

$string['config_consent_text'] = 'Ihre Einwilligungserkl&auml;rung';
$string['config_consent_description'] = 'Bitte geben Sie hier ihre Einwilligungserkl&auml;rung als HTML formatierten Text ein.';

$string['config_counter_title'] = 'Counter f&uuml;r Anzeige der Einwilligungserkl&auml;rung';
$string['config_counter_text'] = '&Uuml;ber diesen Counter kann gesteuert werden, wann die Einwilligungserkl&auml;rung erneut f&uuml;r die Studierenden angezeigt werden soll.';

$string['config_filterfile_title'] = 'CSV-Datei f&uuml;r Eventfilterung';
$string['config_filterfile_text'] = 'Diese Einstellung erm&ouml;glicht eine CSV-Datei mit zu filternden event-, target- und action-Namen hochzuladen.';

$string['config_componentlist_title'] = 'Component-CSV f&uuml;r Component Redefinition';
$string['config_componentlist_text'] = 'Diese Einstellung erm&ouml;glicht eine CSV-Datei mit zu ersetzenden component-Namen hochzuladen.';

$string['agree'] = '<strong>Ich willige ein</strong>, dass meine Moodle Logdaten, wie auch die Pr&uuml;fungsdaten an das DiSEA-Projekt weitergegeben, gespeichert und zu Forschungszwecken genutzt werden.';
$string['disagree'] = '<strong>Ich willige nicht ein</strong>, dass meine Moodle Logdaten, wie auch die Pr&uuml;fungsdaten an das DiSEA-Projekt weitergegeben, gespeichert und zu Forschungszwecken genutzt werden.';
$string['no_choice'] = 'Bitte entscheiden Sie sich f&uuml;r eine Antwort!';

$string['database_insert'] = 'Erfolgreich in der Datenbank eingetragen';
$string['database_update'] = 'Erfolgreich Datenbank aktualisiert';

$string['edit'] = 'Bearbeiten';

$string['choice_no'] = 'Sie haben die Einwilligung abgelehnt';
$string['choice_yes'] = 'Sie haben die Einwilligung angenommen';

$string['messageprovider'] = 'DiSEA Message Provider';
$string['messageprovider:logdata_disea'] = 'DiSEA Message Provider';

$string['download'] = 'Herunterladen';
$string['back'] = 'Zur&uuml;ck';
$string['delete'] = 'Entfernen';

$string['activity_view_axislabel_y'] = 'Y-Achse: Minuten';
$string['activity_view_main_axislabel_x'] = 'X-Achse: Tage';
$string['activity_view_detail_axislabel_x'] = 'X-Achse: Kalenderwochen';
// Privacy API.
// For: block_disealytics_consent.
$string['privacy:metadata:block_disealytics_consent'] = 'Zustimmung zu den Datenschutzbestimmungen.';
$string['privacy:metadata:consent_userid'] = 'Die ID des Benutzers mit diesen Datenschutzinformationen.';
$string['privacy:metadata:consent_counter'] = 'Ein Zähler, um zu festzulegen, wann die Datenschutzinformationen zurückgesetzt werden sollen.';
$string['privacy:metadata:consent_choice'] = 'Die Auswahl des Benutzers, 0 für Ablehnung, 1 for Zustimmung.';
$string['privacy:metadata:consent_timecreated'] = 'Der Zeitpunkt, an dem dieser Datenschutzeintrag erstellt wurde.';
$string['privacy:metadata:consent_timemodified'] = 'Der Zeitpunkt, an dem dieser Datenschutzeintrag bearbeiet wurde.';

// For: block_disealytics_user_goals.
$string['privacy:metadata:block_disealytics_user_goals'] = 'Lernziele erstellt von den Benutzern des Learner Dashboards.';
$string['privacy:metadata:user_goal_usermodified'] = 'Die ID des Benutzers, der diesen Lernzieleintrag verändert hat.';
$string['privacy:metadata:user_goal_courseid'] = 'Die ID des Kurses, in dem der Lernzieleintrag erstellt wurde.';
$string['privacy:metadata:user_goal_userid'] = 'Die ID des Benutzers mit diesen Lernzielinformationen.';
$string['privacy:metadata:user_goal_timecreated'] = 'Der Zeitpunkt, an dem dieser Lernzieleintrag erstellt wurde.';
$string['privacy:metadata:user_goal_timemodified'] = 'Der Zeitpunkt, an dem dieser Lernzieleintrag bearbeiet wurde.';
$string['privacy:metadata:user_goal_timecompleted'] = 'Der Zeitpunkt, an dem dieser Lernzieleintrag als erledigt markiert wurde.';
$string['privacy:metadata:user_goal_duedate'] = 'Der Zeitpunk, an dem das Lernziel erledigt sein soll.';
$string['privacy:metadata:user_goal_description'] = 'Die Beschreibung des Ziels.';
$string['privacy:metadata:user_goal_finished'] = 'Zeigt an, ob das Lerziel erreicht ist.';

// For: block_disealytics_pages.
$string['privacy:metadata:block_disealytics_user_pages'] = 'Information über gelesene Dokumentseiten, erstellt von Benutzern des Learner Dashboard.';
$string['privacy:metadata:user_pages_usermodified'] = 'Die ID des Benutzers, der diesen Seiteneintrag verändert hat.';
$string['privacy:metadata:user_pages_courseid'] = 'Die ID des Kurses, in dem der Seiteneintag erstellt wurde.';
$string['privacy:metadata:user_pages_userid'] = 'Die ID des Benutzers mit diesen Seiteninformationen.';
$string['privacy:metadata:user_pages_timecreated'] = 'Der Zeitpunkt, an dem dieser Lesefortschritteintrag erstellt wurde.';
$string['privacy:metadata:user_pages_timemodified'] = 'Der Zeitpunkt, an dem dieser Lesefortschritteintrag bearbeitet wurde.';
$string['privacy:metadata:user_pages_timecompleted'] = 'Der Zeitpunkt, an dem der Seiteneintrag als erledigt markiert wurde.';
$string['privacy:metadata:user_pages_name'] = 'Der Name des Dokumentes.';
$string['privacy:metadata:user_pages_currentpage'] = 'Die Anzahl der Seiten, die der Benutzer gelesen hat.';
$string['privacy:metadata:user_pages_lastpage'] = 'Die Gesamtzahl der Seites des Dokumentes';
$string['privacy:metadata:user_pages_expenditureoftime'] = 'Die Zeit, die der Benutzer das Dokument gelesen hat.';

// For: block_disealytics_user_tasks.
$string['privacy:metadata:block_disealytics_user_tasks'] = 'Task Informationen erzeugt von der Tasktransformation, die Aktivitäten in Logdaten gruppiert.';
$string['privacy:metadata:user_tasks_component'] = 'Die Komponente, aus den Logdaten.';
$string['privacy:metadata:user_tasks_target'] = 'Das Ziel, aus den Logdaten.';
$string['privacy:metadata:user_tasks_action'] = 'Die Aktion, aus den Logdaten.';
$string['privacy:metadata:user_tasks_eventname'] = 'Der Name des Events, kombiniert Komponenten-, Ziel- and Aktionsname.';
$string['privacy:metadata:user_tasks_courseid'] = 'Die ID des Kurses, in dem der Taskeintrag erstellt wurde.';
$string['privacy:metadata:user_tasks_userid'] = 'Die ID des Benutzers mit diesen Taskinformationen.';
$string['privacy:metadata:user_tasks_timestart'] = 'Der Zeitpunkt, an dem der erste Eintrag aus dem Task stattfand.';
$string['privacy:metadata:user_tasks_n_events'] = 'Die Anzahl der Logeinträge in diesem Task.';
$string['privacy:metadata:user_tasks_duration'] = 'Die Dauer des Tasks in Sekunden.';
$string['privacy:metadata:user_tasks_timecreated'] = 'Der Zeitpunkt, an dem dieser Taskeintrag erstellt wurde.';

// For: block_disealytics_user_dates.
$string['privacy:metadata:block_disealytics_user_dates'] = 'Von Benutzern im Planungsassistenten des Learner Dashboards erstelle Planungseinträge.';
$string['privacy:metadata:user_dates_name'] = 'Der Name des Eintrags.';
$string['privacy:metadata:user_dates_usermodified'] = 'Die ID des Benutzers, der diesen Planungseintrag verändert hat.';
$string['privacy:metadata:user_dates_courseid'] = 'Die ID des Kurses, in dem der Planungseintrag erstellt wurde.';
$string['privacy:metadata:user_dates_userid'] = 'Die ID des Benutzers mit diesen Planungsinformationen.';
$string['privacy:metadata:user_dates_timecreated'] = 'Der Zeitpunkt, an dem dieser Planungseintrag erstellt wurde.';
$string['privacy:metadata:user_dates_timemodified'] = 'Der Zeitpunkt, an dem dieser Planungseintrag bearbeitet wurde.';
$string['privacy:metadata:user_dates_timestart'] = 'Der Zeitpunkt, an dem dieser Planungseintrag beginnt.';
$string['privacy:metadata:user_dates_timeduration'] = 'Die Dauer des Planungseintrags.';
$string['privacy:metadata:user_dates_location'] = 'Der Ort des Planungseintrags.';
$string['privacy:metadata:user_dates_eventtype'] = 'Der Typ des Planungseintrags.';
$string['privacy:metadata:user_dates_repeatid'] = 'Die ID, die benutzt wird, um sich wiederholende Planungseinträge zu verfolgen.';

// For: block_disealytics_statistics.
$string['privacy:metadata:block_disealytics_statistics']  = "Benutzungsstatistiken erzeugt vom Statistik-Task.";

$string['privacy:metadata:preference:block_disealytics_editing'] = "Speichert, ob der Bearbeitungsmodus aktiv ist.";
$string['privacy:metadata:preference:block_disealytics_expanded_view'] = "Die Karte, deren Detailansicht angezeigt wird.";
$string['privacy:metadata:preference:block_disealytics_planner_currentdate'] = "Das Datum, was der Planungsassistent nutzt, um den Monat anzuzeigen.";
$string['privacy:metadata:preference:block_disealytics_views'] = "Speichert welche Karten im Learner Dashboard angezeigt werden.";
$string['privacy:metadata:preference:block_disealytics_viewmode'] = "Speichert welche Ansicht (Modul-, Semester-, Gesamtansicht) angezeigt wird.";

$string['privacy:metadata:preference:block_disealytics_viewsdescription'] = "Serialisierte Daten, die beschreiben welche Karten im Learner Dashboard angezeigt werden. Gespeichert als Objekte mit Kartennamen und ob die Karte aktiviert (enabled: 1) oder deaktiviert  (enabled: 0) ist.";

$string['editingno'] = "Bearbeitungsmodus im Learner Dashboard deaktiviert";
$string['editingyes'] = "Bearbeitungsmodus im Learner Dashboard aktiviert";

$string['expandedno'] = "Keine Detailansicht im Learner Dashboard ist aktiviert.";
$string['plannerdateno'] = "Der Standardwert für das Datum im Planungsassistenten, beschreibt 'jetzt'.";
$string['viewmode_selected'] = "ist die angezeigte Ansicht des Learner Dashboard.";
