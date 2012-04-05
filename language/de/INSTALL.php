<?php

/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.5 (2011-07-31)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */

$LNG['back']					= 'Back';
$LNG['continue']				= 'Continue';
$LNG['login']					= 'Login';

$LNG['menu_intro']				= 'Intro';
$LNG['menu_install']			= 'Install';
$LNG['menu_license']			= 'License';

$LNG['title_install']			= 'Install';

$LNG['intro_lang']				= 'Language';
$LNG['intro_install']			= 'Installation';
$LNG['intro_welcome']			= 'Welcome to 2Moons!';
$LNG['intro_text']				= 'One of the best clones of OGame is 2 Moons.<br>The latest is and 2 Moons the stablest flat rate was ever developed. 2 of Moon shines by stability, flexibility, dynamics, quality and user-friendliness. We hope always to be better than her expectations.<br><br>The installation system guides you through the install or upgrade from an older version to the latest. On questions or trouble dont hesitate to contact us.<br><br>2Moons is an open source project licensed under the GNU GPL v3. For the license please click on the item in the menu.<br><br>Before the installation starts, a test is conducted, if system requirements are met.';

$LNG['licence_head']			= 'License Agreement';
$LNG['licence_desc']			= 'Please read the following License Agreement. Use the scroll bar to view the entire document.';
$LNG['licence_accept']			= 'Do you accept all terms of the license agreement? You can install the software only if you accept the license agreement.';
$LNG['licence_need_accept']		= 'In order to proceed with the installation, you must accept the license terms.';

$LNG['req_head']				= 'System Requirements';
$LNG['req_desc']				= 'Before the installation can continue, 2Moons will perform some tests on your server configuration and your files to ensure that you can install and use 2Moons. Please read the results carefully and proceed no further until all required tests are passed. If you wish to use any of the functions listed under the optional modules, you should ensure that appropriate tests are also passed.';
$LNG['reg_yes']					= 'Yes';
$LNG['reg_no']					= 'No';
$LNG['reg_found']				= 'Found';
$LNG['reg_not_found']			= 'Not found';
$LNG['reg_writable']			= 'Writable';
$LNG['reg_not_writable']		= 'Not Writable';
$LNG['reg_file']				= 'Files &raquo;%s&laquo; writable?';
$LNG['reg_dir']					= 'Folder &raquo;%s&laquo; writable?';
$LNG['req_php_need']			= 'Installed version of the scripting language PHP (minimun 5.2.5 required)';
$LNG['req_php_need_desc']		= '<strong>Prerequisite</strong> — PHP is the server-side language that 2Moons is written in. PHP version 5.2.5 is required to install 2Moons.';
$LNG['reg_gd_need']				= 'Installed version of the graphics processing library  &raquo;gdlib&laquo;';
$LNG['reg_gd_desc']				= '<strong>Optional</strong> — Grafikbearbeitungs-Bibliothek &raquo;gdlib&laquo; ist für die dynamische Generierung von Bildern zuständig. Ohne sie werden einige Funktionalitäten der Software nicht funktionieren.';
$LNG['reg_mysqli_active']		= 'MySQL available?';
$LNG['reg_mysqli_desc']			= '<strong>Prerequisite</strong> — You need to provide support for MySQLi in PHP. If no database modules are shown as being available, you should contact your hosting provider or review the relevant PHP installation documentation for advice.';
$LNG['reg_json_need']			= 'JSON available?';
$LNG['reg_iniset_need']			= 'PHP-Funktion &raquo;ini_set&laquo; vorhanden?';
$LNG['reg_global_need']			= 'register_globals deaktiviert?';
$LNG['reg_global_desc']			= '2Moons wird auch funktionieren, wenn diese Einstellung aktiviert ist. Allerdings wird aus Sicherheitsgründen empfohlen, register_globals in der PHP-Installation zu deaktivieren, falls dies möglich ist.';
$LNG['req_ftp_head']			= 'Eingabe der Zugangsdaten für FTP';
$LNG['req_ftp_desc']			= 'Geben Sie Ihre FTP Daten ein, damit 2Moons automatisch die Probleme beheben kann. Alternativ können Sie auch manuell die Schreibrechte vergeben.';
$LNG['req_ftp_host']			= 'Hostname';
$LNG['req_ftp_username']		= 'Benutzername';
$LNG['req_ftp_password']		= 'Kennwort';
$LNG['req_ftp_dir']				= 'Installationspfad zu 2Moons';
$LNG['req_ftp_send']			= 'Absenden';
$LNG['req_ftp_error_data']		= 'Mit den angegebenen Zugangsdaten konnte keine Verbindung zu einem FTP-Server hergestellt werden.';
$LNG['req_ftp_error_dir']		= 'Das eingegebene Verzeichnis ist ungültig.';

