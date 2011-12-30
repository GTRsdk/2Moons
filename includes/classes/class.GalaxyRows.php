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

class GalaxyRows
{
	public function allowMissiles($GalaxyRowPlanet)
	{
		global $USER, $PLANET, $resource;
		if ($PLANET[$resource[503]] == 0 || $GalaxyRowPlanet['galaxy'] != $PLANET['galaxy'] || $PLANET['planet_type'] != 1 || !isModulAvalible(MODUL_MISSILEATTACK))
			return false;
		
		$Range = $this->GetMissileRange($USER[$resource[117]]);
		$SystemLimitMin = max($PLANET['system'] - $Range, 1);
		$SystemLimitMax = $PLANET['system'] + $Range;
		return $GalaxyRowPlanet['system'] <= $SystemLimitMax && $GalaxyRowPlanet['system'] >= $SystemLimitMin ? true : false;
	}
	public function allowPhalanx($GalaxyRowPlanet)
	{
		global $USER, $PLANET, $resource;
		if (!isModulAvalible(MODUL_PHALANX) || $PLANET[$resource[42]] == 0 || $PLANET[$resource[903]] == PHALANX_DEUTERIUM)
			return false;
		
		$PhRange 		 = $this->GetPhalanxRange($PLANET[$resource[42]]);
		$SystemLimitMin  = max(1, $PLANET['system'] - $PhRange);
		$SystemLimitMax  = $PLANET['system'] + $PhRange;
		return $GalaxyRowPlanet['system'] <= $SystemLimitMax && $GalaxyRowPlanet['system'] >= $SystemLimitMin;

	}
	
	public function GetMissileRange($Level)
	{
		return max(($Level * 5) - 1, 0);
	}

	public function GetPhalanxRange($PhalanxLevel)
	{
		return ($PhalanxLevel == 1) ? 1 : pow($PhalanxLevel, 2) - 1;
	}

	public function GalaxyRowActions($GalaxyRowPlanet)
	{
		global $USER, $PLANET, $resource, $LNG;

		$MissileBtn = $this->allowMissiles($GalaxyRowPlanet);

		$Result = array(
			'esp'		=> (isModulAvalible(MODUL_MISSION_SPY) && $USER["settings_esp"] == 1) ? true : false,
			'message'	=> (isModulAvalible(MODUL_MESSAGES) && $USER["settings_wri"] == 1) ? true : false,
			'buddy'		=> (isModulAvalible(MODUL_BUDDYLIST) && $USER["settings_bud"] == 1) ? true : false,
			'missle'	=> (isModulAvalible(MODUL_MISSILEATTACK) && $USER["settings_mis"] == 1 && $MissileBtn == true) ? true : false,
		);

		return $Result;
	}

	public function GalaxyRowAlly($GalaxyRowPlanet)
	{
		global $USER, $LNG, $db;

		$Result = array(
			'id'		=> $GalaxyRowPlanet['allyid'],
			'name'		=> htmlspecialchars($GalaxyRowPlanet['ally_name'],ENT_QUOTES,"UTF-8"),
			'member'	=> sprintf(($GalaxyRowPlanet['ally_members'] == 1)?$LNG['gl_member_add']:$LNG['gl_member'], $GalaxyRowPlanet['ally_members']),
			'web'		=> $GalaxyRowPlanet['ally_web'],
			'inally'	=> $USER['ally_id'] == $GalaxyRowPlanet['ally_id'],
			'tag'		=> $GalaxyRowPlanet['ally_tag'],
			'rank'		=> $GalaxyRowPlanet['ally_rank'],
		);
		
		return $Result;
	}

	public function GalaxyRowDebris($GalaxyRowPlanet)
	{
		global $USER, $PLANET, $LNG, $pricelist, $resource;

		$GRecNeeded = min(ceil(($GalaxyRowPlanet['der_metal'] + $GalaxyRowPlanet['der_crystal']) / $pricelist[219]['capacity']), $PLANET[$resource[219]]);
		$RecNeeded 	= min(ceil(max($GalaxyRowPlanet['der_metal'] + $GalaxyRowPlanet['der_crystal'] - ($GRecNeeded * $pricelist[219]['capacity']), 0) / $pricelist[209]['capacity']), $PLANET[$resource[209]]);

		$Result = array(
			'metal'			=> pretty_number($GalaxyRowPlanet["der_metal"]),
			'crystal'		=> pretty_number($GalaxyRowPlanet["der_crystal"]),
			'shipsNeed'		=> array(209 => $RecNeeded, 219 => $GRecNeeded),
			'recycle'		=> (isModulAvalible(MODUL_MISSION_RECYCLE)) ? $LNG['type_mission'][8]:false,
		);

		return $Result;
	}

	public function GalaxyRowMoon($GalaxyRowPlanet, $IsOwn)
	{
		global $USER, $PLANET, $LNG, $resource;
		
		$Result = array(
			'id'		=> $GalaxyRowPlanet['m_id'],
			'name'		=> htmlspecialchars($GalaxyRowPlanet['m_name'], ENT_QUOTES, "UTF-8"),
			'temp_min'	=> $GalaxyRowPlanet['m_temp_min'], 
			'diameter'	=> $GalaxyRowPlanet['m_diameter'],
			'attack'	=> (isModulAvalible(MODUL_MISSION_ATTACK) && !$IsOwn) ? $LNG['type_mission'][1]:false,
			'transport'	=> (isModulAvalible(MODUL_MISSION_TRANSPORT)) ? $LNG['type_mission'][3]:false,
			'stay'		=> (isModulAvalible(MODUL_MISSION_STATION) && $IsOwn) ? $LNG['type_mission'][4]:false,
			'stayally'	=> (isModulAvalible(MODUL_MISSION_HOLD) && !$IsOwn) ? $LNG['type_mission'][5]:false,
			'spionage'	=> (isModulAvalible(MODUL_MISSION_SPY) && !$IsOwn) ? $LNG['type_mission'][6]:false,
			'destroy'	=> (isModulAvalible(MODUL_MISSION_DESTROY) && !$IsOwn && $PLANET[$resource[214]] > 0) ? $LNG['type_mission'][9]:false,
		);

		return $Result;
	}

