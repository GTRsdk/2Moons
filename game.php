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
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');

require_once(ROOT_PATH.'includes/functions/GetBuildingPrice.php');
require_once(ROOT_PATH.'includes/functions/GetBuildingTime.php');
require_once(ROOT_PATH.'includes/functions/IsElementBuyable.php');
require_once(ROOT_PATH.'includes/functions/SortUserPlanets.php');
require_once(ROOT_PATH.'common.php');
	
$page = request_var('page','');
switch($page)
{
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'changelog':
		include_once(ROOT_PATH . 'includes/pages/ShowChangelogPage.php');
		ShowChangelogPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'galaxy':
		(CheckModule(11)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowGalaxyPage.php');
		$ShowGalaxyPage = new ShowGalaxyPage();
	break;
	case 'phalanx':
		(CheckModule(19)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowPhalanxPage.php');
		ShowPhalanxPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'imperium':
		(CheckModule(15)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowImperiumPage.php');
		ShowImperiumPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'fleet':
		(CheckModule(9)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowFleetPages.php');
		ShowFleetPages::ShowFleetPage();
	break;
	case 'fleet1':
		(CheckModule(9)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowFleetPages.php');
		ShowFleetPages::ShowFleet1Page();
	break;
	case 'fleet2':
		(CheckModule(9)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowFleetPages.php');
		ShowFleetPages::ShowFleet2Page();
	break;
	case 'fleet3':
		(CheckModule(9)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowFleetPages.php');
		ShowFleetPages::ShowFleet3Page();
	break;
	case 'fleetajax':
		(CheckModule(9) || CheckModule(24)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowFleetPages.php');
		ShowFleetPages::FleetAjax();
	break;
	case 'missiles':
		(CheckModule(9) || CheckModule(1)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowFleetPages.php');
		ShowFleetPages::MissilesAjax();
	break;
	case 'shortcuts':
		include_once(ROOT_PATH . 'includes/pages/ShowFleetShortcuts.php');
		ShowFleetShortcuts();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'buildings':
		$mode = request_var('mode', '');
		switch ($mode)
		{
			case 'research':
				(CheckModule(3)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
				
				include_once(ROOT_PATH . 'includes/pages/class.ShowResearchPage.php');
				new ShowResearchPage();
			break;
			case 'fleet':
				(CheckModule(4)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
				
				include_once(ROOT_PATH . 'includes/pages/class.ShowShipyardPage.php');
				$FleetBuildingPage = new ShowShipyardPage();
				$FleetBuildingPage->FleetBuildingPage ();
			break;
			case 'defense':
				(CheckModule(5)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
				
				include_once(ROOT_PATH . 'includes/pages/class.ShowShipyardPage.php');
				$DefensesBuildingPage = new ShowShipyardPage();
				$DefensesBuildingPage->DefensesBuildingPage ();
			break;
			default:
				(CheckModule(2)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
				
				include_once(ROOT_PATH . 'includes/pages/class.ShowBuildingsPage.php');
				new ShowBuildingsPage();
			break;
		}
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'resources':
		(CheckModule(23)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowResourcesPage.php');
		ShowResourcesPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'officier':
		(CheckModule(18) && CheckModule(8)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowOfficierPage.php');
		new ShowOfficierPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'trader':
		(CheckModule(13)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowTraderPage.php');
		ShowTraderPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'techtree':
		(CheckModule(28)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowTechTreePage.php');
		ShowTechTreePage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'infos':
		(CheckModule(14)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowInfosPage.php');
		new ShowInfosPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'messages':
		(CheckModule(16)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowMessagesPage.php');
		ShowMessagesPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'alliance':
		(CheckModule(0)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
 
		include_once(ROOT_PATH . 'includes/pages/class.ShowAlliancePage.php');
		new ShowAlliancePage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'buddy':
		(CheckModule(6)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
		
		include_once(ROOT_PATH . 'includes/pages/ShowBuddyPage.php');
		ShowBuddyPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'notes':
		(CheckModule(17)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowNotesPage.php');
		new ShowNotesPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'fleettrader':
		(CheckModule(38)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowFleetTraderPage.php');
		ShowFleetTraderPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'statistics':
		(CheckModule(25)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowStatisticsPage.php');
		ShowStatisticsPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'search':
		(CheckModule(26)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowSearchPage.php');
		ShowSearchPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'options':
		include_once(ROOT_PATH . 'includes/pages/class.ShowOptionsPage.php');
		new ShowOptionsPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'banned':
		(CheckModule(21)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowBannedPage.php');
		ShowBannedPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'topkb':
		(CheckModule(6)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowTopKB.php');
		ShowTopKB();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'records':
		(CheckModule(22)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowRecordsPage.php');
		ShowRecordsPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'chat':
		(CheckModule(7)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/class.ShowChatPage.php');
		new ShowChatPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
    case 'support':
		(CheckModule(27)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
			
		include_once(ROOT_PATH . 'includes/pages/ShowSupportPage.php');
        new ShowSupportPage();
    break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//	
    case 'playercard':
		(CheckModule(21)) ? message($LNG['sys_module_inactive'],"?page=overview", 3, true, true) : '';
					
        include_once(ROOT_PATH . 'includes/pages/ShowPlayerCard.php');
        ShowPlayerCard();
    break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//	
    case 'faq':
        include_once(ROOT_PATH . 'includes/pages/ShowFAQ.php');
        ShowFAQPage();
    break; 
// ----------------------------------------------------------------------------------------------------------------------------------------------//	
    case 'battlesim':
        include_once(ROOT_PATH . 'includes/pages/ShowBattleSimPage.php');
        ShowBattleSimPage();
    break; 
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'logout':
	    include_once(ROOT_PATH . 'includes/pages/ShowLogoutPage.php');
		ShowLogoutPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//
	case 'overview':
	default:
		include_once(ROOT_PATH . 'includes/pages/ShowOverviewPage.php');
		ShowOverviewPage();
	break;
// ----------------------------------------------------------------------------------------------------------------------------------------------//

}
?>