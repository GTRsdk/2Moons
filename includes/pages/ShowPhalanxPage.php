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


function ShowPhalanxPage()
{
	global $USER, $PLANET, $LNG, $db;

	include_once(ROOT_PATH.'includes/functions/InsertJavaScriptChronoApplet.' . PHP_EXT);
	include_once(ROOT_PATH.'includes/classes/class.FlyingFleetsTable.' . PHP_EXT);
	include_once(ROOT_PATH.'includes/classes/class.GalaxyRows.' . PHP_EXT);

	$FlyingFleetsTable 	= new FlyingFleetsTable();
	$GalaxyRows 		= new GalaxyRows();

	$template			= new template();
	$template->page_header();
	$template->page_footer();	
	
	$PhRange 		 	= $GalaxyRows->GetPhalanxRange($PLANET['phalanx']);
	$Galaxy 			= request_var('galaxy', 0);
	$System 			= request_var('system', 0);
	$Planet  			= request_var('planet', 0);
	
	$SystemLimitMin  	= max(1, $CurrentSystem - $PhRange);
	$SystemLimitMax  	= $CurrentSystem + $PhRange;
	if ($PLANET['deuterium'] < 5000)
	{
		$template->message($LNG['px_no_deuterium'], false, 0, true);
		exit;
	}
	
	if($System <= $SystemLimitMax && $System >= $SystemLimitMin && $Galaxy == $PLANET['galaxy'])
	{
		$PLANET['deuterium'] -= 5000;
		$db->query("UPDATE ".PLANETS." SET `deuterium` = `deuterium` - '5000' WHERE `id` = '".$PLANET['id']."';");
		$TargetInfo = $db->uniquequery("SELECT name, id_owner FROM ".PLANETS." WHERE `galaxy` = '". $Galaxy ."' AND `system` = '". $System ."' AND `planet` = '". $Planet ."' AND `planet_type` = '1';");

		$QryLookFleets  = "SELECT * ";
		$QryLookFleets .= "FROM ".FLEETS." ";
		$QryLookFleets .= "WHERE ( ";
		$QryLookFleets .= "`fleet_start_galaxy` = '". $Galaxy ."' AND ";
		$QryLookFleets .= "`fleet_start_system` = '". $System ."' AND ";
		$QryLookFleets .= "`fleet_start_planet` = '". $Planet ."' AND ";
		$QryLookFleets .= "`fleet_start_type` = '1' ";
		$QryLookFleets .= ") OR ( ";
		$QryLookFleets .= "`fleet_end_galaxy` = '". $Galaxy ."' AND ";
		$QryLookFleets .= "`fleet_end_system` = '". $System ."' AND ";
		$QryLookFleets .= "`fleet_end_planet` = '". $Planet ."' AND ";
		$QryLookFleets .= "`fleet_end_type` = '1' ";
		$QryLookFleets .= ") ";
		$QryLookFleets .= "ORDER BY `fleet_start_time`;";

		$FleetToTarget  = $db->query($QryLookFleets);
		
		while ($FleetRow = $db->fetch_array($FleetToTarget))
		{
			$Record++;
			
			$StartTime  = $FleetRow['fleet_start_time'];
			$StayTime   = $FleetRow['fleet_end_stay'];
			$EndTime    = $FleetRow['fleet_end_time'];
			$id			= $FleetRow['fleet_id'];
			
			if ($FleetRow['fleet_owner'] == $TargetInfo['id_owner'])
				$FleetType = true;
			else
				$FleetType = false;

			$FleetRow['fleet_resource_metal']     	= 0;
			$FleetRow['fleet_resource_crystal']   	= 0;
			$FleetRow['fleet_resource_deuterium'] 	= 0;
			$FleetRow['fleet_resource_darkmatter'] 	= 0;

			$Label = "fs";
			if ($StartTime > TIMESTAMP)
				$fpage[$StartTime.$id] = $FlyingFleetsTable->BuildFleetEventTable ( $FleetRow, 0, $FleetType, $Label, $Record );

			if ($FleetRow['fleet_mission'] <> 4)
			{
				$Label = "ft";
				if ($StayTime > TIMESTAMP)
					$fpage[$StayTime.$id] = $FlyingFleetsTable->BuildFleetEventTable ( $FleetRow, 1, $FleetType, $Label, $Record );

				if ($FleetType == true)
				{
					$Label = "fe";
					if ($EndTime > TIMESTAMP)
						$fpage[$EndTime.$id]  = $FlyingFleetsTable->BuildFleetEventTable ( $FleetRow, 2, $FleetType, $Label, $Record );
				}
			}
		}
	}
	
	if(isset($fpage))
		ksort($fpage);

	$template->assign_vars(array(
		'phl_pl_galaxy'  	=> $Galaxy,
		'phl_pl_system'  	=> $System,
		'phl_pl_place'   	=> $Planet,
		'phl_pl_name'    	=> $TargetInfo['name'],
		'fleets'		 	=> $fpage,
		'px_scan_position'	=> $LNG['px_scan_position'],
		'px_no_fleet'		=> $LNG['px_no_fleet'],
		'px_fleet_movement'	=> $LNG['px_fleet_movement'],
	));
	
	$template->show('phalax_body.tpl');			
}
?>