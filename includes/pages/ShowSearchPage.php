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

if(!defined('INSIDE')){ die(header("location:../../"));}

function ShowSearchPage()
{
	global $dpath, $lang, $db;
			$PlanetRess = new ResourceUpdate($CurrentUser, $CurrentPlanet);

	$template	= new template();
	$template->page_header();
	$template->page_topnav();
	$template->page_leftmenu();
	$template->page_planetmenu();
	$template->page_footer();	
	
	$type 		= request_var('type','');
	$searchtext = request_var('searchtext','');
	switch($type) {
		case 'playername':
			$search = $db->query("SELECT a.id, a.username, a.ally_id, a.ally_name, a.galaxy, a.system, a.planet, b.name, c.total_rank FROM ".USERS." as a, ".PLANETS." as b, ".STATPOINTS." as c WHERE c.stat_type = 1 AND c.id_owner = a.id AND a.username LIKE '%".$db->sql_escape($searchtext)."%' AND a.id_planet = b.id LIMIT 25;");
			while($s = $db->fetch_array($search))
			{
				$SearchResult[]	= array(
					'planetname'	=> $s['name'],
					'username' 		=> $s['username'],
					'userid' 		=> $s['id'],
					'allyname'	 	=> $s['ally_name'],
					'allyid'		=> $s['ally_id'],
					'galaxy' 		=> $s['galaxy'],
					'system'		=> $s['system'],
					'planet'		=> $s['planet'],
					'rank'			=> $s['total_rank'],
				);	
			}
		break;
		case 'planetname':
			$search = $db->query("SELECT a.name, a.galaxy, a.planet, a.system, b.ally_name, b.id, b.ally_id, b.username, c.total_rank FROM ".PLANETS." as a, ".USERS." as b, ".STATPOINTS." as c WHERE c.stat_type = 1 AND c.id_owner = b.id AND a.id = b.id_planet AND a.name LIKE '%".$db->sql_escape($searchtext)."%' LIMIT 25;");
			while($s = $db->fetch_array($search))
			{
				$SearchResult[]	= array(
					'planetname'	=> $s['name'],
					'username' 		=> $s['username'],
					'userid' 		=> $s['id'],
					'allyname'	 	=> $s['ally_name'],
					'allyid'		=> $s['ally_id'],
					'galaxy' 		=> $s['galaxy'],
					'system'		=> $s['system'],
					'planet'		=> $s['planet'],
					'rank'			=> $s['total_rank'],
				);	
			}
		break;
		case "allytag":
			$search = $db->query("SELECT a.ally_name, a.ally_tag, a.ally_members, b.total_points FROM ".ALLIANCE." as a, ".STATPOINTS." as b WHERE b.stat_type = 1 AND b.id_owner = a.id AND a.ally_tag LIKE '%".$db->sql_escape($searchtext)."%' LIMIT 25;");
			while($s = $db->fetch_array($search))
			{
				$SearchResult[]	= array(
					'allypoints'	=> pretty_number($s['total_points']),
					'allytag'		=> $s['ally_tag'],
					'allymembers'	=> $s['ally_members'],
					'allyname'		=> $s['ally_name'],
				);
			}
		break;
		case "allyname":
			$search = $db->query("SELECT a.ally_name, a.ally_tag, a.ally_members, b.total_points FROM ".ALLIANCE." as a, ".STATPOINTS." as b WHERE b.stat_type = 1 AND b.id_owner = a.id AND a.ally_name LIKE '%".$db->sql_escape($searchtext)."%' LIMIT 25;");
			while($s = $db->fetch_array($search))
			{
				$SearchResult[]	= array(
					'allypoints'	=> pretty_number($s['total_points']),
					'allytag'		=> $s['ally_tag'],
					'allymembers'	=> $s['ally_members'],
					'allyname'		=> $s['ally_name'],
				);
			}
		break;
	}

	$SeachTypes	= array("playername" => $lang['sh_player_name'], "planetname" => $lang['sh_planet_name'], "allytag" => $lang['sh_alliance_tag'], "allyname" => $lang['sh_alliance_name']);
	$template->assign_vars(array(
		'SearchResult'				=> $SearchResult,
		'SeachTypes'				=> $SeachTypes,
		'SeachInput'				=> $searchtext,
		'SeachType'					=> $type,
		'sh_search'					=> $lang['sh_search'],
		'sh_search_in_the_universe'	=> $lang['sh_search_in_the_universe'],
		'sh_buddy_request'			=> $lang['sh_buddy_request'],
		'sh_write_message'			=> $lang['sh_write_message'],
		'sh_name'					=> $lang['sh_name'],
		'sh_alliance'				=> $lang['sh_alliance'],
        'sh_planet'					=> $lang['sh_planet'],
		'sh_coords'					=> $lang['sh_coords'],
		'sh_position'				=> $lang['sh_position'],
		'sh_tag'					=> $lang['sh_tag'],
		'sh_members'				=> $lang['sh_members'],
		'sh_points'					=> $lang['sh_points'],
	));
	
	$template->show("search_body.tpl");
	$PlanetRess->SavePlanetToDB($CurrentUser, $CurrentPlanet);
}
?>