	public function GalaxyRowPlanet($GalaxyRowPlanet, $IsOwn)
	{
		global $resource, $USER, $PLANET, $CONF, $LNG;
		
		if(!$IsOwn && $GalaxyRowPlanet['galaxy'] == $PLANET['galaxy'])
		{	
			$PhalanxTypeLink 	= $this->allowPhalanx($GalaxyRowPlanet);
			$MissileBtn 		= $this->allowMissiles($GalaxyRowPlanet);
		} else {
			$PhalanxTypeLink	= false;
			$MissileBtn			= false;
		}
		$Result = array(
			'id'			=> $GalaxyRowPlanet['id'],
			'name'			=> htmlspecialchars($GalaxyRowPlanet['name'],ENT_QUOTES,"UTF-8"),
			'image'			=> $GalaxyRowPlanet['image'],
			'phalax'		=> !$PhalanxTypeLink ? false : $LNG['gl_phalanx'],
			'missile'		=> (isModulAvalible(MODUL_MISSILEATTACK) && $MissileBtn === true) ? $LNG['gl_missile_attack'] : false,
			'transport'		=> (isModulAvalible(MODUL_MISSION_TRANSPORT)) ? $LNG['type_mission'][3] : false,
			'spionage'		=> (!$IsOwn && isModulAvalible(MODUL_MISSION_SPY)) ? $LNG['type_mission'][6] : false,
			'attack'		=> (!$IsOwn && isModulAvalible(MODUL_MISSION_ATTACK)) ? $LNG['type_mission'][1] : false,
			'stay'			=> ($IsOwn && isModulAvalible(MODUL_MISSION_STATION)) ? $LNG['type_mission'][4] : false,
			'stayally'		=> (!$IsOwn && isModulAvalible(MODUL_MISSION_HOLD)) ? $LNG['type_mission'][5] : false,
		);
		return $Result;
	}

	public function GalaxyRowPlanetName($GalaxyRowPlanet)
	{
		global $USER, $LNG;

		$Onlinetime			= floor((TIMESTAMP - $GalaxyRowPlanet['last_update']) / 60);
		
		if ($Onlinetime < 4)
			$Activity	= $LNG['gl_activity'];
		elseif($Onlinetime < 15)
			$Activity	= sprintf($LNG['gl_activity_inactive'], $Onlinetime);
		else
			$Activity	= '';
			
		$Result = array(
			'name'			=> htmlspecialchars($GalaxyRowPlanet['name'], ENT_QUOTES, "UTF-8"),
			'activity'		=> $Activity,
		);
		return $Result;
	}

	public function GalaxyRowUser($GalaxyRowPlanet, $IsOwn)
	{
		global $USER, $LNG, $db;

		$CurrentPoints 		= $USER['total_points'];
		$RowUserPoints 		= $GalaxyRowPlanet['total_points'];
		$IsNoobProtec		= CheckNoobProtec($USER, $GalaxyRowPlanet, $GalaxyRowPlanet);
		$Class		 		= array();

		if ($GalaxyRowPlanet['banaday'] > TIMESTAMP && $GalaxyRowPlanet['urlaubs_modus'] == 1)
		{
			$Class		 	= array('vacation', 'banned');
		}
		elseif ($GalaxyRowPlanet['banaday'] > TIMESTAMP)
		{
			$Class		 	= array('banned');
		}
		elseif ($GalaxyRowPlanet['urlaubs_modus'] == 1)
		{
			$Class		 	= array('vacation');
		}
		elseif ($GalaxyRowPlanet['onlinetime'] < TIMESTAMP - INACTIVE_LONG)
		{
			$Class		 	= array('inactive', 'longinactive');
		}
		elseif ($GalaxyRowPlanet['onlinetime'] < TIMESTAMP - INACTIVE)
		{
			$Class		 	= array('inactive');
		}
		elseif ($IsNoobProtec['NoobPlayer'])
		{
			$Class		 	= array('noob');
		}
		elseif ($IsNoobProtec['StrongPlayer'])
		{
			$Class		 	= array('strong');
		}

		$Result	= array(
			'id'			=> $GalaxyRowPlanet['userid'],
			'username'		=> htmlspecialchars($GalaxyRowPlanet['username'],ENT_QUOTES,"UTF-8"),
			'rank'			=> $GalaxyRowPlanet['total_rank'],
			'points'		=> pretty_number($GalaxyRowPlanet['total_points']),
			'playerrank'	=> sprintf($LNG['gl_in_the_rank'], htmlspecialchars($GalaxyRowPlanet['username'],ENT_QUOTES,"UTF-8"), $GalaxyRowPlanet['total_rank']),
			'class'			=> $Class,
			'isown'			=> ($GalaxyRowPlanet['userid'] != $USER['id']) ? true : false,
		);
		
		return $Result;
	}
}
?>