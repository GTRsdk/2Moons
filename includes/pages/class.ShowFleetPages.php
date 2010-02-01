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

if(!defined('INSIDE')){ die(header("location:../../"));}

require_once($xgp_root . 'includes/classes/class.FleetFunctions.' . $phpEx);

class ShowFleetPages extends FleetFunctions
{

	public static function ShowFleetPage($CurrentUser, $CurrentPlanet)
	{
		global $reslist, $resource, $db, $lang;

		$parse				= $lang;
		$FleetID			= request_var('fleetid', 0);
		$GetAction			= request_var('action', "");
		
		if(!empty($FleetID))
		{
			switch($GetAction){
				case "sendfleetback":
					parent::SendFleetBack($CurrentUser, $FleetID);
				break;
			}
		}
		
		$MaxFlyingFleets 	= parent::GetCurrentFleets($CurrentUser['id']);
		$MaxFlyingRaks 		= parent::GetCurrentFleets($CurrentUser['id'], 10);		
		$MaxExpedition      = $CurrentUser[$resource[124]];

		if ($MaxExpedition >= 1)
		{
			$ExpeditionEnCours  = parent::GetCurrentFleets($CurrentUser['id'], 15);
			$EnvoiMaxExpedition = floor(sqrt($MaxExpedition));
		}
		else
		{
			$ExpeditionEnCours 	= 0;
			$EnvoiMaxExpedition = 0;
		}

		$MaxFlottes     = parent::GetMaxFleetSlots($CurrentUser);

		$galaxy         = request_var('galaxy', $CurrentPlanet['galaxy']);
		$system         = request_var('system', $CurrentPlanet['system']);
		$planet         = request_var('planet', $CurrentPlanet['planet']);
		$planettype     = request_var('planettype', $CurrentPlanet['planet_type']);
		$target_mission = request_var('target_mission', 0);
		$ShipData       = "";

		$parse['flyingfleets']			= $MaxFlyingFleets - $MaxFlyingRaks;
		$parse['maxfleets']				= $MaxFlottes;
		$parse['currentexpeditions']	= $ExpeditionEnCours;
		$parse['maxexpeditions']		= $EnvoiMaxExpedition;

		$fq = $db->query("SELECT * FROM ".FLEETS." WHERE fleet_owner='".$CurrentUser["id"]."' AND fleet_mission <> 10;");
		$i  = 0;

		while ($f = $db->fetch_array($fq))
		{
			$i++;
			$FleetPageRow .= "<tr height=20>";
			$FleetPageRow .= "<th>".$i."</th>";
			$FleetPageRow .= "<th>";
			$FleetPageRow .= "<a>". $lang['type_mission'][$f['fleet_mission']] ."</a>";
			if (($f['fleet_start_time'] + 1) == $f['fleet_end_time'])
				$FleetPageRow .= "<br><a title=\"".$lang['fl_returning']."\">".$lang['fl_r']."</a>";
			else
				$FleetPageRow .= "<br><a title=\"".$lang['fl_onway']."\">".$lang['fl_a']."</a>";
			$FleetPageRow .= "</th>";
			$FleetPageRow .= "<th><a title=\"";

			$fleet = explode(";", $f['fleet_array']);
			$e = 0;
			foreach ($fleet as $a => $b)
			{
				if ($b != '')
				{
					$e++;
					$a = explode(",", $b);
					$FleetPageRow .= $lang['tech'][$a[0]]. ":". $a[1] ."\n";
					if ($e > 1)
					{
						$FleetPageRow .= "\t";
					}
				}
			}
			$FleetPageRow .= "\">". pretty_number($f['fleet_amount']) ."</a></th>";
			$FleetPageRow .= "<th><a href=\"game.php?page=galaxy&mode=3&galaxy=".$f['fleet_start_galaxy']."&system=".$f['fleet_start_system']."\" name=\"".$f['fleet_start_galaxy'].":".$f['fleet_start_system'].":".$f['fleet_start_planet']."\">[".$f['fleet_start_galaxy'].":".$f['fleet_start_system'].":".$f['fleet_start_planet']."]</a></th>";
			$FleetPageRow .= "<th>". date("d M Y H:i:s", $f['fleet_start_time']) ."</th>";
			$FleetPageRow .= "<th><a href=\"game.php?page=galaxy&mode=3&galaxy=".$f['fleet_end_galaxy']."&system=".$f['fleet_end_system']."\" name=\"".$f['fleet_end_galaxy'].":".$f['fleet_end_system'].":".$f['fleet_end_planet']."\">[".$f['fleet_end_galaxy'].":".$f['fleet_end_system'].":".$f['fleet_end_planet']."]</a></th>";
			$FleetPageRow .= "<th>". date("d M Y H:i:s", $f['fleet_end_time']) ."</th>";
			$FleetPageRow .= "<th><font color=\"lime\"><div id=\"time_0\"><font>". pretty_time(floor($f['fleet_end_time'] + 1 - time())) ."</font></th>";
			$FleetPageRow .= "<th>";

			if ($f['fleet_mess'] == 0)
			{
					$FleetPageRow .= "<form action=\"?page=fleet&amp;action=sendfleetback\" method=\"post\">";
					$FleetPageRow .= "<input name=\"fleetid\" value=\"". $f['fleet_id'] ."\" type=\"hidden\">";
					$FleetPageRow .= "<input value=\"".$lang['fl_send_back']."\" type=\"submit\">";
					$FleetPageRow .= "</form>";

				if ($f['fleet_mission'] == 1)
				{
					$FleetPageRow .= "<form action=\"game.php?page=fleetACS\" method=\"post\">";
					$FleetPageRow .= "<input name=\"fleetid\" value=\"". $f['fleet_id'] ."\" type=\"hidden\">";
					$FleetPageRow .= "<input value=\"".$lang['fl_acs']."\" type=\"submit\">";
					$FleetPageRow .= "</form>";
				}
			}
			else
				$FleetPageRow .= "&nbsp;-&nbsp;";

			$FleetPageRow .= "</th>";
			$FleetPageRow .= "</tr>";
		}

		if ($i == 0)
		{
			$FleetPageRow .= "<tr>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "<th>-</th>";
			$FleetPageRow .= "</tr>";
		}

		$parse['fleetpagerow'] = $FleetPageRow;

		$parse['message_nofreeslot'] = ($MaxFlottes == $MaxFlyingFleets - $MaxFlyingRaks) ? "<tr height=\"20\"><th colspan=\"9\"><font color=\"red\">".$lang['fl_no_more_slots']."</font></th></tr>":"";

		if (!$CurrentPlanet)
			header("location:game.php?page=fleet");

		foreach ($reslist['fleet'] as $n => $i)
		{
			if ($CurrentPlanet[$resource[$i]] > 0)
			{
				$page .= "<tr height=\"20\">";
				$page .= "<th>";
				$page .= ($i == 212)? "": "<a title=\"" . $lang['fl_speed_title'] . (parent::GetFleetMaxSpeed ( $i, $CurrentUser )) ."\">";
				$page .= $lang['tech'][$i] . "</a></th>";
				$page .= "<th id=\"ship".$i."_value\">". pretty_number ($CurrentPlanet[$resource[$i]]);
				$page .= "</th>";

				if ($i == 212)
					$page .= "<th></th><th></th>";
				else
				{
					$page .= "<th><a href=\"javascript:maxShip('ship". $i ."'); shortInfo();\">".$lang['fl_max']."</a> </th>";
					$page .= "<th><input name=\"ship". $i ."\" id=\"ship". $i ."_input\" size=\"10\" value=\"0\" onfocus=\"javascript:if(this.value == '0') this.value='';\" onblur=\"javascript:if(this.value == '') this.value='0';\" alt=\"". $lang['tech'][$i] . $CurrentPlanet[$resource[$i]] ."\" onChange=\"shortInfo()\" onKeyUp=\"shortInfo()\" /></th>";
				}
				$page .= "</tr>";
			}
			$have_ships = true;
		}

		$btncontinue = "<tr height=\"20\"><th colspan=\"4\"><input type=\"submit\" value=\"".$lang['fl_continue']."\" /></th>";

		$page .= "<tr height=\"20\">";

		if (!$have_ships)
		{
			$page .= "<th colspan=\"4\">".$lang['fl_no_ships']."</th>";
			$page .= "</tr>";
			$page .= $btncontinue;
		}
		else
		{
			$page .= "<th colspan=\"2\"><a href=\"javascript:noShips();shortInfo();noResources();\" >".$lang['fl_remove_all_ships']."</a></th>";
			$page .= "<th colspan=\"2\"><a href=\"javascript:maxShips();shortInfo();\" >".$lang['fl_select_all_ships']."</a></th>";
			$page .= "</tr>";

			if ($MaxFlottes > $MaxFlyingFleets - $MaxFlyingRaks)
				$page .= $btncontinue;
		}
		$parse['body'] 					= $page;
		$parse['shipdata'] 				= $ShipData;
		$parse['galaxy']				= $galaxy;
		$parse['system']				= $system;
		$parse['planet']				= $planet;
		$parse['planettype']			= $planettype;
		$parse['target_mission']		= $target_mission;
		$parse['envoimaxexpedition']	= $EnvoiMaxExpedition;
		$parse['expeditionencours']		= $ExpeditionEnCours;
		$parse['target_mission']		= $target_mission;

		display(parsetemplate(gettemplate('fleet/fleet_table'), $parse));
	}

