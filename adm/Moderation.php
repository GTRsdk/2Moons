<?php

##############################################################################
# *																			 #
# * RN FRAMEWORK															 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By Neko from Xtreme-gameZ.com.ar	 #
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


define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] < 3) die();


$parse	=	$lang;

if ($_GET['moderation'] == '1')
{
	$QueryModeration	=	$db->fetch($db->query("SELECT * FROM ".CONFIG." WHERE `config_name` = 'moderation';"));
	$QueryModerationEx	=	explode(";", $QueryModeration['config_value']);
	$Moderator			=	explode(",", $QueryModerationEx[0]);
	$Operator			=	explode(",", $QueryModerationEx[1]);


	// MODERADORES
	if($Moderator[0] == 1){$parse['view_m'] = 'checked = "checked"';}
	if($Moderator[1] == 1){$parse['edit_m'] = 'checked = "checked"';}
	if($Moderator[2] == 1){$parse['config_m'] = 'checked = "checked"';}
	if($Moderator[3] == 1){$parse['tools_m'] = 'checked = "checked"';}


	// OPERADORES
	if($Operator[0] == 1){$parse['view_o'] = 'checked = "checked"';}
	if($Operator[1] == 1){$parse['edit_o'] = 'checked = "checked"';}
	if($Operator[2] == 1){$parse['config_o'] = 'checked = "checked"';}
	if($Operator[3] == 1){$parse['tools_o'] = 'checked = "checked"';}



	if ($_POST['mode']	==	'Enviar')
	{
		if($_POST['view_m'] == 'on') $view_m = 1; else $view_m = 0; 
		if($_POST['edit_m'] == 'on') $edit_m = 1; else $edit_m = 0; 
		if($_POST['config_m'] == 'on') $config_m = 1; else $config_m = 0;
		if($_POST['tools_m'] == 'on') $tools_m = 1; else $tools_m = 0;
		if($_POST['view_o'] == 'on') $view_o = 1; else $view_o = 0;
		if($_POST['edit_o'] == 'on') $edit_o = 1; else $edit_o = 0;
		if($_POST['config_o'] == 'on') $config_o = 1; else $config_o = 0;
		if($_POST['tools_o'] == 'on') $tools_o = 1; else $tools_o = 0;
	
	
	
		$QueryEdit	=	 $view_m.",".$edit_m.",".$config_m.",".$tools_m.";".$view_o.",".$edit_o.",".$config_o.",".$tools_o.";";

	
		$db->query("UPDATE ".CONFIG." SET `config_value` = '".$QueryEdit."' WHERE `config_name` = 'moderation';");
		header("Location: Moderation.php?moderation=1");
	}
	
	display(parsetemplate(gettemplate('adm/ModerationBody'), $parse), false, '' , true, false);
}
elseif ($_GET['moderation'] == '2')
{
	for ($i	= 0; $i < 4; $i++)
		{
			$parse['authlevels']	.=	"<option value=\"".$i."\">".$lang['ad_authlevel'][$i]."</option>";
		}
		
		
		if ($_GET['get'] == 'adm')
			$QueryUsers	=	$db->query("SELECT `id`, `username`, `authlevel` FROM ".USERS." WHERE `authlevel` = '3'");
		elseif ($_GET['get'] == 'ope')
			$QueryUsers	=	$db->query("SELECT `id`, `username`, `authlevel` FROM ".USERS." WHERE `authlevel` = '2'");
		elseif ($_GET['get'] == 'mod')
			$QueryUsers	=	$db->query("SELECT `id`, `username`, `authlevel` FROM ".USERS." WHERE `authlevel` = '1'");
		elseif ($_GET['get'] == 'pla')
			$QueryUsers	=	$db->query("SELECT `id`, `username`, `authlevel` FROM ".USERS." WHERE `authlevel` = '0';");
		else
			$QueryUsers	=	$db->query("SELECT `id`, `username`, `authlevel` FROM ".USERS.";");
			
			
		while ($List	=	$db->fetch_array($QueryUsers))
		{
			$Authlevels	=	$List['authlevel'];
			for ($i	= 0; $i < 4; $i++)
			{
				if ($Authlevels == $i){$Authlevels = $lang['ad_authlevel'][$i];}
			}
			
			
			$parse['List']	.=	"<option value=\"".$List['id']."\">".$List['username']."&nbsp;&nbsp;(".$Authlevels.")</option>";
		}
		
		
		if ($_POST)
		{
			if ($_POST['id_1'] != NULL && $_POST['id_2'] != NULL)
			{
				$parse['display']	=	'<tr><th colspan="3"><font color=red>'.$lang['ad_authlevel_error_2'].'</font></th></tr>';
			}
			elseif(!$_POST['id_1'] && !$_POST['id_2'])
			{
				$parse['display']	=	'<tr><th colspan="3"><font color=red>'.$lang['ad_forgiven_id'].'</font></th></tr>';
			}
			elseif(!$_POST['id_1'] && !is_numeric($_POST['id_2']))
			{
				$parse['display']	=	'<tr><th colspan="3"><font color=red>'.$lang['ad_only_numbers'].'</font></th></tr>';
			}
			elseif($_POST['id_1'] == '1' || $_POST['id_2'] == '1')
			{
				$parse['display']	=	'<tr><th colspan="3"><font color=red>'.$lang['ad_authlevel_error_3'].'</font></th></tr>';
			}
			else
			{
				if ($_POST['id_1'] != NULL)
				{
					$id	=	$_POST['id_1'];
				}
				else
				{
					$id	=	$_POST['id_2'];
				}
				
				$QueryFind	=	$db->fetch_array($db->query("SELECT `authlevel` FROM ".USERS." WHERE `id` = '".$id."';"));
				
				if($QueryFind['authlevel'] != $_POST['authlevel'])
				{						
					$db->query("UPDATE ".USERS." SET `authlevel` = '".$_POST['authlevel']."' WHERE `id` = '".$id."';");
					$db->query("UPDATE ".PLANETS." SET `id_level` = '".$_POST['authlevel']."' WHERE `id_owner` = '".$id."';");
					$parse['display']	=	'<tr><th colspan="3"><font color=lime>'.$lang['ad_authlevel_succes'].'</font></th></tr>';
				}
				else
				{
					$parse['display']	=	'<tr><th colspan="3"><font color=red>'.$lang['ad_authlevel_error'].'</font></th></tr>';
				}
			}
		}
		display (parsetemplate(gettemplate("adm/AuthlevelBody"), $parse), false, '', true, false);
}
else
{
	die();
}
?>