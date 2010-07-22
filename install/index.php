<?php

##############################################################################
# *                                                                          #
# * 2MOONS                                                                   #
# *                                                                          #
# * @copyright Copyright (C) 2010 By ShadoX from titanspace.de               #
# *                                                                          #
# *	                                                                         #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.                                     #
# *	                                                                         #
# *  This program is distributed in the hope that it will be useful,         #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of          #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
# *  GNU General Public License for more details.                            #
# *                                                                          #
##############################################################################

if(!function_exists('spl_autoload_register'))
	exit("PHP is missing <a href=\"http://php.net/spl\">Standard PHP Library (SPL)</a> support");

define('INSIDE'  			, true);
define('INSTALL' 			, true);
define('RCINSTALL_VERSION' 	, "5.1");
define('REVISION' 			, "851");

define('ROOT_PATH', './../');
include(ROOT_PATH . 'extension.inc');
include(ROOT_PATH . 'common.'.PHP_EXT);
define('DEFAULT_LANG'	, (empty($_REQUEST['lang'])) ? 'deutsch' : $_REQUEST['lang']);
includeLang('INSTALL');
$Mode     = $_GET['mode'];
$Page     = $_GET['page'];
$phpself  = $_SERVER['PHP_SELF'];
$nextpage = $Page + 1;
$parse = $LNG;
$parse['lang']	= 'lang='.DEFAULT_LANG;	
if (empty($Mode)) { $Mode = 'intro'; }
if (empty($Page)) { $Page = 1;       }

		
switch ($Mode) {
	case 'license':
		$frame  = parsetemplate(gettemplate('install/ins_license'), false);
	break;
	case 'intro':
		$LangFolder = opendir(ROOT_PATH.'language');
		while (($LangSubFolder = readdir($LangFolder)) !== false)
		{
			if($LangSubFolder == '.' || $LangSubFolder == '..' || $LangSubFolder == '.htaccess' || $LangSubFolder == '.svn')
				continue;
			
			$parse['language_settings'] .= "<option ";

			if(DEFAULT_LANG == $LangSubFolder)
				$parse['language_settings'] .= "selected = selected";

			$parse['language_settings'] .= " value=\"".$LangSubFolder."\">".ucwords($LangSubFolder)."</option>";
		}
		$frame  = parsetemplate(gettemplate('install/ins_intro'), $parse);
	break;
	case 'req':
		$error = 0;
		if(version_compare(PHP_VERSION, "5.2.5", ">=")){
			$parse['PHP'] = "<span class=\"yes\">".$LNG['reg_yes'].", ".PHP_VERSION."</span>";
		} else {
			$parse['PHP'] = "<span class=\"no\">".$LNG['reg_no'].", ".PHP_VERSION."</span>";
			$error++;	
		}
		if(@ini_get('safe_mode') == 0){
			$parse['safemode'] = "<span class=\"yes\">".$LNG['reg_yes']."</span>";
		} else {
			$parse['safemode'] = "<span class=\"no\">".$LNG['reg_no']."</span>";
			$error++;
		}
		if(!extension_loaded('mysqli')){
			$parse['mysqli'] = "<span class=\"no\">".$LNG['reg_no']."</span>";
			$error++;
		} else {
			$parse['mysqli'] = "<span class=\"yes\">".$LNG['reg_yes']."</span>";
		}
		if(!extension_loaded('gd')){
			$parse['error'] = "<span class=\"no\">".$LNG['reg_no']."</span>";
		} else {
			$Info	= gd_info();
			if(!$Info['PNG Support'])
				$parse['gdlib'] = "<span class=\"no\">".$LNG['reg_no']."</span>";
			else
				$parse['gdlib'] = "<span class=\"yes\">".$LNG['reg_yes'].", ".$Info['GD Version']."</span>";
		}
		if(file_exists(ROOT_PATH."config.php") || ($res = @fopen(ROOT_PATH."config.php","w+") === true)){
			if(is_writable(ROOT_PATH."config.php") || @chmod(ROOT_PATH."config.php", 0777)){
					$chmod = "<span class=\"yes\"> - ".$LNG['reg_writable']."</span>";
				} else {
					$chmod = " - <span class=\"no\">".$LNG['reg_not_writable']."</span>";
					$error++;
				}
			$parse['config'] = "<tr><th>".$LNG['reg_file']." - config.php</th></th><th><span class=\"yes\">".$LNG['reg_found']."</span>".$chmod."</th></tr>";		
			@fclose($res);
		} else {
			$parse['config'] = "<tr><th>".$LNG['reg_file']." - config.php</th></th><th><span class=\"no\">".$LNG['reg_not_found']."</span>";
			$error++;
		}
		$directories = array('adm/logs/', 'cache/', 'cache/UserBanner/', 'raports/');
		$dirs = "";
		foreach ($directories as $dir)
		{
			if(is_dir(ROOT_PATH . $dir) || @mkdir(ROOT_PATH . $dir, 0777)){
				if(is_writable(ROOT_PATH . $dir) || @chmod(ROOT_PATH . $dir, 0777)){
						$chmod = "<span class=\"yes\"> - ".$LNG['reg_writable']."</span>";
					} else {
						$chmod = " - <span class=\"no\">".$LNG['reg_not_writable']."</span>";
						$error++;
					}
				$dirs .= "<tr><th>".$LNG['reg_dir']." - ".$dir."</th></th><th><span class=\"yes\">".$LNG['reg_found']."</span>".$chmod."</th></tr>";
				
			} else {
				$dirs .= "<tr><th>".$LNG['reg_dir']." - ".$dir."</th></th><th><span class=\"no\">".$LNG['reg_not_found']."</span>";
				$error++;
			}
		}
		
		if($error == 0){
			$parse['done'] = "<tr><th colspan=\"2\"><a href=\"index.php?mode=ins&page=1&amp;".$parse['lang']."\">".$LNG['continue']."</a></th></tr>";
		}
		$parse['dir'] = $dirs;
		$frame = parsetemplate(gettemplate('install/ins_req'), $parse);
	break;
	case 'ins':
		if ($Page == 1) {
			$frame  = parsetemplate(gettemplate('install/ins_form'), $parse);
		}
		elseif ($Page == 2) {
			$GLOBALS['database']['host']	= $_POST['host'];
			$GLOBALS['database']['port']	= $_POST['port'];
			$GLOBALS['database']['user']	= $_POST['user'];
			$GLOBALS['database']['userpw']	= $_POST['passwort'];
			$prefix 						= $_POST['prefix'];
			$GLOBALS['database']['databasename']    = $_POST['db'];
			
			$connection = new DB_MySQLi();
			
			if (mysqli_connect_errno()) {
				message(sprintf($LNG['step2_db_con_fail'], mysqli_connect_error()), "?mode=ins&page=1&".$parse['lang'], 3, false, false);exit;
			}

			@chmod("../config.php",0777);
			$dz = @fopen("../config.php", "w");
			if (!$dz)
			{
				message ($LNG['step2_conf_op_fail'],"?mode=ins&page=1&".$parse['lang'], 3, false, false);exit;
			}

			$parse['first']		= "Verbindung zur Datenbank erfolgreich...";
			$connection->multi_query(str_replace("prefix_", $prefix, file_get_contents('install.sql'))); 
			
			$parse['second']	= $LNG['step2_db_ok'];
			
			$numcookie = mt_rand(1000, 9999999999);
			fwrite($dz, "<?php \n");
			fwrite($dz, "if(!defined(\"INSIDE\")){ header(\"location:".ROOT_PATH."\"); } \n\n");
			fwrite($dz, "//### Database access ###//\n\n");
			fwrite($dz, "\$database[\"host\"]          = \"".$GLOBALS['database']['host']."\";\n");
			fwrite($dz, "\$database[\"port\"]          = \"".$GLOBALS['database']['port']."\";\n");
			fwrite($dz, "\$database[\"user\"]          = \"".$GLOBALS['database']['user']."\";\n");
			fwrite($dz, "\$database[\"userpw\"]        = \"".$GLOBALS['database']['userpw']."\";\n");
			fwrite($dz, "\$database[\"databasename\"]  = \"".$GLOBALS['database']['databasename']."\";\n");
			fwrite($dz, "\$database[\"tableprefix\"]   = \"".$prefix."\";\n");
			fwrite($dz, "\$dbsettings[\"secretword\"]  = \"2Moons_".$numcookie."\";\n\n");
			fwrite($dz, "//### Do not change beyond here ###//\n");
			fwrite($dz, "?>");
			fclose($dz);
			@chmod("../config.php",0444);
			
			$parse['third']	= "config.php erfolgreich erstellt...";
			$frame  = parsetemplate(gettemplate('install/ins_form_done'), $parse);
		}
		elseif ($Page == 3)
		{
			$frame  = parsetemplate(gettemplate('install/ins_acc'), $parse);
		}
		elseif ($Page == 4)
		{
			$adm_user   = $_POST['adm_user'];
			$adm_pass   = $_POST['adm_pass'];
			$adm_email  = $_POST['adm_email'];
			$md5pass    = md5($adm_pass);

			if (empty($_POST['adm_user']) && empty($_POST['adm_pas']) && empty($_POST['adm_email']))
			{
				message($LNG['step4_need_fields'],"?mode=ins&page=3&".$parse['lang'], 2, false, false);
				exit();
			}
			
			$QryInsertAdm  = "INSERT INTO ".USERS." SET ";
			$QryInsertAdm .= "`id`                = '1', ";
			$QryInsertAdm .= "`username`          = '". $adm_user ."', ";
			$QryInsertAdm .= "`email`             = '". $adm_email ."', ";
			$QryInsertAdm .= "`email_2`           = '". $adm_email ."', ";
			$QryInsertAdm .= "`ip_at_reg`         = '". $_SERVER['REMOTE_ADDR'] . "', ";
			$QryInsertAdm .= "`authlevel`         = '3', ";
			$QryInsertAdm .= "`id_planet`         = '1', ";
			$QryInsertAdm .= "`galaxy`            = '1', ";
			$QryInsertAdm .= "`system`            = '1', ";
			$QryInsertAdm .= "`planet`            = '1', ";
			$QryInsertAdm .= "`current_planet`    = '1', ";
			$QryInsertAdm .= "`register_time`     = '". TIMESTAMP ."', ";
			$QryInsertAdm .= "`password`          = '". $md5pass ."';";
			$QryInsertAdm .= "INSERT INTO ".PLANETS." SET ";
			$QryInsertAdm .= "`id_owner`          = '1', ";
			$QryInsertAdm .= "`id_level`          = '0', ";
			$QryInsertAdm .= "`galaxy`            = '1', ";
			$QryInsertAdm .= "`system`            = '1', ";
			$QryInsertAdm .= "`name`              = 'Hauptplanet', "; 
			$QryInsertAdm .= "`planet`            = '1', ";
			$QryInsertAdm .= "`last_update`       = '". TIMESTAMP ."', ";
			$QryInsertAdm .= "`planet_type`       = '1', ";
			$QryInsertAdm .= "`image`             = 'normaltempplanet02', ";
			$QryInsertAdm .= "`diameter`          = '12750', ";
			$QryInsertAdm .= "`field_max`         = '163', ";
			$QryInsertAdm .= "`temp_min`          = '47', ";
			$QryInsertAdm .= "`temp_max`          = '87', ";
			$QryInsertAdm .= "`metal`             = '500', ";
			$QryInsertAdm .= "`metal_perhour`     = '0', ";
			$QryInsertAdm .= "`metal_max`         = '1000000', ";
			$QryInsertAdm .= "`crystal`           = '500', ";
			$QryInsertAdm .= "`crystal_perhour`   = '0', ";
			$QryInsertAdm .= "`crystal_max`       = '1000000', ";
			$QryInsertAdm .= "`deuterium`         = '500', ";
			$QryInsertAdm .= "`deuterium_perhour` = '0', ";
			$QryInsertAdm .= "`deuterium_max`     = '1000000';";
			$QryInsertAdm .= "INSERT INTO ".STATPOINTS." (`id_owner`, `id_ally`, `stat_type`, `stat_code`, `tech_rank`, `tech_old_rank`, `tech_points`, `tech_count`, `build_rank`, `build_old_rank`, `build_points`, `build_count`, `defs_rank`, `defs_old_rank`, `defs_points`, `defs_count`, `fleet_rank`, `fleet_old_rank`, `fleet_points`, `fleet_count`, `total_rank`, `total_old_rank`, `total_points`, `total_count`, `stat_date`) VALUES ('1', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '".TIMESTAMP."');";
			$db->multi_query($QryInsertAdm);
			@session_start();
			$_SESSION['id']			= '1';
			$_SESSION['username']	= $adm_user;
			$_SESSION['authlevel']	= 3;	
		
			header("Location: ../adm/index.php");		
		}
		break;
	case 'convert':
		if(!file_exists(ROOT_PATH.'config.php') || filesize(ROOT_PATH.'config.php') == 0)
			message($LNG['convert_install'], '?', 3);
		
		if($_POST) {
			$GLOBALS['database']['host']			= $_POST['host'];
			$GLOBALS['database']['port']			= $_POST['port'];
			$GLOBALS['database']['user']			= $_POST['user'];
			$GLOBALS['database']['userpw']			= $_POST['passwort'];
			$GLOBALS['database']['databasename']    = $_POST['db'];
			require_once('class.convert.'.PHP_EXT);
			new convert($_POST['version'], $_POST['prefix']);
			message($LNG['convert_done'], '?', 3);
			
		} else {
			$frame  = parsetemplate(gettemplate('install/ins_convert'), $parse);
		}
	default:
}
$parse['ins_state']    = $Page;
$parse['ins_page']     = $frame;
$parse['dis_ins_btn']  = "?mode=$Mode&amp;page=$nextpage";
display (parsetemplate (gettemplate('install/ins_body'), $parse), false, '', true, false);
?>