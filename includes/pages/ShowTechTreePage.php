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

function ShowTechTreePage($CurrentUser, $CurrentPlanet)
{
	global $resource, $requeriments, $lang;

	$template	= new template();
	$template->page_header();
	$template->page_topnav();
	$template->page_leftmenu();
	$template->page_planetmenu();
	$template->page_header();
	$template->page_footer();
	
	foreach($lang['tech'] as $Element => $ElementName)
	{
		if (!isset($resource[$Element]))
			$TechTreeList[]	= $ElementName;
		else
		{
			if(isset($requeriments[$Element]))
			{
				foreach($requeriments[$Element] as $RegID => $RedCount)
				{
					$RequeriList[$Element][]	= array('id' => $RegID, 'count' => $RedCount, 'own' => (isset($CurrentPlanet[$resource[$RegID]])) ? $CurrentPlanet[$resource[$RegID]] : $CurrentUser[$resource[$RegID]]);
				}
			}
			$TechTreeList[]	= array(
				'id' 	=> $Element,
				'name'	=> $ElementName,
				'need'	=> (isset($RequeriList)) ? $RequeriList : false,
			);
		}
	}
	
	$template->assign_vars(array(
		'TechTreeList'		=> $TechTreeList,
		'tt_requirements'	=> $lang['tt_requirements'],
		'lang'				=> $lang['tech'],
		'tt_lvl'			=> $lang['tt_lvl'],
	));

	$template->display("techtree_overview.tpl");
}
?>