	public static function ShowFleet1Page($CurrentUser, $CurrentPlanet)
	{
		global $resource, $pricelist, $reslist, $phpEx, $db, $lang;

		$parse 							= $lang;

		$TargetGalaxy 					= request_var('galaxy', $CurrentPlanet['galaxy']);
		$TargetSystem 					= request_var('system', $CurrentPlanet['system']);
		$TargetPlanet					= request_var('planet', $CurrentPlanet['planet']);
		$TargetPlanettype 				= request_var('planet_type', $CurrentPlanet['planet_type']);
		$parse['target_mission'] 		= request_var('target_mission', 0);

		foreach ($reslist['fleet'] as $id => $ShipID)
		{
			$amount		 				= request_var('ship'.$ShipID, 0);
			
			if ($amount > $CurrentPlanet[$resource[$ShipID]] || $amount <= 0) continue;

			$Fleet[$ShipID]				= $amount;
			$FleetRoom			   	   += $pricelist[$ShipID]['capacity'] * $amount;
		}

		if (!is_array($Fleet))
			header("location:game." . $phpEx . "?page=fleet");

		$AvailableSpeeds				= parent::GetAvailableSpeeds();
		$FleetArray 					= parent::SetFleetArray($Fleet);
		$parse['speedfactor']			= parent::GetGameSpeedFactor();
		$parse['speedallsmin'] 			= parent::GetFleetMaxSpeed($Fleet, $CurrentUser);
		$parse['shortcut'] 				= parent::GetUserShotcut($CurrentUser['fleet_shortcut']);
		$parse['colonylist'] 			= parent::GetColonyList($CurrentUser);
		$parse['asc'] 					= parent::IsAKS($CurrentUser['id']);
		$parse['inputs']				= parent::GetExtraInputs($Fleet, $CurrentUser);
		$parse['galaxy'] 				= $CurrentPlanet['galaxy'];
		$parse['system'] 				= $CurrentPlanet['system'];
		$parse['planet'] 				= $CurrentPlanet['planet'];
		$parse['planet_type'] 			= $CurrentPlanet['planet_type'];
		$parse['galaxy_post'] 			= $TargetGalaxy;
		$parse['system_post'] 			= $TargetSystem;
		$parse['planet_post'] 			= $TargetPlanet;
		$parse['fleetroom']				= $FleetRoom;
		$parse['fleetarray']			= $FleetArray;
			
		$parse['options_planettype']    = "<option value=\"1\" ".(($TargetPlanettype == 1) ? "SELECTED" : "") .">".$lang['fl_planet']."</option>";
		$parse['options_planettype']   .= "<option value=\"2\" ".(($TargetPlanettype == 2) ? "SELECTED" : "") .">".$lang['fl_debris']."</option>";
		$parse['options_planettype']   .= "<option value=\"3\" ".(($TargetPlanettype == 3) ? "SELECTED" : "") .">".$lang['fl_moon']."</option>";
		$parse['options']				= "";
		
		foreach ($AvailableSpeeds as $a => $b)
		{
			$parse['options'] 		   .= "<option value=\"".$a."\">".$b."</option>";
		}
		
		display(parsetemplate(gettemplate('fleet/fleet1_table'), $parse));
	}
	
