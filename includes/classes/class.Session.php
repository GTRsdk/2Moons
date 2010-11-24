<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

class Session
{
	function IsUserLogin()
	{
		return !empty($_SESSION['id']);
	}
	
	function GetSessionFromDB()
	{
		global $db;
		return $db->uniquequery("SELECT * FROM ".SESSION." WHERE `sess_id` = '".session_id()."' AND `user_id` = '".$_SESSION['id']."';");
	}
	
	function CreateSession($ID, $Username, $MainPlanet, $Universe, $Authlevel = 0, $dpath = DEFAULT_SKINPATH)
	{
		global $db;
		session_start();
		$_SESSION['id']			= $ID;
		$_SESSION['username']	= $Username;
		$_SESSION['authlevel']	= $Authlevel;	
		$_SESSION['path']		= $this->GetPath();
		$_SESSION['dpath']		= $dpath;
		$_SESSION['planet']		= $MainPlanet;
		$_SESSION['uni']		= $Universe;
		$db->query("INSERT INTO ".SESSION." (`sess_id`, `user_id`, `user_ua`, `user_ip`, `user_side`, `user_method`, `user_lastactivity`) VALUES ('".session_id()."', '".$ID."', '".$db->sql_escape($_SERVER['HTTP_USER_AGENT'])."', '".$_SERVER['REMOTE_ADDR']."', '".$db->sql_escape($_SESSION['path'])."', '".$_SERVER["REQUEST_METHOD"]."', '".TIMESTAMP."') ON DUPLICATE KEY UPDATE `sess_id` = '".session_id()."', `user_ua` = '".$db->sql_escape($_SERVER['HTTP_USER_AGENT'])."', `user_ip` = '".$_SERVER['REMOTE_ADDR']."', `user_side` = '".$db->sql_escape($_SESSION['path'])."', `user_method` = '".$_SERVER["REQUEST_METHOD"]."';");
	}
	
	function GetPath()
	{
		return basename($_SERVER['SCRIPT_NAME']).(!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '');
	}
	
	function UpdateSession()
	{
		global $CONF, $db;
		
		if(request_var('ajax', 0) == 1)
			return true;
			
		$_SESSION['db']	= $this->GetSessionFromDB();
		if(empty($_SESSION['db']) || !$this->CompareIPs($_SESSION['db']['user_ip']))
			redirectTo('index.php?code=2');
		
		$SelectPlanet  		= request_var('cp',0);
		if(!empty($SelectPlanet))
			$IsPlanetMine 	=	$db->uniquequery("SELECT `id` FROM ".PLANETS." WHERE `id` = '".$SelectPlanet."' AND `id_owner` = '".$_SESSION['id']."';");
			
		$_SESSION['path']		= $this->GetPath();
		$_SESSION['planet']		= !empty($IsPlanetMine['id']) ? $IsPlanetMine['id'] : $_SESSION['planet'];

		$SQL  = "UPDATE ".USERS." as u, ".SESSION." as s SET ";
		$SQL .= "u.`onlinetime` = '".TIMESTAMP."', ";
		$SQL .= "u.`user_lastip` = '".$_SERVER['REMOTE_ADDR'] ."', ";
		$SQL .= "s.`user_ip` = '".$_SERVER['REMOTE_ADDR']."', ";
		$SQL .= "s.`user_side` = '".$db->sql_escape($_SESSION['path'])."', ";
		$SQL .= "s.`user_ua` = '".$db->sql_escape($_SERVER['HTTP_USER_AGENT'])."', ";
		$SQL .= "s.`user_method` = '".$_SERVER["REQUEST_METHOD"]."', ";
		$SQL .= "s.`user_lastactivity` = '".TIMESTAMP."' ";
		$SQL .= "WHERE ";
		$SQL .= "u.`id` = '".$_SESSION['id']."' AND s.`sess_id` = '".session_id()."';";
		$db->multi_query($SQL);

		return true;
	}
	
	function CompareIPs($IP)
	{
		if (strpos($_SERVER['REMOTE_ADDR'], ':') !== false && strpos($IP, ':') !== false)
		{
			$s_ip = $this->short_ipv6($IP, COMPARE_IP_BLOCKS);
			$u_ip = $this->short_ipv6($_SERVER['REMOTE_ADDR'], COMPARE_IP_BLOCKS);
		}
		else
		{
			$s_ip = implode('.', array_slice(explode('.', $IP), 0, COMPARE_IP_BLOCKS));
			$u_ip = implode('.', array_slice(explode('.', $_SERVER['REMOTE_ADDR']), 0, COMPARE_IP_BLOCKS));
		}
		
		return ($s_ip == $u_ip);
	}

	function short_ipv6($ip, $length)
	{
		if ($length < 1)
		{
			return '';
		}

		$blocks = substr_count($ip, ':') + 1;
		if ($blocks < 9)
		{
			$ip = str_replace('::', ':' . str_repeat('0000:', 9 - $blocks), $ip);
		}
		if ($ip[0] == ':')
		{
			$ip = '0000' . $ip;
		}
		if ($length < 4)
		{
			$ip = implode(':', array_slice(explode(':', $ip), 0, 1 + $length));
		}

		return $ip;
	}
	
	function DestroySession()
	{
		global $db;
		
		$loeschen	= $db->query("DELETE FROM ".SESSION." WHERE user_id = '".$_SESSION['id']."'"); 
		session_destroy();
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000);
	}
}
?>