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

$string['pluginname'] = 'DiSEA Dashboard';
$string['plugin-title'] = 'Learning Dashboard';
$string['disea'] = 'DiSEA Learning Dashboard';
$string['disealytics:addinstance'] = 'Füge einen neuen DiSEA Dashboard Block hinzu.';
$string['disealytics:myaddinstance'] = 'Füge einen neuen DiSEA Dashboard Block zu meinem Dashboard hinzu.';
$string['languagesetting'] = 'de';
$string['consent_start_msg'] = 'Um das Plugin nutzen zu können, müssen Sie der Datenverarbeitung zustimmen.';
$string['consent_start_btn'] = 'Einwilligen und Dashboard nutzen';
$string['change-to-expandable-view'] = 'Zur Detailansicht ...';

$string['nouserconsent'] = 'Einwilligung für die Datenverarbeitung erforderlich.';

$string['diseasettings'] = 'DiSEA Learningdashboard Einstellungen';
$string['activityviewsetting'] = 'Aktivitätsübersicht anzeigen';
$string['assignmentviewsetting'] = 'Aufgabenübersicht anzeigen';
$string['editing_mode_setting'] = 'Aktiviere den Editiermodus';
$string['exit_editing_mode'] = 'Beenden';
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
$string['testfooter'] = 'Das DiSEA Dashboard wird geladen.';

// Selection Form.
$string['select_view'] = 'Ansichtauswahl';

// Activity view.
$string['activity-view'] = "Nutzungsaktivität";
$string['activity_help_info_text'] = "Betrachten Sie Ihre Lernzeit im Überblick! Die farbigen Segmente repräsentieren unterschiedliche Aktivitäten und ihre Höhe zeigt die Dauer jeder Aktivität. Im Aktivitätsdiagramm werden verschiedene Werte entsprechend den Aktivitäten in Moodle gruppiert dargestellt. Diese Werte können je nach Aktivität unterschiedlich sein. Das System analysiert alle Aktivitäten und gruppiert sie, wobei die Aktivitäten mit der längsten Dauer im Aktivitätsdiagramm angezeigt werden.";
$string['activity_help_info_text_expanded'] = "Die Detailansicht der Karte \"Aktivität\" zeigt Ihnen das bekannte Diagramm zu den Zusammenfassungen in Ihrem Kurs und weitere Graphen zu Ihren Aktivitäten mit zusätzlichen Informationen.";

