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

function ShowChangelogPage()
{
	global $lang;

	includeLang('CHANGELOG');

	foreach($lang['changelog'] as $a => $b)
	{
		$parse['version_number'] = $a;
		$parse['description'] = makebr($b);

		$body .= parsetemplate(gettemplate('changelog/changelog_table'), $parse);
	}

	$parse 			= $lang;
	$parse['body'] 	= $body;

	return display(parsetemplate(gettemplate('changelog/changelog_body'), $parse));
}
?>