	public static function ShowFleet2Page($CurrentUser, $CurrentPlanet)
	{
		global $db, $lang;

		$parse						= $lang;
		$TargetGalaxy  				= request_var('galaxy', 0);
		$TargetSystem   			= request_var('system', 0);
		$TargetPlanet   			= request_var('planet', 0);
		$TargetPlanettype 			= request_var('planettype', 0);
		$TargetMission 				= request_var('target_mission', 0);
		$GenFleetSpeed  			= request_var('speed', 0);

		$parse['usedfleet'] 		= request_var('usedfleet','', true);
		$parse['acs_target_mr'] 	= request_var('acs_target_mr', '');
		$parse['fleet_group'] 		= request_var('fleet_group', 0);
	
		$parse['thisgalaxy'] 		= $CurrentPlanet['galaxy'];
		$parse['thissystem'] 		= $CurrentPlanet['system'];
		$parse['thisplanet'] 		= $CurrentPlanet['planet'];
		$parse['thisplanet_type'] 	= $CurrentPlanet['planet_type'];
		
		$parse['galaxy']	 	= $MisInfo['galaxy']     	= $TargetGalaxy;		
		$parse['system'] 		= $MisInfo['system'] 	  	= $TargetSystem;	
		$parse['planet'] 		= $MisInfo['planet'] 	  	= $TargetPlanet;		
		$parse['planettype']	= $MisInfo['planettype'] 	= $TargetPlanettype;	
			
		$MisInfo['IsAKS']			= $parse['acs_target_mr'];

		$FleetArray    				= parent::GetFleetArray($parse['usedfleet']);
		
		$MisInfo['Ship'] 			= $FleetArray;		
		$MisInfo['CurrentUser']		= $CurrentUser;
		$GameSpeedFactor   		 	= parent::GetGameSpeedFactor();		
		$MissionOutput	 			= parent::GetFleetMissions($MisInfo, $TargetMission);
		$FleetSpeed  				= parent::GetFleetMaxSpeed($FleetArray, $CurrentUser);
		$MaxFleetSpeed				= ($FleetSpeed / 10) * $GenFleetSpeed;
		$distance      				= parent::GetTargetDistance($CurrentPlanet['galaxy'], $TargetGalaxy, $CurrentPlanet['system'], $TargetSystem, $CurrentPlanet['planet'], $TargetPlanet);
		$duration      				= parent::GetMissionDuration($GenFleetSpeed, $MaxFleetSpeed, $distance, $GameSpeedFactor);
		$parse['consumption']		= floor(parent::GetFleetConsumption($FleetArray, $duration, $distance, $MaxFleetSpeed, $CurrentUser, $GameSpeedFactor));
		$parse['fleetroom']			= parent::GetFleetRoom($FleetArray);
		$parse['speedallsmin']		= $MaxFleetSpeed;
		$parse['speed']				= $GenFleetSpeed;
		$parse['speedfactor']		= $GameSpeedFactor;
		$parse['metal'] 			= floor($CurrentPlanet['metal']);
		$parse['crystal'] 			= floor($CurrentPlanet['crystal']);
		$parse['deuterium'] 		= floor($CurrentPlanet['deuterium']);
		$parse['title']				= $TargetGalaxy .":". $TargetSystem .":". $TargetPlanet." - ".(($TargetPlanettype == 1) ? $lang['fl_planet'] : $lang['fl_moon']);
		$parse['metal'] 			= floor($CurrentPlanet["metal"]);
		$parse['crystal'] 			= floor($CurrentPlanet["crystal"]);
		$parse['deuterium'] 		= floor($CurrentPlanet["deuterium"]);
		$parse['missionselector'] 	= $MissionOutput['MissionSelector'];
		$parse['stayblock'] 		= $MissionOutput['StayBlock'];

		display(parsetemplate(gettemplate('fleet/fleet2_table'), $parse));
	}