// Assignment view.
$string['assignment-view'] = 'Aufgabenübersicht';
$string['assignment_help_info_text'] = "Die Karte \"Aufgaben\" listet alle Aufgaben des Kurses auf, die Ihnen zur Verfügung stehen und zeigt einen aktuellen Status der Aufgabe. Wenn Sie auf den Link zu einer Aufgabe klicken, gelangen Sie auf die Seite mit den Details zu dieser Aufgabe. <h4><span style='color: var(--diseablue)'>Symbolbedeutung:</span></h4> <p> <span style='color: var(--diseablue)'>Neutraler Status (Grauer Kreis):</span> Der grau ausgefüllte Kreis steht für einen neutralen Status der Aufgabe. Hier besteht kein Handlungsbedarf. <p> <span style='color: var(--diseablue)'>Nicht bestanden (Rotes 'X')</span> Das rote  \"X\" weist darauf hin, dass die entsprechende Aufgabe bewertet, aber nicht bestanden wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>  Noch nicht bearbeitet (Graues \"X\"):</span> Das graue \"X\" weist darauf hin, dass die entsprechende Aufgabe noch nicht abgegeben / bearbeitet wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Unvollständig (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p><span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil):</span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>Unvollstaendig/Warnung (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p> <span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil): </span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'> Selbst als erledigt markiert (Gelber Pfeil): </span> Der gelbe Pfeil weist darauf hin, dass die Aufgabe vom Studierenden selbst als erledigt markiert wurde, aber gegebenenfalls noch vom Lehrenden überprüft werden muss. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Bestanden (Grüner Pfeil): </span> Der grüne Pfeil weist darauf hin, dass die Aufgabe bestanden ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.";
$string['assignment_help_info_text_expanded'] = "Die Karte \"Aufgaben\" listet alle Aufgaben des Kurses auf, die Ihnen zur Verfügung stehen und zeigt einen aktuellen Status der Aufgabe. Wenn Sie auf den Link zu einer Aufgabe klicken, gelangen Sie auf die Seite mit den Details zu dieser Aufgabe. <h4><span style='color: var(--diseablue)'>Symbolbedeutung:</span></h4> <p> <span style='color: var(--diseablue)'>Neutraler Status (Grauer Kreis):</span> Der grau ausgefüllte Kreis steht für einen neutralen Status der Aufgabe. Hier besteht kein Handlungsbedarf. <p> <span style='color: var(--diseablue)'>Nicht bestanden (Rotes 'X')</span> Das rote  \"X\" weist darauf hin, dass die entsprechende Aufgabe bewertet, aber nicht bestanden wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>  Noch nicht bearbeitet (Graues \"X\"):</span> Das graue \"X\" weist darauf hin, dass die entsprechende Aufgabe noch nicht abgegeben / bearbeitet wurde. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Unvollständig (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p><span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil):</span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'>Unvollstaendig/Warnung (Gelbes Warnzeichen):</span> Das gelbe Warnzeichen zeigt an, dass die Aufgabe unvollständig ist, die Aufgabe noch nicht bearbeitet werden kann, weil noch Voraussetzungen fehlen oder gegebenenfalls nach dem Fälligkeitsdatum abgegeben wurde. Außerdem kann es sein, dass die Aufgabe zwar nicht bestanden wurde, aber noch weitere Versuche möglich sind. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.  <p> <span style='color: var(--diseablue)'>Rechtzeitig abgegeben (Grauer Pfeil): </span> Der graue Pfeil weist darauf hin, dass eine rechtzeitige Abgabe erfolgt ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p> <span style='color: var(--diseablue)'> Selbst als erledigt markiert (Gelber Pfeil): </span> Der gelbe Pfeil weist darauf hin, dass die Aufgabe vom Studierenden selbst als erledigt markiert wurde, aber gegebenenfalls noch vom Lehrenden überprüft werden muss. Für weitere Details klicken Sie bitte auf den Link der Aufgabe. <p><span style='color: var(--diseablue)'>Bestanden (Grüner Pfeil): </span> Der grüne Pfeil weist darauf hin, dass die Aufgabe bestanden ist. Für weitere Details klicken Sie bitte auf den Link der Aufgabe.";
$string['assignment_info_text'] = "Hier sehen Sie Ihren Status der zur Verfügung stehenden Aufgaben des Kurses.";
$string['assignment_view_hover_failed'] = 'Aufgaben nicht bestanden';
$string['assignment_view_hover_okay'] = 'Aufgaben bestanden';
$string['assignment_view_hover_notsubmitted'] = 'Aufgabe noch nicht abgegeben';
$string['assignment_view_hover_submitted'] = 'Aufgabe abgegeben, aber noch nicht bewertet';
$string['assignment_view_hover_incomplete'] = 'Aufgabe unvollständig, nach Fälligkeit eingereicht, mit fehlender Voraussetzung oder im ersten Versuch nicht bestanden';
$string['assignment_view_hover_selfcheck'] = 'Aufgabe wurde als erledigt markiert, ist ggf. aber noch vom Lehrenden zu prüfen';
$string['assignment_view_hover_neutral'] = 'Neutraler Status. Es besteht kein Handlungsbedarf';
$string['assignment_view_load-less-assignments'] = 'Weniger anzeigen';

