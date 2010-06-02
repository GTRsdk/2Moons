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

define('INSIDE', true );
define('INSTALL', false );
define('LOGIN', true );

$InLogin = true;

define('ROOT_PATH'	,'./');

include_once(ROOT_PATH . 'extension.inc');
include_once(ROOT_PATH . 'common.' . PHP_EXT);

includeLang('PUBLIC');

// Uniconfig changed...
include_once(ROOT_PATH . 'includes/uni.config.inc.php');

$template	= new template();
$template->set_index();

$page = request_var('page', '');
$mode = request_var('mode', '');

switch ($page) {
	case 'facebook':
		if($CONF['fb_on'] == 0)
			exit(header("Location: index.php"));
			
		include_once(ROOT_PATH . 'includes/libs/facebook/facebook.php');
		$fb = new Facebook($CONF['fb_apikey'], $CONF['fb_skey']);
		$fb_user = $fb->get_loggedin_user();
		
		if($fb_user)
		{
			$login = $db->uniquequery("SELECT `id`,`username`,`authlevel`,`banaday` FROM " . USERS . " WHERE `fb_id` = '".$fb_user."';");
			if (isset($login)) {
				if ($login['banaday'] <= time () && $login['banaday'] != '0') {
					$db->query("UPDATE " . USERS . " SET `banaday` = '0', `bana` = '0' WHERE `username` = '" . $login ['username'] . "';");
				}
				
				@session_start();
				$_SESSION['id']			= $login['id'];
				$_SESSION['username']	= $login['username'];
				$_SESSION['authlevel']	= $login['authlevel'];
				
				$db->query("UPDATE `" . USERS . "` SET `current_planet` = `id_planet` WHERE `id` = '".$login["id"]."';" );

				header("Location: ./game.php?page=overview");
				exit ();
			} else {
				$USER_details = $fb->api_client->users_getInfo($fb_user, array('first_name','last_name','proxied_email','username','contact_email'));  
				if(!empty($USER_details[0]['contact_email']) && ValidateAddress($USER_details[0]['contact_email'])) 
					$UserMail 	=  $USER_details[0]['contact_email'];
				else 
					exit(header("Location: index.php"));
				
				$Exist['alruser'] = $db->uniquequery("SELECT id,username,authlevel FROM ".USERS." WHERE `email` = '".$UserMail."';");
				if(isset($Exist['alruser']))
				{
					$db->query("UPDATE `".USERS."` SET `fb_id` = '".$fb_user."' WHERE `id` ='".$Exist['alruser']['id']."';");
					@session_start();
					$_SESSION['id']			= $Exist['alruser']['id'];
					$_SESSION['username']	= $Exist['alruser']['username'];
					$_SESSION['authlevel']	= $Exist['alruser']['authlevel'];
					exit(header("Location: ./game.php?page=overview"));
				}
				
				$Caracters = "aazertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
				$Count = strlen($Caracters);
				$Taille = 8;
				$NewPass = "";
				for($i = 0; $i < $Taille; $i ++) {
					$CaracterBoucle = rand ( 0, $Count - 1 );
					$NewPass .= substr ( $Caracters, $CaracterBoucle, 1 );
				}
				
				$UserName 		= $db->sql_escape($USER_details[0]['first_name']." ".$USER_details[0]['last_name']);
				$UserIP 		= $_SERVER["REMOTE_ADDR"];				
				$UserPass		= md5($NewPass);
				$IfNameExist	= false;
				$i				= "(1)";
				
				while(!$IfNameExist)
				{
					$Exist['userv'] = $db->fetch_array($db->query("SELECT username FROM ".USERS." WHERE username = '".$UserName."';"));
					$Exist['vaild'] = $db->fetch_array($db->query("SELECT username FROM ".USERS_VALID." WHERE username = '".$UserName."';"));
					if(!isset($Exist['userv']) && !isset($Exist['vaild']))
						$IfNameExist	= true;
					else
						$UserName		= $i.$UserName;
				}
				
				$QryInsertUser = "INSERT INTO ".USERS." SET ";
				$QryInsertUser .= "`username` = '" .$db->sql_escape($UserName)."', ";
				$QryInsertUser .= "`email` = '" . $UserMail . "', ";
				$QryInsertUser .= "`email_2` = '" . $UserMail . "', ";
				$QryInsertUser .= "`ip_at_reg` = '" . $UserIP . "', ";
				$QryInsertUser .= "`id_planet` = '0', ";
				$QryInsertUser .= "`onlinetime` = '" . time () . "', ";
				$QryInsertUser .= "`register_time` = '" . time () . "', ";
				$QryInsertUser .= "`password` = '" . $UserPass . "', ";
				$QryInsertUser .= "`dpath` = '" . DEFAULT_SKINPATH . "', ";
				$QryInsertUser .= "`fb_id` = '" . $fb_user . "', ";
				$QryInsertUser .= "`uctime`= '0';";
				$db->query($QryInsertUser);
			
				if($CONF['smtp_host'] != '' && $CONF['smtp_port'] != 0 && $CONF['smtp_user'] != '' && $CONF['smtp_pass'] != '')
				{				
					$MailSubject	= sprintf($LNG['reg_mail_reg_done'], $CONF['game_name']);	
					$MailRAW		= file_get_contents("./language/".$CONF['lang']."/email/email_reg_done.txt");
					$MailContent	= sprintf($MailRAW, $UserName, $CONF['game_name']);	
					MailSend($UserMail, $UserName, $MailSubject, $MailContent);
					$MailRAW		= file_get_contents("./language/".$CONF['lang']."/email/email_lost_password.txt");
					$MailContent	= sprintf($MailRAW, $ExistMail['username'], $CONF['game_name'], $NewPass, "http://".$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"]);			
					MailSend($UserMail, $UserName, $LNG['mail_title'], $MailContent);		
				}
				
				$NewUser = $db->fetch_array ( $db->query ( "SELECT `id` FROM " . USERS . " WHERE `username` = '".$UserName."' AND `password` = '".$UserPass."';" ) );
				
				$LastSettedGalaxyPos = $CONF['LastSettedGalaxyPos'];
				$LastSettedSystemPos = $CONF['LastSettedSystemPos'];
				$LastSettedPlanetPos = $CONF['LastSettedPlanetPos'];
				
				while (!isset($newpos_checked)) {
					for($Galaxy = $LastSettedGalaxyPos; $Galaxy <= MAX_GALAXY_IN_WORLD; $Galaxy ++) {
						for($System = $LastSettedSystemPos; $System <= MAX_SYSTEM_IN_GALAXY; $System ++) {
							for($Posit = $LastSettedPlanetPos; $Posit <= 4; $Posit ++) {
								$Planet = round ( rand ( 4, 12 ) );
								
								switch ($LastSettedPlanetPos) {
									case 1 :
										$LastSettedPlanetPos += 1;
										break;
									case 2 :
										$LastSettedPlanetPos += 1;
										break;
									case 3 :
										if ($LastSettedSystemPos == MAX_SYSTEM_IN_GALAXY) {
											$LastSettedGalaxyPos += 1;
											$LastSettedSystemPos = 1;
											$LastSettedPlanetPos = 1;
											break;
										} else {
											$LastSettedPlanetPos = 1;
										}
										
										$LastSettedSystemPos += 1;
										break;
								}
								break;
							}
							break;
						}
						break;
					}
					
					if (!CheckPlanetIfExist($Galaxy, $System, $Planet))
					{
						require_once(ROOT_PATH.'includes/functions/CreateOnePlanetRecord.'.PHP_EXT);
						CreateOnePlanetRecord ($Galaxy, $System, $Planet, $NewUser['id'], $UserPlanet, true);
						$QryInsertConfig  = "UPDATE " . CONFIG . " SET `config_value` = '" . $LastSettedGalaxyPos . "' WHERE `config_name` = 'LastSettedGalaxyPos';";
						$QryInsertConfig .= "UPDATE " . CONFIG . " SET `config_value` = '" . $LastSettedSystemPos . "' WHERE `config_name` = 'LastSettedSystemPos';";
						$QryInsertConfig .= "UPDATE " . CONFIG . " SET `config_value` = '" . $LastSettedPlanetPos . "' WHERE `config_name` = 'LastSettedPlanetPos';";
						$db->multi_query($QryInsertConfig);
						$newpos_checked = true;
					}
				}
				$PlanetID = $db->fetch_array($db->query("SELECT `id` FROM ".PLANETS." WHERE `id_owner` = '".$NewUser ['id']."';" ));
				
				$QryUpdateUser = "UPDATE " . USERS . " SET ";
				$QryUpdateUser .= "`id_planet` = '" . $PlanetID ['id'] . "', ";
				$QryUpdateUser .= "`current_planet` = '" . $PlanetID ['id'] . "', ";
				$QryUpdateUser .= "`galaxy` = '" . $Galaxy . "', ";
				$QryUpdateUser .= "`system` = '" . $System . "', ";
				$QryUpdateUser .= "`planet` = '" . $Planet . "' ";
				$QryUpdateUser .= "WHERE ";
				$QryUpdateUser .= "`id` = '" . $NewUser ['id'] . "' ";
				$QryUpdateUser .= "LIMIT 1;";
				$QryUpdateUser .= "INSERT INTO ".STATPOINTS." (`id_owner`, `id_ally`, `stat_type`, `stat_code`, `tech_rank`, `tech_old_rank`, `tech_points`, `tech_count`, `build_rank`, `build_old_rank`, `build_points`, `build_count`, `defs_rank`, `defs_old_rank`, `defs_points`, `defs_count`, `fleet_rank`, `fleet_old_rank`, `fleet_points`, `fleet_count`, `total_rank`, `total_old_rank`, `total_points`, `total_count`, `stat_date`) VALUES (".$NewUser['id'].", 0, 1, 1, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, 1, 0, 0, 0, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, ".TIMESTAMP.");";				
				$db->multi_query ( $QryUpdateUser );
				
				$from 		= $LNG ['welcome_message_from'];
				$sender 	= $LNG ['welcome_message_sender'];
				$Subject 	= $LNG ['welcome_message_subject'];
				$message 	= sprintf($LNG['welcome_message_content'], $CONF['game_name']);
				SendSimpleMessage ( $NewUser ['id'], $sender, $Time, 1, $from, $Subject, $message );
				
				$db->query ( "UPDATE " . CONFIG . " SET `config_value` = `config_value` + '1' WHERE `config_name` = 'users_amount';" );
				if ($admin == 1) {
					echo "User ".$UserName." wurde aktiviert!";
				} else {
					@session_start();
					$_SESSION['id']			= $NewUser['id'];
					$_SESSION['username']	= $UserName;
					$_SESSION['authlevel']	= 0;
					header("location:game.php?page=overview");
				}
			}
		} else {
			header("Location: index.php");
		}
	break;
	case 'lostpassword': 
		$USERmail = request_var ( 'email', '' );
		if ($mode == "send") {
			$ExistMail = $db->fetch_array ( $db->query ( "SELECT `username` FROM " . USERS . " WHERE `email` = '" . $db->sql_escape($USERmail) . "' LIMIT 1;" ) );
			if (empty($ExistMail['username'])) {
				$template->message($LNG['mail_not_exist'], "index.php?page=lostpassword", 3, true);
			} else {
				$Caracters = "aazertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
				$Count = strlen($Caracters);
				$Taille = 8;
				$NewPass = "";
				for($i = 0; $i < $Taille; $i ++) {
					$CaracterBoucle = rand ( 0, $Count - 1 );
					$NewPass .= substr ( $Caracters, $CaracterBoucle, 1 );
				}

				$MailRAW		= file_get_contents("./language/".$CONF['lang']."/email/email_lost_password.txt");
				$MailContent	= sprintf($MailRAW, $ExistMail['username'], $CONF['game_name'], $NewPass, "http://".$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"]);			
			
				$Mail			= MailSend($USERmail, $ExistMail['username'], $LNG['mail_title'], $MailContent);
				
				if($Mail === true)
				{
					$db->query("UPDATE ".USERS." SET `password` ='" . md5($NewPass) . "' WHERE `username` = '".$ExistMail['username']."';");
					$template->message($LNG["mail_sended_true"], "./", 10, true);
				} else {
					$template->message($Mail.'<br>'.$LNG["mail_sended_fail"], "./", 10, true);
				}
			
			}
		} else {
			$template->assign_vars(array(
				'email'			=> $LNG['email'],
				'uni_reg'		=> $LNG['uni_reg'],
				'send'			=> $LNG['send'],
				'AvailableUnis'	=> $AvailableUnis,
				'chose_a_uni'	=> $LNG['chose_a_uni'],
			));
			$template->display('public/lostpassword.tpl');
		}
		break;
	case 'reg' :
		
		if ($CONF['reg_closed'] == 1){
			$template->assign_vars(array(
				'closed'	=> $LNG['reg_closed'],
				'info'		=> $LNG['info'],
			));
			$template->display('public/registry_closed.tpl');
			exit;
		}
		switch ($mode) {
			case 'send' :
			
				$errors = "";
				
				$UserPass 	= request_var ('password', '');
				$UserPass2 	= request_var ('password2', '');
				$UserName 	= trim(request_var('character', '', UTF8_SUPPORT));
				$UserEmail 	= trim(request_var('email', ''));
				$UserEmail2	= trim(request_var('email2', ''));
				$agbrules 	= request_var ('rgt', '');
				$Exist['userv'] = $db->fetch_array($db->query("SELECT username, email FROM ".USERS." WHERE username = '".$db->sql_escape($UserName)."' OR email = '".$db->sql_escape($UserEmail)."';"));
				$Exist['vaild'] = $db->fetch_array($db->query("SELECT username, email FROM ".USERS_VALID." WHERE username = '".$db->sql_escape($UserName)."' OR email = '".$db->sql_escape($UserEmail)."';"));
				
				if ($CONF ['capaktiv'] === '1') {
					require_once ('includes/libs/reCAPTCHA/recaptchalib.php');
					$resp = recaptcha_check_answer($CONF['capprivate'], $_SERVER ["REMOTE_ADDR"], request_var ( 'recaptcha_challenge_field', '' ), request_var ( 'recaptcha_response_field', '' ) );
					if (!$resp->is_valid)
						$errorlist .= $LNG['wrong_captcha'];
				}
				
				if (!ValidateAddress($UserEmail)) 
					$errors .= $LNG['invalid_mail_adress'];
				
				if (!$UserName) 
					$errors .= $LNG['empty_user_field'];
				
				if (strlen($UserPass) < 6)
					$errors .= $LNG['password_lenght_error'];
				
				if ($UserPass != $UserPass2)
					$errors .= $LNG['different_passwords'];				
				
				if ($UserEmail != $UserEmail2)
					$errors .= $LNG['different_mails'];
				
				if (!CheckName($UserName))
					$errors .= (UTF8_SUPPORT) ? $LNG['user_field_no_space'] : $LNG['user_field_no_alphanumeric'];			
				
				if ($agbrules != 'on')
					$errors .= $LNG['terms_and_conditions'];

				if ((isset($Exist['userv']['username']) || isset($Exist['vaild']['username']) && ($UserName == $Exist['userv']['username'] || $UserName == $Exist['vaild']['username'])))
					$errors .= $LNG['user_already_exists'];

				if ((isset($Exist['userv']['email']) || isset($Exist['vaild']['email'])) && ($UserEmail == $Exist['userv']['email'] || $UserEmail == $Exist['vaild']['email']))
					$errors .= $LNG['mail_already_exists'];
				
				if (!empty($errors)) {
					message($errors, "index.php?page=reg&lang=".DEFAULT_LANG, "3", false, false );
				} else {
					$md5newpass = md5($UserPass);
					
					$characters = array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z" );
					$size = 15;
					for($i = 0; $i < $size; $i ++) {
						$clef .= ($i % 2) ? strtoupper ( $characters [array_rand ( $characters )] ) : $characters [array_rand ( $characters )];
					}

					if($CONF['user_valid'] == 0 || $CONF['smtp_host'] == '' || $CONF['smtp_port'] == 0 || $CONF['smtp_user'] == '' || $CONF['smtp_pass'] == '')
					{
						$QryInsertUser = "INSERT INTO " . USERS_VALID . " SET ";
						$QryInsertUser .= "`username` = '" . $db->sql_escape ( $UserName ) . "', ";
						$QryInsertUser .= "`email` = '" . $db->sql_escape ( $UserEmail ) . "', ";
						$QryInsertUser .= "`date` = '" . time () . "', ";
						$QryInsertUser .= "`cle` = '" . $clef . "', ";
						$QryInsertUser .= "`password`='" . $md5newpass . "', ";
						$QryInsertUser .= "`ip` = '" . $_SERVER ["REMOTE_ADDR"] . "'; ";
						$db->query($QryInsertUser);
						
						exit(header("Location: index.php?page=reg&mode=valid&id=".$md5newpass."&clef=" . $clef));
					}					

					$MailSubject 	= $LNG['reg_mail_message_pass'];
					$MailRAW		= file_get_contents("./language/".$CONF['lang']."/email/email_vaild_reg.txt");
					$MailContent	= sprintf($MailRAW, $UserName, $CONF['game_name'], "http://".$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"], $clef, $UserPass, ADMINEMAIL, $md5newpass);
		
					MailSend($UserEmail, $UserName, $MailSubject, $MailContent);
					$QryInsertUser = "INSERT INTO " . USERS_VALID . " SET ";
					$QryInsertUser .= "`username` = '" . $db->sql_escape ( $UserName ) . "', ";
					$QryInsertUser .= "`email` = '" . $db->sql_escape ( $UserEmail ) . "', ";
					$QryInsertUser .= "`date` = '" . time () . "', ";
					$QryInsertUser .= "`cle` = '" . $clef . "', ";
					$QryInsertUser .= "`password`='" . $md5newpass . "', ";
					$QryInsertUser .= "`ip` = '" . $_SERVER ["REMOTE_ADDR"] . "'; ";
					$db->query ($QryInsertUser);
					message($LNG['reg_completed'], "?lang=".DEFAULT_LANG, 10, false, false );
				}
			break;
			case 'valid' :		
				$pseudo 	 = request_var('id', '');
				$clef 		 = request_var('clef', '');
				$admin 	 	 = request_var('admin', 0);
				$Valider	 = $db->fetch_array($db->query("SELECT `username`, `password`, `email`, `ip` FROM ".USERS_VALID." WHERE `cle` = '".$db->sql_escape($clef)."' AND `password` = '".$db->sql_escape($pseudo)."';"));
				
				if($Valider == "") 
					die(header("Location: ./"));
				
				$UserName 	 = $Valider['username'];
				$UserPass 	 = $Valider['password'];
				$UserMail 	 = $Valider['email'];
				$UserIP 	 = $Valider['ip'];
					
				$QryInsertUser = "INSERT INTO " . USERS . " SET ";
				$QryInsertUser .= "`username` = '" . $UserName . "', ";
				$QryInsertUser .= "`email` = '" . $UserMail . "', ";
				$QryInsertUser .= "`email_2` = '" . $UserMail . "', ";
				$QryInsertUser .= "`ip_at_reg` = '" . $UserIP . "', ";
				$QryInsertUser .= "`id_planet` = '0', ";
				$QryInsertUser .= "`onlinetime` = '" . time () . "', ";
				$QryInsertUser .= "`register_time` = '" . time () . "', ";
				$QryInsertUser .= "`password` = '" . $UserPass . "', ";
				$QryInsertUser .= "`dpath` = '" . DEFAULT_SKINPATH . "', ";
				$QryInsertUser .= "`uctime`= '0';";
				$QryInsertUser .= "DELETE FROM " . USERS_VALID . " WHERE username='" . $UserName . "';";
				$db->multi_query($QryInsertUser);

				if($CONF['smtp_host'] != '' && $CONF['smtp_port'] != 0 && $CONF['smtp_user'] != '' && $CONF['smtp_pass'] != '')
				{				
					$MailSubject	= sprintf($LNG['reg_mail_reg_done'], $CONF['game_name']);	
					$MailRAW		= file_get_contents("./language/".$CONF['lang']."/email/email_reg_done.txt");
					$MailContent	= sprintf($MailRAW, $UserName, $CONF['game_name']);	
					MailSend($UserMail, $UserName, $MailSubject, $MailContent);
				}
				
				$NewUser = $db->fetch_array ( $db->query ( "SELECT `id` FROM " . USERS . " WHERE `username` = '" . $UserName . "';" ) );
				
				$LastSettedGalaxyPos = $CONF['LastSettedGalaxyPos'];
				$LastSettedSystemPos = $CONF['LastSettedSystemPos'];
				$LastSettedPlanetPos = $CONF['LastSettedPlanetPos'];
				
				while (!isset($newpos_checked)) {
					for($Galaxy = $LastSettedGalaxyPos; $Galaxy <= MAX_GALAXY_IN_WORLD; $Galaxy ++) {
						for($System = $LastSettedSystemPos; $System <= MAX_SYSTEM_IN_GALAXY; $System ++) {
							for($Posit = $LastSettedPlanetPos; $Posit <= 4; $Posit ++) {
								$Planet = round ( rand ( 4, 12 ) );
								
								switch ($LastSettedPlanetPos) {
									case 1 :
										$LastSettedPlanetPos += 1;
										break;
									case 2 :
										$LastSettedPlanetPos += 1;
										break;
									case 3 :
										if ($LastSettedSystemPos == MAX_SYSTEM_IN_GALAXY) {
											$LastSettedGalaxyPos += 1;
											$LastSettedSystemPos = 1;
											$LastSettedPlanetPos = 1;
											break;
										} else {
											$LastSettedPlanetPos = 1;
										}
										
										$LastSettedSystemPos += 1;
										break;
								}
								break;
							}
							break;
						}
						break;
					}
					
					if (!CheckPlanetIfExist($Galaxy, $System, $Planet))
					{					
						require_once(ROOT_PATH.'includes/functions/CreateOnePlanetRecord.'.PHP_EXT);
						CreateOnePlanetRecord ($Galaxy, $System, $Planet, $NewUser['id'], $UserPlanet, true);
						$QryInsertConfig  = "UPDATE " . CONFIG . " SET `config_value` = '" . $LastSettedGalaxyPos . "' WHERE `config_name` = 'LastSettedGalaxyPos';";
						$QryInsertConfig .= "UPDATE " . CONFIG . " SET `config_value` = '" . $LastSettedSystemPos . "' WHERE `config_name` = 'LastSettedSystemPos';";
						$QryInsertConfig .= "UPDATE " . CONFIG . " SET `config_value` = '" . $LastSettedPlanetPos . "' WHERE `config_name` = 'LastSettedPlanetPos';";
						$db->multi_query($QryInsertConfig);
						$newpos_checked = true;
					}
				}
				$PlanetID = $db->fetch_array($db->query("SELECT `id` FROM ".PLANETS." WHERE `id_owner` = '".$NewUser ['id']."';" ));
				
				$QryUpdateUser = "UPDATE " . USERS . " SET ";
				$QryUpdateUser .= "`id_planet` = '" . $PlanetID ['id'] . "', ";
				$QryUpdateUser .= "`current_planet` = '" . $PlanetID ['id'] . "', ";
				$QryUpdateUser .= "`galaxy` = '" . $Galaxy . "', ";
				$QryUpdateUser .= "`system` = '" . $System . "', ";
				$QryUpdateUser .= "`planet` = '" . $Planet . "' ";
				$QryUpdateUser .= "WHERE ";
				$QryUpdateUser .= "`id` = '" . $NewUser ['id'] . "' ";
				$QryUpdateUser .= "LIMIT 1;";
				$QryUpdateUser .= "INSERT INTO ".STATPOINTS." (`id_owner`, `id_ally`, `stat_type`, `stat_code`, `tech_rank`, `tech_old_rank`, `tech_points`, `tech_count`, `build_rank`, `build_old_rank`, `build_points`, `build_count`, `defs_rank`, `defs_old_rank`, `defs_points`, `defs_count`, `fleet_rank`, `fleet_old_rank`, `fleet_points`, `fleet_count`, `total_rank`, `total_old_rank`, `total_points`, `total_count`, `stat_date`) VALUES (".$NewUser['id'].", 0, 1, 1, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, 1, 0, 0, 0, '".($CONF ['users_amount'] + 1)."', '".($CONF ['users_amount'] + 1)."', 0, 0, ".TIMESTAMP.");";
				$db->multi_query ( $QryUpdateUser );
				
				$from 		= $LNG ['welcome_message_from'];
				$sender 	= $LNG ['welcome_message_sender'];
				$Subject 	= $LNG ['welcome_message_subject'];
				$message 	= sprintf($LNG['welcome_message_content'], $CONF['game_name']);
				SendSimpleMessage ( $NewUser ['id'], $sender, $Time, 1, $from, $Subject, $message );
				
				$db->query ( "UPDATE " . CONFIG . " SET `config_value` = `config_value` + '1' WHERE `config_name` = 'users_amount';" );
				if ($admin == 1) {
					echo sprintf($LNG['user_active'], $UserName);
				} else {
					session_start();
					$_SESSION['id']			= $NewUser['id'];
					$_SESSION['username']	= $UserName;
					$_SESSION['authlevel']	= 0;	
					
					header("location:game.php?page=overview");
				
				}
			break;
			default:
				$dir = opendir(ROOT_PATH.'language');
				while (($cdir = readdir($dir)) !== false)
				{
					if($cdir == '.' || $cdir == '..' || $cdir == '.htaccess' || $cdir == '.svn')
						continue;
					
					$AvailableLangs[$cdir]	= ucwords($cdir);
				}
				closedir($dir);
				
				$template->assign_vars(array(
					'server_message_reg'			=> $LNG['server_message_reg'],
					'register_at_reg'				=> $LNG['register_at_reg'],
					'user_reg'						=> $LNG['user_reg'],
					'pass_reg'						=> $LNG['pass_reg'],
					'pass2_reg'						=> $LNG['pass2_reg'],
					'email_reg'						=> $LNG['email_reg'],
					'email2_reg'					=> $LNG['email2_reg'],
					'lang_reg'						=> $LNG['lang_reg'],
					'captcha_reg'					=> $LNG['captcha_reg'],
					'register_now'					=> $LNG['register_now'],
					'accept_terms_and_conditions'	=> sprintf($LNG['accept_terms_and_conditions'], DEFAULT_LANG),
					'captcha_reload'				=> $LNG['captcha_reload'],
					'captcha_help'					=> $LNG['captcha_help'],
					'captcha_get_image'				=> $LNG['captcha_get_image'],
					'captcha_reload'				=> $LNG['captcha_reload'],
					'captcha_get_audio'				=> $LNG['captcha_get_audio'],
					'AvailableUnis'					=> $AvailableUnis,
					'AvailableLangs'				=> $AvailableLangs,
					'uni_reg'						=> $LNG['uni_reg'],
					'chose_a_uni'					=> $LNG['chose_a_uni'],
				));
				$template->display('public/registry_form.tpl');
			break;
		}
		break;
	case 'agb' :
		$template->assign_vars(array(
			'agb'				=> $LNG['agb'],
			'agb_overview'		=> $LNG['agb_overview'],
		));
		$template->display('public/index_agb.tpl');
		break;
	case 'rules' :
		$template->assign_vars(array(
			'rules'				=> $LNG['rules'],
			'rules_overview'	=> $LNG['rules_overview'],
			'rules_info1'		=> sprintf($LNG['rules_info1'], $CONF['forum_url']),
			'rules_info2'		=> $LNG['rules_info2'],
		));
		$template->display('public/index_rules.tpl');
		break;
	case 'screens' :
		$template->display('public/index_screens.tpl');
		break;
	case 'top100' :
		$top = $db->query("SELECT * FROM ".TOPKB." ORDER BY gesamtunits DESC LIMIT 100;");
		while($data = $db->fetch_array($top)) {
			$TopKBList[]	= array(
				'result'	=> $data['fleetresult'],
				'time'		=> date("D d M H:i:s", $data['time']),
				'units'		=> pretty_number($data['gesamtunits']),
				'rid'		=> $data['rid'],
				'attacker'	=> $data['angreifer'],
				'defender'	=> $data['defender'],
				'result'	=> $data['fleetresult'],
			);
		}
			
		$template->assign_vars(array(	
			'AvailableUnis'	=> $AvailableUnis,
			'ThisUni'		=> $ThisUni,
			'tkb_units'		=> $LNG['tkb_units'],
			'tkb_datum'		=> $LNG['tkb_datum'],
			'tkb_owners'	=> $LNG['tkb_owners'],
			'tkb_platz'		=> $LNG['tkb_platz'],
			'tkb_top'		=> $LNG['tkb_top'],
			'tkb_gratz'		=> $LNG['tkb_gratz'],
			'tkb_legende'	=> $LNG['tkb_legende'],
			'tkb_gewinner'	=> $LNG['tkb_gewinner'],
			'tkb_verlierer'	=> $LNG['tkb_verlierer'],
			'TopKBList'		=> $TopKBList,
		));
			
		$template->display('public/index_top100.tpl');
		break;
	case 'pranger' :
		$PrangerRAW = $db->query("SELECT * FROM ".BANNED." ORDER BY `id`;");

		while($u = $db->fetch_array($PrangerRAW))
		{
			$PrangerList[]	= array(
				'player'	=> $u['who'],
				'theme'		=> $u['theme'],
				'from'		=> date("d. M Y H:i:s",$u['time']),
				'to'		=> date("d. M Y H:i:s",$u['longer']),
				'admin'		=> $u['author'],
				'mail'		=> $u['email'],
				'info'		=> sprintf($LNG['bn_writemail'], $u['author']),
			);
		}
		
		$template->assign_vars(array(	
			'AvailableUnis'				=> $AvailableUnis,
			'ThisUni'					=> $ThisUni,
			'PrangerList'				=> $PrangerList,
			'bn_no_players_banned'		=> $LNG['bn_no_players_banned'],
			'bn_exists'					=> $LNG['bn_exists'],
			'bn_players_banned'			=> $LNG['bn_players_banned'],
			'bn_players_banned_list'	=> $LNG['bn_players_banned_list'],
			'bn_player'					=> $LNG['bn_player'],
			'bn_reason'					=> $LNG['bn_reason'],
			'bn_from'					=> $LNG['bn_from'],
			'bn_until'					=> $LNG['bn_until'],
			'bn_by'						=> $LNG['bn_by'],
		));
		
		$template->display('public/index_pranger.tpl');
		break;
	case 'disclamer':
		$template->assign_vars(array(
			'disclamer'			=> $LNG['disclamer'],
			'disclamer_name'	=> $LNG['disclamer_name'],
			'disclamer_adress'	=> $LNG['disclamer_adress'],
			'disclamer_tel'		=> $LNG['disclamer_tel'],
			'disclamer_email'	=> $LNG['disclamer_email'],
		));
		$template->display('public/index_disclamer.tpl');
		break;
	case 'news' :
		$NewsRAW	= $db->query ("SELECT date,title,text,user FROM ".NEWS." ORDER BY id DESC;");
		while ($NewsRow = $db->fetch($NewsRAW)) {
			$NewsList[]	= array(
				'title' => $NewsRow['title'],
				'from' 	=> sprintf($LNG['news_from'], date("d. M Y H:i:s", $NewsRow['date']), $NewsRow['user']),
				'text' 	=> makebr($NewsRow['text']),
			);
		}
		
		$template->assign_vars(array(
			'NewsList'				=> $NewsList,
			'news_overview'			=> $LNG['news_overview'],
			'news_does_not_exist'	=> $LNG['news_does_not_exist'],
		));
		
		$template->display('public/index_news.tpl');
	break;
	default :
		if ($_POST) {
			$luser = request_var('username', '');
			$lpass = request_var('password', '');
			$login = $db->uniquequery("SELECT `id`,`username`,`authlevel`,`password`,`banaday` FROM " . USERS . " WHERE `username` = '".$db->sql_escape($luser)."' AND `password` = '".md5($lpass)."';");
			
			if (isset($login)) {
				if ($login['banaday'] <= time () && $login['banaday'] != '0') {
					$db->query("UPDATE " . USERS . " SET `banaday` = '0', `bana` = '0' WHERE `username` = '" . $login ['username'] . "';");
				}
				
				@session_start();
				$_SESSION['id']			= $login['id'];
				$_SESSION['username']	= $login['username'];
				$_SESSION['authlevel']	= $login['authlevel'];
				
				$db->query("UPDATE `" . USERS . "` SET `current_planet` = `id_planet` WHERE `id` = '".$login["id"]."';" );

				header("Location: ./game.php?page=overview");
				exit ();
			} else {
				$template->message($LNG['login_error'], "./", 2, true);
			}
		} else {
			$template->assign_vars(array(
				'AvailableUnis'			=> $AvailableUnis,
				'welcome_to'			=> $LNG['welcome_to'],
				'server_description'	=> sprintf($LNG['server_description'], $CONF['game_name']),
				'server_infos'			=> $LNG['server_infos'],
				'login'					=> $LNG['login'],
				'login_info'			=> sprintf($LNG['login_info'], DEFAULT_LANG),
				'user'					=> $LNG['user'],
				'pass'					=> $LNG['pass'],
				'lostpassword'			=> $LNG['lostpassword'],
				'register_now'			=> $LNG['register_now'],
				'screenshots'			=> $LNG['screenshots'],
				'chose_a_uni'			=> $LNG['chose_a_uni'],
				'universe'				=> $LNG['universe'],
			));
			$template->display('public/index_body.tpl');
		}
	break;
}
?>