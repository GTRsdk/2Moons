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

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_CRON' , true);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.'.$phpEx);

$id = request_var("id", 0);
if($id == 0) die();

includeLang('INGAME');


include_once("./includes/classes/class.StatBanner.php");
$Statstime	= $game_config['stat_update_time'] * 60;
$banner = new StatBanner();
$lastedit = filemtime($banner->path.$id.".png");
header('Last-Modified: '.date('D, d M Y H:i:s T', $lastedit));
header('Expires: '.date('D, d M Y H:i:s T', time() + $Statstime));
header('Content-type: image/png'); 
header("Cache-Control: public, max-age=".$Statstime.", s-maxage=".$Statstime);

$banner->ShowStatBanner($id);
?>