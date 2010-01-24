<?php
##############################################################################
# *                    #
# * XG PROYECT                 #
# *                     #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar  #
# *                    #
# *                    #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.          #
# *                    #
# *  This program is distributed in the hope that it will be useful,   #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of    #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the    #
# *  GNU General Public License for more details.        #
# *                    #
##############################################################################

if(!defined('INSIDE')){ die(header("location:../../"));}

function ShowFAQ()
{
	global $lang;
	includeLang('FAQ');

	$template	= new template();
	$template->page_header();
	$template->page_topnav();
	$template->page_leftmenu();
	$template->page_planetmenu();
	$template->page_footer();
		
	$template->assign_vars(array(	
		'FAQList'		=> $lang['faq'],
		'faq_overview'	=> $lang['faq_overview'],
	));
	
	$template->display("faq_overview.tpl");
}
?>