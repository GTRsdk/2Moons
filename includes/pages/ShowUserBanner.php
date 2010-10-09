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

if(!defined('INSIDE')) die('Hacking attempt!');

function ShowUserBanner()
{
	$id = request_var('id', 0);

	if(CheckModule(37) || $id == 0) exit();

	require_once(ROOT_PATH.'includes/classes/class.StatBanner.' . PHP_EXT);

	if(!isset($_GET['debug'])) {
		header('Expires: '.date('D, d M Y H:i:s', TIMESTAMP + 7200)).' GMT';
		header("Cache-Control: max-age=7200, private");
		header("Content-type: image/png"); 
	}

	$banner = new StatBanner();
	$banner->ShowStatBanner($id);
	
}
?>