// Learninggoals view.
$string['learning-goals-view'] = 'Lernziele';
$string['learning-goals_info_text'] = 'Setzen Sie sich individuelle Lernziele, die Sie zu einem festen Zeitpunkt erreichen wollen.';
$string['learning-goals_help_info_text'] = "Die Karte \"Lernziele\" zeigt Ihnen die individuellen Ziele für Ihr Studium an. Im oberen Bereich können Sie über den Button \"Neues Lernziel hinzufügen\" eine kurze Beschreibung des Ziels eingeben und ein individuelles Datum festlegen, bis zu welchem Datum Sie das Ziel erreichen wollen. Sobald Sie das Ziel erreicht haben, können Sie es mithilfe des Kontrollkästchens als abgeschlossen markieren. Die Ziele sind chronologisch unter den Reitern \"Heute\", \"Morgen\", \"Diese Woche\", \"Dieser Monat\" und \"Zukünftig\" zu finden. Unter dem Reiter \"Erledigt\" finden Sie alle bereits markierten Ziele und können diese final aus der Liste löschen.";
$string['learning-goals_help_info_text_expanded'] = "Die Karte \"Lernziele\" zeigt Ihnen die individuellen Ziele für Ihr Studium an. Im oberen Bereich können Sie über den Button \"Neues Lernziel hinzufügen\" eine kurze Beschreibung des Ziels eingeben und ein individuelles Datum festlegen, bis zu welchem Datum Sie das Ziel erreichen wollen. Sobald Sie das Ziel erreicht haben, können Sie es mithilfe des Kontrollkästchens als abgeschlossen markieren. Die Ziele sind chronologisch unter den Reitern \"Heute\", \"Morgen\", \"Diese Woche\", \"Dieser Monat\" und \"Zukünftig\" zu finden. Unter dem Reiter \"Erledigt\" finden Sie alle bereits markierten Ziele und können diese final aus der Liste löschen.";
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
$string['progress-bar_help_info_text'] = 'Der Lesefortschrittsbalken zeigt Ihnen den Lesefortschritt Ihrer aktuellen Lektüre.<p><strong>Hinzufügen von Lernmaterialien</strong></p><p>In der Standardeinstellung ist die Karte leer. Sie können dieser Karte den Fortschritt der Lernmaterialien dieses Kurses über das Zahnrad rechts oben in der Karte hinzufügen.</p><p><strong>Grafikdaten anzeigen</strong></p><p>Dies zeigt Ihnen eine detaillierte Tabelle mit den Lernmaterialien, die Sie eingegeben haben, an.';

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
$string['optional_input_no_optional_input_exists'] = 'Keine Inhalte vorhanden. Um welche hinzuzufügen, klicken Sie auf "Lernmaterialien hinzufügen" und wählen das gewünschte Dokument aus.';
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

$string['main_help_title'] = "Hilfeseite zum Learning Dashboard";
$string['main_help_views_summary'] = "Systematik Karten";
$string['main_help_views_details'] = "Das Learning Dashboard (LD) beinhaltet Karten in denen verschiedene Informationen oder Funktionen inkludiert sind. Karten lassen sich dem LD hinzufügen und wieder löschen. Es gibt viele verschiedene Themen aus denen Sie Ihr persönliches LD zusammenstellen können. Informationen zu den verschiedenen Themen erhalten Sie jeweils über die Hilfefunktion in den einzelnen Karten.";
$string['main_help_add_remove_summary'] = "Hinzufügen oder entfernen von Karten";
$string['main_help_add_remove_details'] = "Zum hinzufügen oder entfernen von Karten klicken Sie in der Gesamtansichtsseite auf das Stift-Symbol. Danach können Sie einzelne Karten über das eingeblendete “x”-Symbol an der rechten oberen Ecke einer Karte entfernen. Unter Ihren gewählten Karten im LD haben Sie die Möglichkeit, weitere Karten dem LD hinzuzufügen.";
$string['main_help_help_summary'] = "Wiederkehrende Funktionen innerhalb der Karten";
$string['main_help_help_details'] = "Jede Karte und das Dashboard selbst enthält ein Hilfe-Symbol (“?”-Icon). Die Karten beinhalten ein Symbol zum Aufrufen einer Detailansicht einer Karte. Mit dem Hilfe-Symbol rufen Sie kontextbezogene Hilfe zum Inhalt einer Karte auf.";
$string['main_help_edit_summary'] = "Bearbeitungsfunktion";
$string['main_help_edit_details'] = "Ein Klick auf das Stift-Symbol startet die Bearbeitungsfunktion zum Hinzufügen oder Löschen von Karten im Dashboard (siehe Abbildung 1). Mit dieser Funktion können Sie sich Ihr Dashboard nach den eigenen Vorstellungen und mit den für Sie relevanten Karten zusammenstellen. Klicken Sie auf das rote X an der entsprechenden Karte, um diese zu entfernen. Eine neue Karte fügen Sie hinzu, wenn Sie den Button \"Karte hinzufügen\" wählen. Dieser Button öffnet einen neuen Dialog mit den zur Verfügung stehenden Karten.";
$string['main_add_view_title'] = "Karten hinzufügen";
$string['main_add_view_info_text'] = "Wählen Sie die gewünschten Karten aus, die Sie im DiSEA-Dashboard angezeigt haben möchten.";
$string['main_add_view_info_text_empty'] = "Sie haben alle verfügbaren Karten hinzugefügt.";

