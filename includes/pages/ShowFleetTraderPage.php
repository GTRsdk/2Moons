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

function ShowFleetTraderPage()
{
	global $USER, $PLANET, $LNG, $CONF, $pricelist, $resource;
	$PlanetRess = new ResourceUpdate();
	$PlanetRess->CalcResource();
	$CONF['trade_allowed_ships']	= explode(',', $CONF['trade_allowed_ships']);
	$ID								= request_var('id', 0);
	if(!empty($ID) && in_array($ID, $CONF['trade_allowed_ships'])) {
		$Count						= max(min(request_var('count', '0'), $PLANET[$resource[$ID]]), 0);
		$PLANET['metal']			= bcadd($PLANET['metal'], bcmul($Count, bcmul($pricelist[$ID]['metal'], (float) (1 - $CONF['trade_charge']))));
		$PLANET['crystal']			= bcadd($PLANET['crystal'], bcmul($Count, bcmul($pricelist[$ID]['crystal'], (float) (1 - $CONF['trade_charge']))));
		$PLANET['deuterium']		= bcadd($PLANET['deuterium'], bcmul($Count, bcmul($pricelist[$ID]['deuterium'], (float) (1 - $CONF['trade_charge']))));
		$USER['darkmatter']			= bcadd($USER['darkmatter'], bcmul($Count, bcmul($pricelist[$ID]['darkmatter'], (float) (1 - $CONF['trade_charge']))));
		$PlanetRess->Builded[$ID]	= bcadd(bcmul('-1', $Count), $PlanetRess->Builded[$ID]);
	}
	
	$PlanetRess->SavePlanetToDB();

	$template	= new template();
	$template->loadscript('fleettrader.js');
	$template->execscript('updateVars();');
	$Cost	= array();
	foreach($CONF['trade_allowed_ships'] as $ID)
	{
		$Cost[$ID]	= array($PLANET[$resource[$ID]], $pricelist[$ID]['metal'], $pricelist[$ID]['crystal'], $pricelist[$ID]['deuterium'], $pricelist[$ID]['darkmatter']);
	}
	$template->assign_vars(array(	
		'tech'						=> $LNG['tech'],
		'ft_head'					=> $LNG['ft_head'],
		'ft_count'					=> $LNG['ft_count'],
		'ft_max'					=> $LNG['ft_max'],
		'ft_total'					=> $LNG['ft_total'],
		'ft_charge'					=> $LNG['ft_charge'],
		'ft_absenden'				=> $LNG['ft_absenden'],
		'trade_allowed_ships'		=> $CONF['trade_allowed_ships'],
		'CostInfos'					=> json_encode($Cost),
		'Charge'					=> $CONF['trade_charge'],
	));
	
	$template->show("fleettrader_overview.tpl");
}
?>