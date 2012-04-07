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
$LNG['reg_iniset_need']			= 'PHP function &raquo;ini_set&laquo; exist?';
$LNG['reg_global_need']			= 'register_globals off?';
$LNG['reg_global_desc']			= '2Moons will also work if this setting is enabled. However, it is recommended for security reasons to disable register_globals in the PHP installation, if possible.';
$LNG['req_ftp_head']			= 'Enter the login credentials for FTP';
$LNG['req_ftp_desc']			= 'Enter your FTP information so 2Moons can automatically fix the problems. Alternatively, you can also manually assign write permissions.';
$LNG['req_ftp_host']			= 'Hostname';
$LNG['req_ftp_username']		= 'Username';
$LNG['req_ftp_password']		= 'Password';
$LNG['req_ftp_dir']				= 'Path to 2Moons installation';
$LNG['req_ftp_send']			= 'Send';
$LNG['req_ftp_error_data']		= 'Failed to connect to the FTP server.';
$LNG['req_ftp_error_dir']		= 'The directory is invalid.';

$LNG['step1_head']				= 'Configuring database access';
$LNG['step1_desc']				= 'Now that it has been determined that 2Moons can be used on your server, you must provide some information. If you do not know how the data are connected to your database, please contact your hosting provider first or ask at the 2Moons support forums. When you enter data, please check this carefully before you continue.';
$LNG['step1_mysql_server']		= 'Database host';
$LNG['step1_mysql_port']		= 'Database port';
$LNG['step1_mysql_dbuser']		= 'Database user';
$LNG['step1_mysql_dbpass']		= 'Database password';
$LNG['step1_mysql_dbname']		= 'Name of database';
$LNG['step1_mysql_prefix']		= 'Table prefix:';

$LNG['step2_prefix_invalid']	= 'The database prefix may only contain letters, numbers, or underscores.';
$LNG['step2_db_error']			= 'Failed to create database tables:';
$LNG['step2_db_no_dbname']		= 'Database name is not specified.';
$LNG['step2_db_too_long']		= 'The specified table prefix is too long. Maximum prefix length is 36 characters.';
$LNG['step2_db_con_fail']		= 'No connection to the database could be established.Details:';
$LNG['step2_config_exists']		= 'config.php already exists!';
$LNG['step2_conf_op_fail']		= 'config.php is not writable!';
$LNG['step2_conf_create']		= 'config.php successfully created...';
$LNG['step2_db_done']			= 'Connection to the database was successful!';

$LNG['step3_head']				= 'Create database tables';
$LNG['step3_desc']				= 'The database tables used by 2Moons have now been created and populated with some initial values​​. Go to the next step to complete the installation of 2Moons.';

$LNG['step4_head']				= 'Administration';
$LNG['step4_desc']				= 'The installation wizard will now create an administrator account for you. Please enter a username, an e-mail address and a password.';
$LNG['step4_admin_name']		= 'Administrator username:';
$LNG['step4_admin_name_desc']	= 'Please enter a username with a length of 3 to 20 characters.';
$LNG['step4_admin_pass']		= 'Administrator Password:';
$LNG['step4_admin_pass_desc']	= 'Please enter a password with a length of 6 to 30 characters.';
$LNG['step4_admin_mail']		= 'Administrator email address:';

$LNG['step6_head']				= 'Congratulations!';
$LNG['step6_desc']				= 'You have successfully installed 2Moons.';
$LNG['step6_info_head']			= 'Start with 2Moons by!';
$LNG['step6_info_additional']	= 'If you click on the button below, you will be redirected to a form in the admin area. Then you should look to take some time to get to know the options available..<br/><br/><strong>Please delete the file &raquo;includes/ENABLE_INSTALL_TOOL&laquo; or call it before you use your game. As long as this file exists, your game is potentially at risk!</strong>';

$LNG['sql_close_reason']		= 'Game is currently closed';
$LNG['sql_welcome']				= 'Welcome to 2Moons v';

?>