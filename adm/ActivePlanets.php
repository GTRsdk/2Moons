<?php

##############################################################################
# *																			 #
# * RN FRAMEWORK															 #
# *  																		 #
# * @copyright Copyright (C) 2009 By ShadoX from xnova-reloaded.de	 		 #
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
include('AdminFunctions/Autorization.' . $phpEx);

if ($Observation != 1) die();

$parse 			= $lang;
$ActivePlanets 	= $db->query("SELECT `name`,`galaxy`,`system`,`planet`,`points`,`last_update` FROM ".PLANETS." WHERE `last_update` >= '". (time()-15 * 60) ."' ORDER BY `id` ASC;");
$Count          = 0;

while ($ActivPlanet = $db->fetch_array($ActivePlanets))
{
	$parse['online_list'] .= "<tr>";
	$parse['online_list'] .= "<th><center><b>". $ActivPlanet['name'] ."</b></center></th>";
	$parse['online_list'] .= "<th><center><b>[". $ActivPlanet['galaxy'] .":". $ActivPlanet['system'] .":". $ActivPlanet['planet'] ."]</b></center></th>";
	$parse['online_list'] .= "<th><center><b>". pretty_number($ActivPlanet['points'] / 1000) ."</b></center></th>";
	$parse['online_list'] .= "<th><center><b>". pretty_time(time() - $ActivPlanet['last_update']) . "</b></center></th>";
	$parse['online_list'] .= "</tr>";
	$Count++;
}

$parse['online_list'] .= "<tr>";
$parse['online_list'] .= "<th colspan=\"4\">" . $lang['ap_there_are'] . $Count . $lang['ap_with_activity'] . "</th>";
$parse['online_list'] .= "</tr>";

display( parsetemplate( gettemplate('adm/ActivePlanetsBody')	, $parse ), false, '', true, false);

?>