$string['main_config_title'] = "Konfiguration";
$string['main_config_desc'] = "Hier können Sie die Konfiguration für das Learning Dashboard vornehmen.";
$string['main_config_consent_title'] = "Datenverarbeitung";
$string['main_config_consent_desc'] = "Sie haben der Datenverarbeitung zugestimmt.";
$string['consent_config_title'] = "Datenverarbeitung";
$string['consent_config_desc'] = "Möchten Sie die Einwilligung zur Datenverarbeitung widerrufen? Das Lernenden-Dashboard kann daraufhin nicht mehr genutzt werden und es werden folgende Daten gelöscht:";
$string['consent_config_list_item_1'] = "Selbstdefinierte Lernziele";
$string['consent_config_list_item_2'] = "Einstellungen zum Lesefortschritt";
$string['consent_config_list_item_3'] = "Termine des Planungsassistenten";
$string['consent_config_link'] = "Datenschutzerklärung lesen";
$string['consent_config_btn_cancel'] = "Abbrechen";
$string['consent_config_btn_delete'] = "Daten löschen und widerrufen";
$string['consent_config_btn_save'] = "Daten behalten und widerrufen";
$string['no-view-exists'] = "Starten Sie die Bearbeitungsfunktion zum Hinzufügen von Karten, indem Sie das Stift-Symbol anklicken.";

$string['optional_inputs_help_info_text'] = 'Bleiben Sie bezüglich Ihres Lernfortschritts auf dem Laufenden und geben Sie hier zu den bereitgestellten Dokumenten des Kurses Ihren Fortschritt an, klicken Sie zum Hinzufügen eines Dokumentes unter "Lernmaterialien des Kurses hinzufügen" auf den Button.<p><strong>Dokument:</strong> Auswahl eines im Kurs zur Verfügung gestellten Dokumentes.<p><strong>Aktuelle Seite:</strong> Eingabe der Seite auf der Sie sich im Dokument befinden.<p><strong>Letzte Seite:</strong> Tragen Sie hier ein, wie viele Seiten das Dokument insgesamt hat.</p><p><strong>Zeitaufwand (in Stunden):</strong> Tragen Sie hier den geschätzten Zeitaufwand ein.</p>
<p>Mit dem Button "Speichern" schließen Sie den Vorgang ab und speichern den Fortschritt in Ihrem persönlichen Bereich.</p>

<p>Unter "Lernmaterialien des Kurses verwalten" können Sie Ihre bereits eingetragenen Materialien bearbeiten oder einzelne Lesefortschritte aus Ihrem persönlichen Bereich entfernen.</p>';

// Study progress view.
$string['study-progress-view'] = "Lernfortschrittsanzeige";
$string['study-progress_infotext_bad'] = "Der Lernfortschritt ist momentan nicht optimal.";
$string['study-progress_infotext_average'] = 'Der Lernfortschritt ist momentan <span style="color: var(--diseablue)">mittelmäßig</span>.';
$string['study-progress_infotext_good'] = "Der Lernfortschritt ist momentan sehr gut.";
$string['study-progress_help_info_text'] = "Das Speedometer zeigt Ihnen Ihren Lernfortschritt an und stellt dar, wie weit Sie auf dem Weg zum Ziel sind. Die Grundlage der Berechnung sind die Bewertungen in den Aufgaben, die für Sie im Kurs zugeordnet sind.";
$string['study-progress_help_info_text_expanded'] = "Das Speedometer zeigt Ihnen Ihren Lernfortschritt an und stellt dar, wie weit Sie auf dem Weg zum Ziel sind. Die Grundlage der Berechnung sind die Bewertungen in den Aufgaben, die für SIe im Kurs zugeordnet sind. Unterhalb des Speedometers finden Sie eine Aufstellung, der dieser Berechnung zu Grunde liegt.";
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
$string['study-progress_eval_halfyear'] = "Bewetung für Ihr Semester";
$string['study-progress_eval_global'] = "Bewertung für Ihr Studium";

