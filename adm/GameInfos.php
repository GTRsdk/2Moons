<?php

##############################################################################
# *																			 #
# * RN FRAMEWORK															 #
# *  																		 #
# * @copyright Copyright (C) 2009 By ShadoX from xnova-reloaded.de	    	 #
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

define('ROOT_PATH', './../');
include(ROOT_PATH . 'extension.inc');
include(ROOT_PATH . 'common.' . PHP_EXT);
include('AdminFunctions/Autorization.' . PHP_EXT);

if ($ConfigGame != 1) die();

$parse['info'] 		= $_SERVER['SERVER_SOFTWARE'];
$parse['vPHP'] 		= PHP_VERSION;
$parse['vGame'] 	= VERSION;
$parse['vMySQLc'] 	= $db->getVersion();
$parse['vMySQLs'] 	= $db->getServerVersion();
$parse['root'] 		= $_SERVER["SERVER_NAME"];
$parse['gameroot'] 	= $_SERVER["SERVER_NAME"] . str_replace("/adm/GameInfos.php", "",str_replace("\\","/",$_SERVER['SCRIPT_NAME']));
$parse['dl'] 		= ((@ini_get('enable_dl') || strtolower(@ini_get('enable_dl')) == 'on') && (!@ini_get('safe_mode') || strtolower(@ini_get('safe_mode')) == 'off') && function_exists('dl')) ? 'Erlaubt' : 'Nicht erlaubt';


display(parsetemplate(gettemplate('adm/InfoMessagesBody'), $parse), false, '', true, false);

?>