<?php

/**
 *  2Moons
 *  Copyright (C) 2011  Slaver
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
 * @author Slaver <slaver7@gmail.com>
 * @copyright 2009 Lucky <lucky@xgproyect.net> (XGProyecto)
 * @copyright 2011 Slaver <slaver7@gmail.com> (Fork/2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.6.1 (2011-11-19)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */

class ShowBuddyListPage extends AbstractPage
{
	public static $requireModule = MODULE_BUDDYLIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	function request()
	{
		global $USER, $LNG;
		
		$this->initTemplate();
		$this->setWindow('popup');
		
		$id	= HTTP::_GP('id', 0);
		
		if($id == $USER['id'])
		{
			$this->printMessage($LNG['bu_cannot_request_yourself']);
		}
		
		$exists	= $GLOBALS['DATABASE']->countquery("SELECT COUNT(*) FROM ".BUDDY." WHERE (sender = ".$USER['id']." AND owner = ".$id.") OR (owner = ".$USER['id']." AND sender = ".$id.");");
		
		if($exists != 0)
		{
			$this->printMessage($LNG['bu_request_exists']);
		}
		
		$userData	= $GLOBALS['DATABASE']->uniquequery("SELECT username, galaxy, system, planet FROM ".USERS." WHERE id = ".$id.";");

		$this->tplObj->assign_vars(array(
			'username'	=> $userData['username'],
			'galaxy'	=> $userData['galaxy'],
			'system'	=> $userData['system'],
			'planet'	=> $userData['planet'],
			'id'		=> $id,
		));
		
		$this->display('page.buddyList.request.tpl');
	}
	
	function send()
	{
		global $USER, $UNI, $LNG;
		
		$this->initTemplate();
		$this->setWindow('popup');
		$this->tplObj->execscript('window.setTimeout(parent.$.fancybox.close, 2000);');
		
		$id		= HTTP::_GP('id', 0);
		$text	= HTTP::_GP('text', '', UTF8_SUPPORT);
		$test 	= $GLOBALS['DATABASE']->countquery("SELECT COUNT(*) FROM ".BUDDY." WHERE (sender = ".$USER['id']." AND owner = ".$id.") OR (owner = ".$USER['id']." AND sender = ".$id.");");
		
		if($id == $USER['id'])
		{
			$this->printMessage($LNG['bu_cannot_request_yourself']);
		}
		
		$exists	= $GLOBALS['DATABASE']->countquery("SELECT COUNT(*) FROM ".BUDDY." WHERE (sender = ".$USER['id']." AND owner = ".$id.") OR (owner = ".$USER['id']." AND sender = ".$id.");");
		
		if($exists != 0)
		{
			$this->printMessage($LNG['bu_request_exists']);
		}
		
		$GLOBALS['DATABASE']->multi_query("INSERT INTO ".BUDDY." SET 
		sender = ".$USER['id'].", 
		owner = ".$id.", 
		universe = ".$UNI.";
		SET @buddyID = LAST_INSERT_ID();
		INSERT INTO ".BUDDY_REQUEST." SET 
		id = @buddyID, 
		text = '".$GLOBALS['DATABASE']->sql_escape($text)."';");
		
		$this->printMessage($LNG['bu_request_send']);
	}
	
	function delete()
	{
		global $USER;
		
		$id	= HTTP::_GP('id', 0);
		$GLOBALS['DATABASE']->query("DELETE b.*, r.*
					FROM ".BUDDY." b
					LEFT JOIN ".BUDDY_REQUEST." r
					USING (id)
					WHERE b.id = ".$id." AND (sender = ".$USER['id']." OR owner = ".$USER['id'].")");
		$this->redirectTo("game.php?page=buddyList");
		
	}
	
	function accept()
	{
		global $USER;
		
		$id	= HTTP::_GP('id', 0);
		
		$GLOBALS['DATABASE']->query("DELETE FROM ".BUDDY_REQUEST." WHERE id = ".$id.";");
		$this->redirectTo("game.php?page=buddyList");
	}
	
	function show()
	{
		global $USER, $PLANET, $LNG, $UNI;
		
		$BuddyListResult	= $GLOBALS['DATABASE']->query("SELECT 
		a.sender, a.id as buddyid, 
		b.id, b.username, b.onlinetime, b.galaxy, b.system, b.planet, b.ally_id,
		c.ally_name,
		d.text
		FROM (".BUDDY." as a, ".USERS." as b) 
		LEFT JOIN ".ALLIANCE." as c ON c.id = b.ally_id
		LEFT JOIN ".BUDDY_REQUEST." as d ON a.id = d.id
		WHERE 
		(a.sender = ".$USER['id']." AND a.owner = b.id) OR 
		(a.owner = ".$USER['id']." AND a.sender = b.id);");
				
		$myRequestList		= array();
		$otherRequestList	= array();
		$myBuddyList		= array();		
				
		while($BuddyList = $GLOBALS['DATABASE']->fetch_array($BuddyListResult))
		{
			if(isset($BuddyList['text']))
			{
				if($BuddyList['sender'] == $USER['id'])
					$myRequestList[$BuddyList['buddyid']]		= $BuddyList;
				else
					$otherRequestList[$BuddyList['buddyid']]	= $BuddyList;
			}
			else
			{
				$BuddyList['onlinetime']			= floor((TIMESTAMP - $BuddyList['onlinetime']) / 60);
				$myBuddyList[$BuddyList['buddyid']]	= $BuddyList;
			}
		}
		
		$GLOBALS['DATABASE']->free_result($BuddyListResult);
	
		$this->tplObj->assign_vars(array(	
			'myBuddyList'		=> $myBuddyList,
			'myRequestList'			=> $myRequestList,
			'otherRequestList'	=> $otherRequestList,
		));
		
		$this->display('page.buddyList.default.tpl');
	}
}
?>