$LNG['step1_head']				= 'Datenbankzugang konfigurieren';
$LNG['step1_desc']				= 'Nachdem nun festgestellt wurde, dass 2Moons auf deinem Server betrieben werden kann, musst du noch einige Informationen angeben. Wenn du nicht weißt, wie die Verbindungsdaten für deine Datenbank lauten, kontaktiere bitte als erstes deinen Webhosting-Provider oder wende dich an die 2Moons Support-Foren. Wenn du Daten eingibst, prüfe diese bitte sorgfältig, bevor du fortfährst.';
$LNG['step1_mysql_server']		= 'Datenbankserver-Hostname oder DSN';
$LNG['step1_mysql_port']		= 'Datenbankserver-Port';
$LNG['step1_mysql_dbuser']		= 'Datenbank-Benutzername';
$LNG['step1_mysql_dbpass']		= 'Datenbank-Passwort';
$LNG['step1_mysql_dbname']		= 'Name der Datenbank';
$LNG['step1_mysql_prefix']		= 'Tabellenprefix:';

$LNG['step2_prefix_invalid']	= 'Der DB-Prefix darf nur alphanumerische Zeichen und Unterstriche enthalten.';
$LNG['step2_db_error']			= 'Fehler beim Erstellen der Datenbank-Tabellen:';
$LNG['step2_db_no_dbname']		= 'Kein Datenbank-Name angegeben.';
$LNG['step2_db_too_long']		= 'Das angegebene Tabellen-Präfix ist zu lang. Die maximale Länge beträgt 36 Zeichen.';
$LNG['step2_db_con_fail']		= 'Es kann keine Verbindung zur Datenbank aufgebaut werden. Details stehen in unten angezeigter Fehlermeldung.';
$LNG['step2_config_exists']		= 'config.php bereits vorhanden!';
$LNG['step2_conf_op_fail']		= 'config.php ist nicht beschreibbar!';
$LNG['step2_conf_create']		= 'config.php erfolgreich erstellt...';
$LNG['step2_db_done']			= 'Verbindung zur Datenbank war erfolgreich!';

$LNG['step3_head']				= 'Datenbank-Tabellen erstellen';
$LNG['step3_desc']				= 'Die von 2Moons genutzten Datenbank-Tabellen wurden nun erstellt und mit einigen Ausgangswerten gefüllt. Geh weiter zum nächsten Schritt, um die Installation von 2Moons abzuschließen.';

$LNG['step4_head']				= 'Administrator erstellen';
$LNG['step4_desc']				= 'Der Installationsassistent erstellt nun ein Administrator-Konto für Sie. Bitte geben Sie dazu einen Benutzernamen, eine E-Mail-Adresse und ein Kennwort ein.';
$LNG['step4_admin_name']		= 'Benutzername des Administrators:';
$LNG['step4_admin_name_desc']	= 'Bitte gib einen Benutzernamen mit einer Länge von 3 bis 20 Zeichen ein.';
$LNG['step4_admin_pass']		= 'Administrator-Passwort:';
$LNG['step4_admin_pass_desc']	= 'Bitte gib ein Passwort mit einer Länge von 6 bis 30 Zeichen ein.';
$LNG['step4_admin_mail']		= 'Kontakt-E-Mail-Adresse:';

$LNG['step6_head']				= 'Herzlichen Glückwunsch!';
$LNG['step6_desc']				= 'Du hast 2Moons erfolgreich installiert.';
$LNG['step6_info_head']			= 'Starte mit 2Moons durch!';
$LNG['step6_info_additional']	= 'Wenn du unten auf die Schaltfläche klickst, wirst du zu einem Formular im Administrations-Bereich weitergeleitet. Anschließend solltest du dir etwas Zeit nehmen, um die verfügbaren Optionen kennen zu lernen.<br/><br/><strong>Bitte lösche die Datei &raquo;includes/ENABLE_INSTALL_TOOL&laquo; oder nenne es um, bevor du dein Spiel benutzt. Solange diese Datei existiert, ist dein Spiel potenziell gefährdet!</strong>';

$LNG['sql_close_reason']		= 'Game ist zurzeit geschlossen';
$LNG['sql_welcome']				= 'Herzlich Willkommen zu 2Moons v';

?>