// Success chance view.
$string['success-chance-view'] = 'PVL-Wahrscheinlichkeit';
$string['success-chance_help_info_text'] = 'In der Karte "PVL-Wahrscheinlichkeit" werden alle Einsendeaufgaben (inkl. Bewertungspunkte) vollständig dargestellt. Die jeweilige PVL-Wahrscheinlichkeit errechnet sich aus den Status der einzelnen Abgaben und stellt diese als Prozentsatz dar. <p><span style="color: var(--diseablue)">HINWEIS</span><br> Bitte beachten Sie, dass der Wert der "PVL-Wahrscheinlichkeit" lediglich auf Basis der vergangenen Einsendeaufgaben berechnet wird. Es ist wichtig zu verstehen, dass eine hohe PVL-Wahrscheinlichkeit daher keine Garantie für Erfolg bedeutet und dass eine gewisse Unsicherheit besteht. Letztendlich hängt Ihr Erfolg von vielen Faktoren ab, einschließlich Ihrer Anstrengungen und Umstände, die außerhalb unserer Kontrolle liegen. Nutzen Sie die PVL-Wahrscheinlichkeit als eine Orientierungshilfe, aber lassen Sie sich nicht entmutigen, wenn Ihre tatsächlichen Ergebnisse davon abweichen.';
$string['success-chance_help_info_text_expanded'] = 'In der Detailansicht der "PVL-Wahrscheinlichkeit" erhalten Sie eine vollständige Auflistung der Einsendeaufgaben und deren Status, die zur Berechnung der PVL-Wahrscheinlichkeit beitragen.';
$string['success-chance_info_text'] = 'Betrachten Sie die PVL-Wahrscheinlichkeit: Die PVL-Wahrscheinlichkeit zeigt Ihnen, wie viele Bewertungspunkte Sie erhalten haben.';
$string['success-chance_info_text_expanded'] = 'Die PVL-Wahrscheinlichkeit zeigt Ihnen den Status der Einsendeaufgaben an.';
$string['pvl_success-chance-chart-text'] = 'PVL-Wahrscheinlichkeit';
$string['success-chance-no-data'] = 'Keine Daten zur Anzeige der Erfolgschance in diesem Kurs vohanden.';
$string['success-chance-label-failed'] = 'PVL-Wahrscheinlichkeit';

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

$string['nodata'] = 'Keine Daten vorhanden';
$string['activity_view_refresh'] = "Letzte Aktualisierung";

$string['task_tasktransform'] = 'Tasktransformation';

// Planner view.
$string['planner-view'] = 'Planungsassistent';
$string['planner_help_info_text'] = "Diese Karte zeigt Ihnen einen Überblick über Ihre anstehenden Webkonferenzen, Einsendeaufgaben oder andere Aktivitäten. Zudem können Sie Termine hinzufügen, indem Sie einen einfachen Klick auf einen Tag ihrer Wahl tätigen. In der Detailansicht können Sie alle Termine einsehen.";
$string['planner_help_info_text_expanded'] = "Diese Karte zeigt Ihnen einen Überblick über Ihre anstehenden Webkonferenzen, Einsendeaufgaben oder andere Aktivitäten. Zudem können Sie Termine hinzufügen, indem Sie einen einfachen Klick auf einen Tag ihrer Wahl tätigen. In der Detailansicht können Sie alle Termine einsehen.";
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

// Privacy API.
// For: block_disealytics_user_goals.
$string['privacy:metadata:block_diseanalytics_user'] = 'Beschreibung für block_diseanalytics_user';
$string['privacy:metadata:block_disealytics_user_goals'] = 'Das Ziel des Lernfortschritts';
$string['privacy:metadata:user_goal_id'] = 'goal_id';
$string['privacy:metadata:user_goal_usermodified'] = 'usermodified';
$string['privacy:metadata:user_goal_courseid'] = 'goal_courseid';
$string['privacy:metadata:user_goal_userid'] = 'goal_userid';
$string['privacy:metadata:user_goal_timecreated'] = 'goal_timecreated';
$string['privacy:metadata:user_goal_timemodified'] = 'goal_timemodified';
$string['privacy:metadata:user_goal_timecompleted'] = 'goal_timecompleted';
$string['privacy:metadata:user_goal_duedate'] = 'goal_duedate';
$string['privacy:metadata:user_goal_description'] = 'goal_description';
$string['privacy:metadata:user_goal_finished'] = 'goal_finished';

// For: block_disealytics_opin.
$string['privacy:metadata:block_disealytics_user_pages'] = 'Benutzerseiten für das learningdashboard';
$string['privacy:metadata:user_pages_id'] = 'user_pages_id';
$string['privacy:metadata:user_pages_usermodified'] = 'user_pages_usermodified';
$string['privacy:metadata:user_pages_courseid'] = 'user_pages_courseid';
$string['privacy:metadata:user_pages_userid'] = 'user_pages_userid';
$string['privacy:metadata:user_pages_timecreated'] = 'user_pages_timecreated';
$string['privacy:metadata:user_pages_timemodified'] = 'user_pages_timemodified';
$string['privacy:metadata:user_pages_timecompleted'] = 'user_pages_timecompleted';
$string['privacy:metadata:user_pages_name'] = 'user_pages_name';
$string['privacy:metadata:user_pages_currentpage'] = 'user_pages_currentpage';
$string['privacy:metadata:user_pages_lastpage'] = 'user_pages_lastpage';
$string['privacy:metadata:user_pages_expenditureoftime'] = 'user_pages_expenditureoftime';

