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



include_once($xgp_root . 'includes/classes/class.GalaxyRows.' . $phpEx);

class ShowGalaxyPage extends GalaxyRows
{

	private function ShowGalaxyRows($Galaxy, $System, $HavePhalanx, $CurrentGalaxy, $CurrentSystem, $CurrentRC, $CurrentMIP, $CanDestroy)
	{
		global $dpath, $user, $xgp_root, $phpEx, $db, $lang;

		$UserPoints    		= $db->fetch_array($db->query("SELECT total_points FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $user['id'] ."';"));
		$GalaxyPlanets		= $db->query("SELECT p.`planet`, p.`id`, p.`id_owner`, p.`name`, p.`image`, p.`diameter`, p.`temp_min`, p.`destruyed`, p.`der_metal`, p.`der_crystal`, p.`id_luna`, u.`id` as `userid`, u.`ally_id`, u.`username`, u.`onlinetime`, u.`urlaubs_modus`, u.`bana`, s.`total_points`, s.`total_rank`, a.`id` as `allyid`, a.`ally_tag`, a.`ally_members`, a.`ally_name`, allys.`total_rank` as `ally_rank` FROM ".PLANETS." p, ".USERS." u, ".STATPOINTS." s, ".ALLIANCE." a, ".STATPOINTS." as allys WHERE p.`galaxy` = '".$Galaxy."' AND p.`system` = '".$System."' AND p.`planet_type` = '1' AND p.`id_owner` = u.`id` AND s.`stat_code` = '1' AND s.`id_owner` = p.`id_owner` AND IF(u.`ally_id` != 0, u.`ally_id` = a.`id` AND allys.`stat_type` = 2 AND allys.`id_owner` = a.`id`,1=1) ORDER BY p.`planet` ASC;");
		$planetcount		= 0;
		while($GalaxyRowPlanets = $db->fetch_array($GalaxyPlanets))
		{
			$PlanetsInGalaxy[$GalaxyRowPlanets['planet']]	= $GalaxyRowPlanets;
		}
	
		for ($Planet = 1; $Planet < 1+(MAX_PLANET_IN_SYSTEM); $Planet++)
		{
			if (!isset($PlanetsInGalaxy[$Planet])) 
			{
				$Result[$Planet]	= false;
				continue;
			}
			
			$GalaxyRowPlanet			= $PlanetsInGalaxy[$Planet];
			$GalaxyRowPlanet['galaxy']	= $Galaxy;
			$GalaxyRowPlanet['system']	= $System;
			
			if ($GalaxyRowPlanet['destruyed'] != 0)
			{
				$this->CheckAbandonPlanetState($GalaxyRowPlanet);
				$Result[$Planet]	= $lang['gl_planet_destroyed'];
			}
			else
			{
				$Result[$Planet]['user']		= $this->GalaxyRowUser($GalaxyRowPlanet, $UserPoints);
				$Result[$Planet]['planet']		= $this->GalaxyRowPlanet($GalaxyRowPlanet, $HavePhalanx, $CurrentGalaxy, $CurrentSystem, $CurrentMIP);
				$Result[$Planet]['planetname']	= $this->GalaxyRowPlanetName ($GalaxyRowPlanet, $HavePhalanx, $CurrentGalaxy, $CurrentSystem);
								
				if ($GalaxyRowPlanet['userid'] != $user['id'])
					$Result[$Planet]['action']	= $this->GalaxyRowActions($GalaxyRowPlanet, $CurrentGalaxy, $CurrentSystem, $CurrentMIP);
				
				if ($GalaxyRowPlanet['ally_id'] != 0)
					$Result[$Planet]['ally']	= $this->GalaxyRowAlly($GalaxyRowPlanet);
				
				if ($GalaxyRowPlanet["der_metal"] != 0 && $GalaxyRowPlanet["der_crystal"] != 0)
					$Result[$Planet]['derbis']	= $this->GalaxyRowDebris($GalaxyRowPlanet, $CurrentRC);
					
				if ($GalaxyRowPlanet['id_luna'] != 0)
				{
					$GalaxyRowMoon   = $db->fetch_array($db->query("SELECT destruyed,id,diameter,name,temp_min FROM ".PLANETS." WHERE `id` = '". $GalaxyRowPlanet["id_luna"] ."' AND planet_type='3';"));

					if ($GalaxyRowMoon["destruyed"] != 0)
						$this->CheckAbandonMoonState($GalaxyRowMoon);
					else
						$Result[$Planet]['moon']	= $this->GalaxyRowMoon($GalaxyRowPlayer, $GalaxyRowMoon, $CanDestroy);
				}
				$planetcount++;
			}
		}
		return array('Result' => $Result, 'planetcount' => $planetcount);
	}

	public function ShowGalaxyPage($CurrentUser, $CurrentPlanet)
	{
		global $xgp_root, $phpEx, $dpath, $resource, $lang, $db, $reslist;
		$PlanetRess 	= new ResourceUpdate($CurrentUser, $CurrentPlanet);

		$template		= new template();
		
		$CurrentPlID   	= $CurrentPlanet['id'];
		$CurrentMIP    	= $CurrentPlanet['interplanetary_misil'];
		$CurrentRC     	= $CurrentPlanet['recycler'];
		$CurrentSP     	= $CurrentPlanet['spy_sonde'];
		$HavePhalanx   	= $CurrentPlanet['phalanx'];
		$CurrentSystem 	= $CurrentPlanet['system'];
		$CurrentGalaxy 	= $CurrentPlanet['galaxy'];
		$CanDestroy    	= $CurrentPlanet[$resource[214]];
		$maxfleet       = $db->num_rows($db->query("SELECT fleet_id FROM ".FLEETS." WHERE `fleet_owner` = '". $CurrentUser['id'] ."' AND `fleet_mission` != 10;"));


		$mode			= request_var('mode', 0);
		$galaxyLeft		= request_var('galaxyLeft', '');
		$galaxyRight	= request_var('galaxyRight', '');
		$systemLeft		= request_var('systemLeft', '');
		$systemRight	= request_var('systemRight', '');
		$galaxy			= min(max(abs(request_var('galaxy', $CurrentPlanet['galaxy'])), 1), MAX_GALAXY_IN_WORLD);
		$system			= min(max(abs(request_var('system', $CurrentPlanet['system'])), 1), MAX_SYSTEM_IN_GALAXY);
		$planet			= min(max(abs(request_var('planet', $CurrentPlanet['planet'])), 1), MAX_PLANET_IN_SYSTEM);
		$current		= request_var('current', 0);
			
		if ($mode == 1)
		{
			if (!empty($galaxyLeft))
				$galaxy	= max($galaxy - 1, 1);
			elseif (!empty($galaxyRight))
				$galaxy	= min($galaxy + 1, MAX_GALAXY_IN_WORLD);

			if (!empty($systemLeft))
				$system	= max($system - 1, 1);
			elseif (!empty($systemRight))
				$system	= min($system + 1, MAX_GALAXY_IN_WORLD);
		}

		if (!($galaxy == $CurrentPlanet['galaxy'] && $system == $CurrentPlanet['system']) || $mode != 0)
		{
			if($CurrentPlanet['deuterium'] < 10)
			{
				$template->message($lang['gl_no_deuterium_to_view_galaxy'], "game.php?page=galaxy&mode=0", 2);
				$PlanetRess->SavePlanetToDB($CurrentUser, $CurrentPlanet);
				exit;
			}
			else
				$CurrentPlanet['deuterium']	-= 10;
		}
	
		$template->set_vars($CurrentUser, $CurrentPlanet);
		$template->loadscript('tw-sack.js');
		$template->loadscript('galaxy.js');
		$template->page_header();
		$template->page_topnav();
		$template->page_leftmenu();
		$template->page_planetmenu();
		$template->page_footer();	
		unset($reslist['defense'][array_search(502, $reslist['defense'])]);
		$MissleSelector[0]	= $lang['gl_all_defenses'];
		foreach($reslist['defense'] as $Element)
		{	
			$MissleSelector[$Element] = $lang['tech'][$Element];
		}
		
		$Result	= $this->ShowGalaxyRows($galaxy, $system, $HavePhalanx, $CurrentGalaxy, $CurrentSystem, $CurrentRC, $CurrentMIP, $CanDestroy);

		$template->assign_vars(array(	
			'GalaxyRows'				=> $Result['Result'],
			'planetcount'				=> sprintf($lang['gl_populed_planets'], $Result['planetcount']),
			'mode'						=> $mode,
			'galaxy'					=> $galaxy,
			'system'					=> $system,
			'planet'					=> $planet,
			'current'					=> $current,
			'currentmip'				=> $CurrentMIP,
			'maxfleetcount'				=> $maxfleet,
			'fleetmax'					=> ($CurrentUser['computer_tech'] + 1) + ($CurrentUser['rpg_commandant'] * COMMANDANT),
			'recyclers'   				=> pretty_number($CurrentRC),
			'spyprobes'   				=> pretty_number($CurrentSP),
			'missile_count'				=> sprintf($lang['gl_missil_to_launch'], $CurrentMIP),
			'spio_anz'					=> $CurrentUser['spio_anz'],
			'current_galaxy'			=> $CurrentPlanet['galaxy'],
			'current_system'			=> $CurrentPlanet['system'],
			'current_planet'			=> $CurrentPlanet['planet'],
			'planet_type' 				=> $CurrentPlanet['planet_type'],
			'MissleSelector'			=> $MissleSelector,
			'gl_solar_system'			=> $lang['gl_solar_system'],
			'gl_galaxy' 				=> $lang['gl_galaxy'],
			'gl_missil_launch_action'	=> $lang['gl_missil_launch_action'],
			'gl_objective'				=> $lang['gl_objective'],
			'gl_missil_launch'			=> $lang['gl_missil_launch'],
			'gl_pos'					=> $lang['gl_pos'],
			'gl_planet'					=> $lang['gl_planet'],
			'gl_alliance'				=> $lang['gl_alliance'],
			'gl_actions'				=> $lang['gl_actions'],
			'gl_name_activity'			=> $lang['gl_name_activity'],
			'gl_player_estate'			=> $lang['gl_player_estate'],
			'gl_debris'					=> $lang['gl_debris'],
			'gl_moon'					=> $lang['gl_moon'],
			'gl_show'					=> $lang['gl_show'],
			'gl_out_space'				=> $lang['gl_out_space'],
			'gl_legend'					=> $lang['gl_legend'],
			'gl_strong_player'			=> $lang['gl_strong_player'],
			'gl_s'						=> $lang['gl_s'],
			'gl_week_player'			=> $lang['gl_week_player'],
			'gl_w'						=> $lang['gl_w'],
			'gl_vacation'				=> $lang['gl_vacation'],
			'gl_v'						=> $lang['gl_v'],
			'gl_banned'					=> $lang['gl_banned'],
			'gl_b'						=> $lang['gl_b'],
			'gl_inactive_seven'			=> $lang['gl_inactive_seven'],
			'gl_i'						=> $lang['gl_i'],
			'gl_inactive_twentyeight'	=> $lang['gl_inactive_twentyeight'],
			'gl_I'						=> $lang['gl_I'],
			'gl_avaible_recyclers'		=> $lang['gl_avaible_recyclers'],
			'gl_avaible_spyprobes'		=> $lang['gl_avaible_spyprobes'],
			'gl_fleets'					=> $lang['gl_fleets'],
			'gl_avaible_missiles'		=> $lang['gl_avaible_missiles'],
			'gl_moon'					=> $lang['gl_moon'],
			'gl_diameter'				=> $lang['gl_diameter'],
			'gl_features'				=> $lang['gl_features'],
			'gl_temperature'			=> $lang['gl_temperature'],
			'gl_actions'				=> $lang['gl_actions'],
			'gl_debris_field'			=> $lang['gl_debris_field'],
			'gl_resources'				=> $lang['gl_resources'],
			'gl_collect'				=> $lang['gl_collect'],
			'gl_with'					=> $lang['gl_with'],
			'gl_alliance_page'			=> $lang['gl_alliance_page'],
			'gl_see_on_stats'			=> $lang['gl_see_on_stats'],
			'gl_alliance_web_page'		=> $lang['gl_alliance_web_page'],
			'gl_spy'					=> $lang['gl_spy'],
			'gl_buddy_request'			=> $lang['gl_buddy_request'],
			'gl_missile_attack'			=> $lang['gl_missile_attack'],
			'gl_player'					=> $lang['gl_player'],
			'gl_playercard'				=> $lang['gl_playercard'],
			'gl_phalanx'				=> $lang['gl_phalanx'],
			'write_message'				=> $lang['write_message'],
		));
		
		$template->show('galaxy_overview.tpl');
		$PlanetRess->SavePlanetToDB($CurrentUser, $CurrentPlanet);	
	}
}
?>