	public static function ShowFleet3Page($CurrentUser, $CurrentPlanet)
	{
		global $resource, $pricelist, $reslist, $phpEx, $xgp_root, $game_config, $db, $lang;
		include_once($xgp_root . 'includes/functions/IsVacationMode.' . $phpEx);

		$parse 					= $lang;
		$mission 				= request_var('mission', 0);
		$galaxy     			= request_var('galaxy', 0);
		$system     			= request_var('system', 0);
		$planet     			= request_var('planet', 0);
		$planettype 			= request_var('planettype', 0);
		$fleet_group		 	= request_var('fleet_group', 0);
		$GenFleetSpeed		 	= request_var('speed', 0);
		$TransportMetal			= request_var('resource1','0');
		$TransportCrystal		= request_var('resource2','0');
		$TransportDeuterium		= request_var('resource3','0');
		$expeditiontime 		= request_var('expeditiontime', 0);
		$holdingtime 			= request_var('holdingtime', 0);
		$acs_target_mr			= request_var('acs_target_mr', '');
		$rawfleetarray			= request_var('usedfleet','',true);

		$thisgalaxy			 	= $CurrentPlanet['galaxy'];
		$thissystem 			= $CurrentPlanet['system'];
		$thisplanet 			= $CurrentPlanet['planet'];
		$thisplanettype 		= $CurrentPlanet['planet_type'];
		
		if (IsVacationMode($CurrentUser))
			message($lang['fl_vacation_mode_active'],"game.php?page=overview",2);
	
		if (!($planettype >= 1 || $planettype <= 3))
			parent::GotoFleetPage();
			
		if ($CurrentPlanet['galaxy'] == $galaxy && $CurrentPlanet['system'] == $system && $CurrentPlanet['planet'] == $planet && $CurrentPlanet['planet_type'] == $planettype)
			parent::GotoFleetPage();

		if ($galaxy > MAX_GALAXY_IN_WORLD || $galaxy < 1)
			parent::GotoFleetPage();

		if ($system > MAX_SYSTEM_IN_GALAXY || $system < 1)
			parent::GotoFleetPage();

		if ($planet > (MAX_PLANET_IN_SYSTEM + 1) || $planet < 1)
			parent::GotoFleetPage();
			
		if (empty($mission))
			parent::GotoFleetPage();	
		
		if (!is_numeric($TransportMetal + 0) || !is_numeric($TransportCrystal + 0) || !is_numeric($TransportDeuterium + 0))
			parent::GotoFleetPage();

		if ($TransportMetal + $TransportCrystal + $TransportDeuterium < 1 && $mission == 3)
			message("<font color=\"lime\"><b>".$lang['fl_empty_transport']."</b></font>", "game." . $phpEx . "?page=fleet", 1);
			
		$ActualFleets		= parent::GetCurrentFleets($CurrentUser['id']);
		$MaxFlyingRaks 		= parent::GetCurrentFleets($CurrentUser['id'], 10);	

		if (parent::GetMaxFleetSlots($CurrentUser) <= $ActualFleets - $MaxFlyingRaks)
			message($lang['fl_no_slots'], "game." . $phpEx . "?page=fleet", 1);
		$fleet_group_mr = 0;
		if($fleet_group > 0 && $mission == 2)
		{
			$target = "g".$galaxy."s".$system."p".$planet."t".$planettype;
			if($acs_target_mr == $target)
			{
				$aks_count_mr = $db->query("SELECT * FROM ".AKS." WHERE id = '".$fleet_group."';");
				if ($db->num_rows($aks_count_mr) > 0)
					$fleet_group_mr = $fleet_group;
			}
		}

		if (($fleet_group == 0) && ($mission == 2))
			$mission = 1;

					
		$ActualFleets 		= parent::GetCurrentFleets($CurrentUser['id']);
		
		$TargetPlanet  		= $db->fetch_array($db->query("SELECT `id_owner`,`id_level`,`destruyed`,`ally_deposit` FROM ".PLANETS." WHERE `galaxy` = '". $db->sql_escape($galaxy) ."' AND `system` = '". $db->sql_escape($system) ."' AND `planet` = '". $db->sql_escape($planet) ."' AND `planet_type` = '". $db->sql_escape($planettype) ."';"));

		if (($mission != 15 && $mission != 8 && $TargetPlanet["destruyed"] != 0) || ($mission != 15 && $mission != 7 && $mission != 8 && empty($TargetPlanet['id_owner'])))
			parent::GotoFleetPage();

		$MyDBRec       		= $CurrentUser;

		$protection      	= $game_config['noobprotection'];
		$protectiontime  	= $game_config['noobprotectiontime'];
		$protectionmulti 	= $game_config['noobprotectionmulti'];

		$protectiontime		= ($protectiontime < 1) ? 9999999999999999 : 0;

		$FleetArray  		= parent::GetFleetArray($rawfleetarray);
		
		if (!is_array($FleetArray))
			parent::GotoFleetPage();

		$FleetStorage        = 0;
		$FleetShipCount      = 0;
		$fleet_array         = "";
		$FleetSubQRY         = "";
		
		foreach ($FleetArray as $Ship => $Count)
		{
			if ($Count > $CurrentPlanet[$resource[$Ship]] || $Count < 0)
				parent::GotoFleetPage();
				
			$FleetStorage    += $pricelist[$Ship]["capacity"] * $Count;
			$FleetShipCount  += $Count;
			$fleet_array     .= $Ship .",". $Count .";";
			$FleetSubQRY     .= "`".$resource[$Ship] . "` = `" . $resource[$Ship] . "` - " . $Count . ", ";	
		}

		$error              = 0;
		$fleetmission       = $mission;

		$YourPlanet = false;
		$UsedPlanet = false;
	
		if ($mission == 11)
		{
			$maxexpde = parent::GetCurrentFleets($CurrentUser['id'], 11);

			if ($maxexpde != 0)
				message("<font color=\"red\"><b>".$lang['fl_expedition_fleets_limit']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
		}
		elseif ($mission == 15)
		{
			$MaxExpedition = $CurrentUser[$resource[124]];

			if ($MaxExpedition == 0)
				message("<font color=\"red\"><b>".$lang['fl_expedition_tech_required']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
							
			$ExpeditionEnCours	= parent::GetCurrentFleets($CurrentUser['id'], 15);
			$EnvoiMaxExpedition = floor(sqrt($MaxExpedition));
			
			if ($ExpeditionEnCours >= $EnvoiMaxExpedition )
				message("<font color=\"red\"><b>".$lang['fl_expedition_fleets_limit']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
		}

		$YourPlanet 	= (isset($TargetPlanet['id_owner']) && $TargetPlanet['id_owner'] == $CurrentUser['id']) ? true : false;
		$UsedPlanet 	= (isset($TargetPlanet['id_owner'])) ? true : false;

		$HeDBRec 		= ($YourPlanet) ? $MyDBRec : GetUserByID($TargetPlanet['id_owner'], array('id','onlinetime','ally_id','urlaubs_modus'));

		if ($HeDBRec['urlaubs_modus'] && $mission != 8)
			message("<font color=\"lime\"><b>".$lang['fl_in_vacation_player']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
		
		if(!$YourPlanet && ($mission == 1 || $mission == 5 || $mission == 6 || $mission == 9))
		{
			if($TargetPlanet['id_level'] > $CurrentUser['authlevel'] && $game_config['adm_attack'] == 0)
				message("<font color=\"red\"><b>".$lang['fl_admins_cannot_be_attacked']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
		
			$UserPoints   	= $db->fetch_array($db->query("SELECT `total_points` FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $MyDBRec['id'] ."';"));
			$User2Points  	= $db->fetch_array($db->query("SELECT `total_points` FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $HeDBRec['id'] ."';"));
		
			$IsNoobProtec	= CheckNoobProtec($UserPoints, $User2Points, $HeDBRec['onlinetime']);
			
			if ($IsNoobProtec['NoobPlayer'])
				message("<font color=\"lime\"><b>".$lang['fl_week_player']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
			elseif ($IsNoobProtec['StrongPlayer'])
				message("<font color=\"red\"><b>".$lang['fl_strong_player']."</b></font>", "game." . $phpEx . "?page=fleet", 2);
		}

		if (!($mission == 15 || $mission == 8))
		{
			if ($HeDBRec['ally_id'] != $MyDBRec['ally_id'] && $mission == 4)
				message ("<font color=\"red\"><b>".$lang['fl_stay_not_on_enemy']."</b></font>", "game." . $phpEx . "?page=fleet", 2);

			if ($TargetPlanet['ally_deposit'] < 1 && $HeDBRec != $MyDBRec && $mission == 5)
				message ("<font color=\"red\"><b>".$lang['fl_not_ally_deposit']."</b></font>", "game." . $phpEx . "?page=fleet", 2);

			if (($TargetPlanet["id_owner"] == $CurrentPlanet["id_owner"]) && (($mission == 1) || ($mission == 6)))
				parent::GotoFleetPage();

			if (($TargetPlanet["id_owner"] != $CurrentPlanet["id_owner"]) && ($mission == 4))
				message ("<font color=\"red\"><b>".$lang['fl_deploy_only_your_planets']."</b></font>","game." . $phpEx . "?page=fleet", 2);
		}

		if(parent::CheckUserSpeed())
			parent::GotoFleetPage();
	

		$FleetSpeed  	= parent::GetFleetMaxSpeed($FleetArray, $CurrentUser);
		$MaxFleetSpeed	= ($FleetSpeed / 10) * $GenFleetSpeed;
		$SpeedFactor    = parent::GetGameSpeedFactor();
		$distance      	= parent::GetTargetDistance($thisgalaxy, $galaxy, $thissystem, $system, $thisplanet, $planet);
		$duration      	= parent::GetMissionDuration($GenFleetSpeed, $MaxFleetSpeed, $distance, $SpeedFactor);
		$consumption   	= parent::GetFleetConsumption($FleetArray, $duration, $distance, $MaxFleetSpeed, $CurrentUser, $SpeedFactor);
			
		$fleet['start_time'] = $duration + time();
		
		if ($mission == 15)
		{
			$StayDuration    = $expeditiontime * 3600;
			$StayTime        = $fleet['start_time'] + $StayDuration;
		}
		elseif ($mission == 5)
		{
			$StayDuration    = $holdingtime * 3600;
			$StayTime        = $fleet['start_time'] + $StayDuration;
		}
		elseif ($mission == 11)
		{
			$StayDuration    = 3600;
			$StayTime        = $fleet['start_time'] + 3600;
		}
		else
		{
			$StayDuration    = 0;
			$StayTime        = 0;
		}

		$fleet['end_time']   = $StayDuration + (2 * $duration) + time();


		$FleetStorage       -= $consumption;

		$StorageNeeded   	 = $TransportMetal + $TransportCrystal + $TransportDeuterium;


		$StockMetal      	 = $CurrentPlanet['metal'];
		$StockCrystal    	 = $CurrentPlanet['crystal'];
		$StockDeuterium  	 = $CurrentPlanet['deuterium'];
		$StockDeuterium 	-= $consumption;
					
		if ($StockMetal < $TransportMetal || $StockCrystal < $TransportCrystal || $StockDeuterium < $TransportDeuterium)
			message ("<font color=\"red\"><b>". $lang['fl_no_enought_deuterium'] . pretty_number($consumption) ."</b></font>", "game." . $phpEx . "?page=fleet", 2);

		if ($StorageNeeded > $FleetStorage)
			message ("<font color=\"red\"><b>". $lang['fl_no_enought_cargo_capacity'] . pretty_number($StorageNeeded - $FleetStorage)."</b></font>", "game." . $phpEx . "?page=fleet", 2);

		if ($TargetPlanet['id_level'] > $CurrentUser['authlevel'] && $game_config['adm_attack'] == 0)
			message($lang['fl_admins_cannot_be_attacked'], "game." . $phpEx . "?page=fleet",2);

		if ($fleet_group_mr != 0)
		{
			$AksStartTime = $db->fetch_array($db->query("SELECT MAX(`fleet_start_time`) AS Start, MAX(`fleet_end_time`) AS End FROM ".FLEETS." WHERE `fleet_group` = '". $fleet_group_mr . "';"));

			if ($AksStartTime['Start'] > $fleet['start_time'])
			{
				$fleet['start_time'] 	= $AksStartTime['Start'] + 1;
				$fleet['end_time'] 		= $AksStartTime['End'] + 1;
			}
			else
			{
				$AksTime = $db->fetch_array($db->query("SELECT fleet_start_time, fleet_end_time FROM ".FLEETS." WHERE `fleet_group` = '". $fleet_group_mr . "' AND `fleet_mission` = '1';"));

				if ($AksTime['fleet_start_time'] < $fleet['start_time'])
				{
					$QryUpdateFleets = "UPDATE ".FLEETS." SET ";
					$QryUpdateFleets .= "`fleet_start_time` = '". $fleet['start_time'] ."', ";
					$QryUpdateFleets .= "`fleet_end_time` = '". $fleet['end_time'] ."' ";
					$QryUpdateFleets .= "WHERE ";
					$QryUpdateFleets .= "`fleet_group` = '". $fleet_group_mr ."' AND ";
					$QryUpdateFleets .= "`fleet_mission` = '1';";
					$db->query($QryUpdateFleets);
					$SelectFleets = $db->query("SELECT * FROM ".FLEETS." WHERE `fleet_group` = '". $fleet_group_mr . "' AND `fleet_mission` = '2' ORDER BY `fleet_id` ASC ;");
					$nb = $db->num_rows($SelectFleets);
					$i = 0;
					if ($nb > 0)
					{
						while ($row = $db->fetch_array($SelectFleets))
						{
							$i++;
							$row['fleet_start_time'] = $fleet['start_time'] + $i;
							$row['fleet_end_time'] = $fleet['end_time'] + $i;
							$QryUpdateFleets = "UPDATE ".FLEETS." SET ";
							$QryUpdateFleets .= "`fleet_start_time` = '". $row['fleet_start_time'] ."', ";
							$QryUpdateFleets .= "`fleet_end_time` = '". $row['fleet_end_time'] ."' ";
							$QryUpdateFleets .= "WHERE ";
							$QryUpdateFleets .= "`fleet_id` = '". $row['fleet_id'] ."';";
							$db->query($QryUpdateFleets);
						}
					}

					$fleet['start_time'] = $fleet['start_time'];
					$fleet['end_time'] = $fleet['end_time'];
				}
			}
		}
		$QryInsertFleet  = "INSERT INTO ".FLEETS." SET 
							`fleet_owner` = '". $CurrentUser['id'] ."', 
							`fleet_mission` = '". $mission ."',
							`fleet_amount` = '". $FleetShipCount ."',
						    `fleet_array` = '". $fleet_array ."',
							`fleet_start_time` = '". $fleet['start_time'] ."',
							`fleet_start_galaxy` = '". $thisgalaxy ."',
							`fleet_start_system` = '". $thissystem ."',
							`fleet_start_planet` = '". $thisplanet ."',
							`fleet_start_type` = '". $thisplanettype ."',
							`fleet_end_time` = '". $fleet['end_time'] ."',
							`fleet_end_stay` = '". $StayTime ."',
							`fleet_end_galaxy` = '". $galaxy ."',
							`fleet_end_system` = '". $system ."',
							`fleet_end_planet` = '". $planet ."',
							`fleet_end_type` = '". $planettype ."',
							`fleet_resource_metal` = '". $TransportMetal ."',
							`fleet_resource_crystal` = '". $TransportCrystal ."',
							`fleet_resource_deuterium` = '". $TransportDeuterium ."',
							`fleet_target_owner` = '". $TargetPlanet['id_owner'] ."',
							`fleet_group` = '". $fleet_group_mr ."',
							`start_time` = '". time() ."';
							UPDATE `".PLANETS."` SET
							".$FleetSubQRY."
							`metal` = `metal` - '". $TransportMetal ."',
							`crystal` = `crystal` - '". $TransportCrystal ."',
							`deuterium` = `deuterium` - '". ($TransportDeuterium + $consumption) ."'
							WHERE
							`id` = ". $CurrentPlanet['id'] ." LIMIT 1;";
		
		$db->multi_query($QryInsertFleet);

		$parse['mission'] 		= $lang['type_mission'][$mission];
		$parse['distance'] 		= pretty_number($distance);
		$parse['consumption'] 	= pretty_number($consumption);
		$parse['from']	 		= $thisgalaxy .":". $thissystem. ":". $thisplanet;
		$parse['destination']	= $galaxy .":". $system .":". $planet;
		$parse['start_time'] 	= date("M D d H:i:s", $fleet['start_time']);
		$parse['end_time'] 		= date("M D d H:i:s", $fleet['end_time']);
		$parse['speedallsmin'] 	= $MaxFleetSpeed;
		
		foreach ($FleetArray as $Ship => $Count)
		{
			$fleet_list .= "</tr><tr height=\"20\">";
			$fleet_list .= "<th>". $lang['tech'][$Ship] ."</th>";
			$fleet_list .= "<th>". pretty_number($Count) ."</th>";
		}

		$parse['fleet_list'] 	= $fleet_list;

		display(parsetemplate(gettemplate('fleet/fleet3_table'), $parse), false, "<meta http-equiv=\"refresh\" content=\"3;URL=game.php?page=fleet\">");
	}

	public static function FleetAjax($CurrentUser, $CurrentPlanet)
	{
		global $db, $resource, $lang;
		$UserSpyProbes  = $CurrentPlanet['spy_sonde'];
		$UserRecycles   = $CurrentPlanet['recycler'];
		$UserDeuterium  = $CurrentPlanet['deuterium'];
		$UserMissiles   = $CurrentPlanet['interplanetary_misil'];
		$thisgalaxy		= $CurrentPlanet['galaxy'];
		$thissystem		= $CurrentPlanet['system'];
		$thisplanet		= $CurrentPlanet['planet'];
		$thisplanettype = $CurrentPlanet['planet_type'];
		
		$galaxy 		= request_var('galaxy',0);
		$system 		= request_var('system',0);
		$planet 		= request_var('planet',0);
		$planettype		= request_var('planettype',0);
		$mission		= request_var('mission',0);
		$fleet          = array();
		$speedalls      = array();
		$PartialFleet   = false;
		$PartialCount   = 0;
		
		switch($mission)
		{
			case 6:
				$SpyProbes	= request_var('ship210', 0);
				if($SpyProbes > $CurrentPlanet[$resource[210]])
					exit($ResultMessage = "611; ".$lang['fa_no_ships']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);
					
				$FleetArray = array(210 => $SpyProbes);
			break;
			case 8:
				$Recycles	= request_var('ship209', 0);
				if($Recycles > $CurrentPlanet[$resource[209]])
					exit($ResultMessage = "611; ".$lang['fa_no_ships']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);
					
				$FleetArray = array(209 => $Recycles);
				break;
			default:
				exit("610; ".$lang['fa_not_enough_probes']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);
			break;
		}
		
		$CurrentFlyingFleets = parent::GetCurrentFleets($CurrentUser['id']);	

		if (parent::GetMaxFleetSlots($CurrentUser) <= $CurrentFlyingFleets)
		{
			$ResultMessage = "612; ".$lang['fa_no_more_slots']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die ($ResultMessage);
		}
		
		if ($galaxy > MAX_GALAXY_IN_WORLD || $galaxy < 1 || $system > MAX_SYSTEM_IN_GALAXY || $system < 1)
		{
			$ResultMessage = "602; ".$lang['fa_galaxy_not_exist']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die($ResultMessage);
		}

		if ($planet > MAX_PLANET_IN_SYSTEM || $planet < 1)
		{
			$ResultMessage = "602; ".$lang['fa_planet_not_exist']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die($ResultMessage);
		}

		$QrySelectEnemy  = "SELECT id_level, id_owner FROM ".PLANETS." ";
		$QrySelectEnemy .= "WHERE ";
		$QrySelectEnemy .= "`galaxy` = '". $galaxy ."' AND ";
		$QrySelectEnemy .= "`system` = '". $system ."' AND ";
		$QrySelectEnemy .= "`planet` = '". $planet ."' AND ";
		$QrySelectEnemy .= "`planet_type` = '". $planettype ."';";
		$TargetRow	   = $db->fetch_array($db->query($QrySelectEnemy));
		
		if($TargetRow['id_level'] > $CurrentUser['authlevel'] && $mission == 6 && $game_config['adm_attack'] == 0)
			exit("619; ".$lang['fa_action_not_allowed']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);
		
		$TargetUser	   = GetUserByID($TargetRow['id_owner'], array('id','onlinetime','urlaubs_modus'));



		if($CurrentUser['urlaubs_modus'])
		{
			$ResultMessage = "620; ".$lang['fa_vacation_mode_current']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die ($ResultMessage);
		}

		if($mission == 6)
		{
			$TargetVacat   = $TargetUser['urlaubs_modus'];
			
			if ($TargetVacat)
			{
				$ResultMessage = "605; ".$lang['fa_vacation_mode']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
				die ($ResultMessage);
			}

			$UserPoints   	= $db->fetch_array($db->query("SELECT `total_points` FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $CurrentUser['id'] ."';"));
			$User2Points  	= $db->fetch_array($db->query("SELECT `total_points` FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TargetRow['id_owner'] ."';"));
		
			$IsNoobProtec	= CheckNoobProtec($UserPoints, $User2Points, $TargetUser['onlinetime']);
			
			if ($IsNoobProtec['NoobPlayer'])
				exit("603; ".$lang['fa_week_player']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);
			elseif ($IsNoobProtec['StrongPlayer'])
				exit("604; ".$lang['fa_strong_player']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);

			if ($TargetRow['id_owner'] == '')
			{
				$ResultMessage = "601; ".$lang['fa_planet_not_exist']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
				die ($ResultMessage);
			}

			if ($TargetRow["id_owner"] == $CurrentPlanet["id_owner"])
			{
				$ResultMessage = "618; ".$lang['fa_not_spy_yourself']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
				die($ResultMessage);
			}
		}
		
		$SpeedFactor    	 = parent::GetGameSpeedFactor();
		$Distance    		 = parent::GetTargetDistance($thisgalaxy, $galaxy, $thissystem, $system, $thisplanet, $planet);
		$SpeedAllMin 		 = parent::GetFleetMaxSpeed($FleetArray, $CurrentUser);
		$Duration    		 = parent::GetMissionDuration(10, $SpeedAllMin, $Distance, $SpeedFactor);
		$consumption   		 = parent::GetFleetConsumption($FleetArray, $Duration, $Distance, $SpeedAllMin, $CurrentUser, $SpeedFactor);

		$UserDeuterium   	-= $consumption;

		if($UserDeuterium < 0)
			exit("613; ".$lang['fa_not_enough_fuel']." |".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles);

		$fleet['fly_time']   = $Duration;
		$fleet['start_time'] = $Duration + time();
		$fleet['end_time']   = ($Duration * 2) + time();

		$FleetShipCount      = 0;
		$FleetDBArray        = "";
		$FleetSubQRY         = "";

		foreach ($FleetArray as $Ship => $Count)
		{
			$FleetShipCount  += $Count;
			$FleetDBArray    .= $Ship .",". $Count .";";
			$FleetSubQRY     .= "`".$resource[$Ship] . "` = `" . $resource[$Ship] . "` - " . $Count . " , ";
		}


		$QryUpdate  = "INSERT INTO ".FLEETS." SET ";
		$QryUpdate .= "`fleet_owner` = '". $CurrentUser['id'] ."', ";
		$QryUpdate .= "`fleet_mission` = '". $mission ."', ";
		$QryUpdate .= "`fleet_amount` = '". $FleetShipCount ."', ";
		$QryUpdate .= "`fleet_array` = '". $FleetDBArray ."', ";
		$QryUpdate .= "`fleet_start_time` = '". $fleet['start_time']. "', ";
		$QryUpdate .= "`fleet_start_galaxy` = '". $thisgalaxy ."', ";
		$QryUpdate .= "`fleet_start_system` = '". $thissystem ."', ";
		$QryUpdate .= "`fleet_start_planet` = '". $thisplanet ."', ";
		$QryUpdate .= "`fleet_start_type` = '". $thisplanettype ."', ";
		$QryUpdate .= "`fleet_end_time` = '". $fleet['end_time'] ."', ";
		$QryUpdate .= "`fleet_end_galaxy` = '". $galaxy ."', ";
		$QryUpdate .= "`fleet_end_system` = '". $system ."', ";
		$QryUpdate .= "`fleet_end_planet` = '". $planet ."', ";
		$QryUpdate .= "`fleet_end_type` = '". $planettype ."', ";
		$QryUpdate .= "`fleet_target_owner` = '". $TargetRow['id_owner'] ."', ";
		$QryUpdate .= "`start_time` = '" . time() . "';";
		$QryUpdate .= "UPDATE ".PLANETS." SET ";
		$QryUpdate .= $FleetSubQRY;
		$QryUpdate .= "`deuterium` = '".$UserDeuterium."' " ;
		$QryUpdate .= "WHERE ";
		$QryUpdate .= "`id` = '". $CurrentPlanet['id'] ."';";
		$db->multi_query($QryUpdate);

		$CurrentFlyingFleets++;

		$ResultMessage  = "600; ".$lang['fa_sending']." ". $FleetShipCount  ." ". $lang['tech'][$Ship] ." a ". $galaxy .":". $system .":". $planet ."...|";
		$ResultMessage .= $CurrentFlyingFleets ." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;

		die($ResultMessage);
	}

	public static function MissilesAjax($CurrentUser, $CurrentPlanet)
	{	
		global $lang, $game_config, $db, $phpEx;
	
		include_once($xgp_root . 'includes/functions/IsVacationMode.' . $phpEx);
		
		$TargetGalaxy 		= request_var('galaxy',0);
		$TargetSystem 		= request_var('system',0);
		$TargetPlanet 		= request_var('planet',0);
		$anz 				= request_var('SendMI',0);
		$pziel 				= request_var('Target',"");

		$iraks 				= $CurrentPlanet['interplanetary_misil'];
		$Distance			= abs($TargetSystem - $currentplanet['system']);
		$tempvar2 			= ($CurrentUser['impulse_motor_tech'] * 2) - 1;
		$Target 			= $db->fetch_array($db->query("SELECT id_owner, id_level FROM ".PLANETS." WHERE galaxy = ".$TargetGalaxy." AND system = ".$TargetSystem." AND planet = ".$TargetPlanet." AND planet_type = 1 limit 1;"));

		if (IsVacationMode($CurrentUser))
			$error = $lang['fl_vacation_mode_active'];
		elseif ($CurrentPlanet['silo'] < 4)
			$error = $lang['ma_silo_level'];
		elseif ($CurrentUser['impulse_motor_tech'] == 0)
			$error = $lang['ma_impulse_drive_required'];
		elseif ($Distance >= $tempvar2 || $TargetGalaxy != $CurrentPlanet['galaxy'])
			$error = $lang['ma_not_send_other_galaxy'];
		elseif (!$Target)
			$error = $lang['ma_planet_doesnt_exists'];
		elseif ($anz > $iraks)
			$error = $lang['ma_cant_send'] . $anz . $lang['ma_missile'] . $iraks;
		elseif ((!is_numeric($pziel) && $pziel != "all") OR ($pziel < 0 && $pziel > 7 && $pziel != "all"))
			$error = $lang['ma_wrong_target'];
		elseif ($iraks == 0)
			$error = $lang['ma_no_missiles'];
		elseif ($anz == 0)
			$error = $lang['ma_add_missile_number'];
		elseif ($Target['id_level'] > $CurrentUser['authlevel'] && $game_config['adm_attack'] == 0)
			$error = $lang['fl_admins_cannot_be_attacked'];
		
		$TargetUser	   	= GetUserByID($Target['id_owner'], array('onlinetime'));
		
		$UserPoints   	= $db->fetch_array($db->query("SELECT `total_points` FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $CurrentUser['id'] ."';"));
		$User2Points  	= $db->fetch_array($db->query("SELECT `total_points` FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $Target['id_owner'] ."';"));
		
		$IsNoobProtec	= CheckNoobProtec($UserPoints, $User2Points, $TargetUser['onlinetime']);
			
		if ($IsNoobProtec['NoobPlayer'])
			$error = $lang['fl_week_player'];
		elseif ($IsNoobProtec['StrongPlayer'])
			$error = $lang['fl_strong_player'];		
		
		if ($error != "")
			exit(message($error));
		
		$SpeedFactor    	 = parent::GetGameSpeedFactor();
		$Duration 			 = max(round((30 + (60 * $Distance)/$SpeedFactor)),30);

		$DefenseLabel =
		array(
		'0' => $lang['ma_misil_launcher'],
		'1' => $lang['ma_small_laser'],
		'2' => $lang['ma_big_laser'],
		'3' => $lang['ma_gauss_canyon'],
		'4' => $lang['ma_ionic_canyon'],
		'5' => $lang['ma_buster_canyon'],
		'6' => $lang['ma_small_protection_shield'],
		'7' => $lang['ma_big_protection_shield'],
		'all' => $lang['ma_all']);


		$sql = "INSERT INTO ".FLEETS." SET
				fleet_owner = ".$CurrentUser['id'].",
				fleet_mission = 10,
				fleet_amount = ".$anz.",
				fleet_array = '503,".$anz."',
				fleet_start_time = '".(time() + $Duration)."',
				fleet_start_galaxy = '".$CurrentPlanet['galaxy']."',
				fleet_start_system = '".$CurrentPlanet['system']."',
				fleet_start_planet ='".$CurrentPlanet['planet']."',
				fleet_start_type = 1,
				fleet_end_time = '".(time() + $Duration + 50)."',
				fleet_end_stay = 0,
				fleet_end_galaxy = '".$TargetGalaxy."',
				fleet_end_system = '".$TargetSystem."',
				fleet_end_planet = '".$TargetPlanet."',
				fleet_end_type = 1,
				fleet_target_obj = '".$db->sql_escape($pziel)."',
				fleet_resource_metal = 0,
				fleet_resource_crystal = 0,
				fleet_resource_deuterium = 0,
				fleet_target_owner = '".$Target["id_owner"]."',
				fleet_group = 0,
				fleet_mess = 0,
				start_time = ".time().";
				UPDATE ".PLANETS." SET 
				interplanetary_misil = (interplanetary_misil - ".$anz.") WHERE id = '".$CurrentPlanet['id']."';";

		$db->multi_query($sql);

		message("<b>".$anz."</b>". $lang['ma_missiles_sended'] .$DefenseLabel[$pziel], "game.php?page=overview", 3);

	}
}
?>