// For: block_disealytics_consent.
$string['privacy:metadata:block_disealytics_consent'] = 'Einwilligung des Benutzers';
$string['privacy:metadata:consent_id'] = 'consent_id';
$string['privacy:metadata:consent_userid'] = 'consent_userid';
$string['privacy:metadata:consent_counter'] = 'consent_counter';
$string['privacy:metadata:consent_choice'] = 'consent_choice';
$string['privacy:metadata:consent_timecreated'] = 'consent_timecreated';
$string['privacy:metadata:consent_timemodified'] = 'consent_timemodified';

// For: block_disealytics_user_tasks.
$string['privacy:metadata:block_disealytics_user_tasks'] = 'Benutzeraufgaben';
$string['privacy:metadata:user_id'] = 'user_id';
$string['privacy:metadata:user_component'] = 'user_component';
$string['privacy:metadata:user_target'] = 'user_target';
$string['privacy:metadata:user_action'] = 'user_action';
$string['privacy:metadata:user_eventname'] = 'user_timecreated';
$string['privacy:metadata:user_courseid'] = 'user_timecreated';
$string['privacy:metadata:user_userid'] = 'user_id';
$string['privacy:metadata:user_timestart'] = 'user_timestart';
$string['privacy:metadata:user_n_events'] = 'user_n_events';
$string['privacy:metadata:user_duration'] = 'user_duration';
$string['privacy:metadata:user_timecreated'] = 'user_timecreated';

$string['block_my_consent_block'] = 'DiSEA Einwilligungsblock';

$string['config_title'] = 'Kurs f&uuml;r Logdaten';
$string['config_text'] = 'Bitte geben Sie hier die Kurs ID f&uuml;r den Kurs ein, in dem die Logdaten gespeichert werden sollen.';

$string['config_key_title'] = '&Ouml;ffentlicher Schl&uuml;ssel zum Verschl&uuml;sseln der Daten';
$string['config_key_text'] = 'Bitte f&uuml;gen Sie hier den &ouml;ffentlichen Schl&uuml;ssel ein.';

$string['config_consent_text'] = 'Ihre Einwilligungserkl&auml;rung';
$string['config_consent_description'] = 'Bitte geben Sie hier ihre Einwilligungserkl&auml;rung als HTML formatierten Text ein.';

$string['config_counter_title'] = 'Counter f&uuml;r Anzeige der Einwilligungserkl&auml;rung';
$string['config_counter_text'] = '&Uuml;ber diesen Counter kann gesteuert werden, wann die Einwilligungserkl&auml;rung erneut f&uuml;r die Studierenden angezeigt werden soll.';

$string['config_eventblacklist_title'] = 'Blacklist-CSV f&uuml;r Eventfilterung';
$string['config_eventblacklist_text'] = 'Diese Einstellung erm&ouml;glicht eine CSV-Datei mit zu filternden event-, target- und action-Namen hochzuladen.';

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

$string['log_task_name'] = 'Disea Log Task';
$string['decline_task_name'] = 'Disea decline Task';

$string['messageprovider'] = 'Disea Message Provider';
$string['messageprovider:logdata_disea'] = 'Disea Message Provider';

$string['download'] = 'Herunterladen';
$string['back'] = 'Zur&uuml;ck';
$string['delete'] = 'Entfernen';

// Privacy API.
$string['privacy:metadata:disea_consent'] = 'Informationen &uuml;ber die Wahl des Benutzers in verschiedenen Kursen &uuml;ber die Nutzung der Daten f&uuml;r die wissenschaftliche Forschung.';
$string['privacy:metadata:disea_consent:userid'] = 'Die ID des Benutzers';
$string['privacy:metadata:disea_consent:courseid'] = 'Die ID des Kurses des Benutzers';
$string['privacy:metadata:disea_consent:choice'] = 'Die Wahl, die der Benutzer f&uuml;r die DiSEA Einwilligungserkl&auml;rung getroffen hat.';

$string['privacy:data'] = 'Daten des Nutzers f&uuml;r DiSEA Einwilligungserkl&auml;rung';
