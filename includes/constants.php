<?php

##############################################################################
# *                                                                          #
# * 2MOONS                                                                   #
# *                                                                          #
# * @copyright Copyright (C) 2010 By ShadoX from titanspace.de               #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
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

if ( !defined('INSIDE') ) die(header("location:../"));

	//TEMPLATES DEFAULT SETTINGS
	define('DEFAULT_SKINPATH' 		  , 'styles/skins/gow/');
	define('TEMPLATE_DIR'     		  , 'styles/templates/');
	
	define('PROTOCOL'				  , $_SERVER["HTTPS"] == 'on' ? 'https://' : 'http://');
	define('HTTP_ROOT'				  , str_replace(basename($_SERVER["PHP_SELF"]), '', $_SERVER["PHP_SELF"]));

	define('DEFAULT_LANG'             , "de"); // For Fatal Errors!
	define('PHPEXT'                   , "php");
	
	// UNIVERSE DATA, GALAXY, SYSTEMS AND PLANETS || DEFAULT 9-499-15 RESPECTIVELY
	define('MAX_GALAXY_IN_WORLD'      ,   9);
	define('MAX_SYSTEM_IN_GALAXY'     , 499);
	define('MAX_PLANET_IN_SYSTEM'     ,  15);

	// FACTOR FOR THE PLANETSIZE
	define('PLANET_SIZE_FACTOR'		  , 1.0);
	
	// NUMBER OF COLUMNS FOR SPY REPORTS
	define('SPY_REPORT_ROW'           , 2);

	// FIELDS FOR EACH LEVEL OF THE LUNAR BASE
	define('FIELDS_BY_MOONBASIS_LEVEL', 3);

	// FIELDS FOR EACH LEVEL OF THE TERRAFORMER
	define('FIELDS_BY_TERRAFORMER'	  , 5);

	// NUMBER OF PLANETS THAT MAY HAVE A PLAYER WITHOUT TECHNO
	define('STANDART_PLAYER_PLANETS'  , 9);

	// MAXIMAL PLANETS ( -1 = unlimited )
	define('MAX_PLANETS'              , -1);

	// ADDED PLANET PRO 2 TECH LEVELS
	define('PLANETS_PER_TECH' 		  , 1);	

	// NUMBER OF BUILDINGS THAT CAN GO IN THE CONSTRUCTION QUEUE
	define('MAX_BUILDING_QUEUE_SIZE'  , 5);

	// NUMBER OF SHIPS THAT CAN BUILD FOR ONCE
	define('MAX_FLEET_OR_DEFS_PER_ROW', 1000000);
	
	// NUMBER OF SHIPS THAT CAN BUILD FOR ONCE
	define('MAX_FLEET_OR_DEFS_IN_BUILD', 10);

	// PERCENTAGE OF RESOURCES THAT CAN BE OVER STORED
	// 1.0 TO 100% - 1.1% FOR 110 AND SO ON
	define('MAX_OVERFLOW'             , 1.0);

	// The Limit of DM Mission (ID: 11)
	define('MAX_DM_MISSIONS'		  , 1);
	
	// Trader Tax
	define('DARKMATTER_FOR_TRADER'	  , 750);
	
	// The Faction for the Moon Creation
	define('MOON_CHANCE_FACTOR'		  , 1);
	
	// Maximal moon chance
	define('MAX_MOON_CHANCE'		 , 20);
	
	// If ture, the calculation for Researchtime is like OGAME, if false its calculation with standart XNova Formula
	define('NEW_RESEARCH'			  , true);
	
	// University reduction per level - standard 8% (Info: 1 = 100%)
	define('UNIVERISTY_RESEARCH_REDUCTION'	, 0.08);
	
	// IF SET true, the derbis will be delete, when a moon is created.
	define('DESTROY_DERBIS_MOON_CREATE', true);
	
	// Factor for Metal/Crystal and Deuterium Storages
	define('STORAGE_FACTOR'			  , 1.0);
	
	// DARKMATTER PRICE FOR OFFICIER LEVEL
	define('DM_PRO_OFFICIER_LEVEL'	  , 1000);
	
	// Max Amount of Fleets where allow on one ACS
	define('MAX_FLEETS_PER_ACS'	  	  , 16);
	
	// INITIAL RESOURCE OF NEW PLANETS
	define('BUILD_METAL'              , 500);
	define('BUILD_CRISTAL'            , 500);
	define('BUILD_DEUTERIUM'          , 0);
	
	// Max Round on Combats
	define('MAX_ATTACK_ROUNDS'		  , 6);
	
	// Min Time for VMod in Seconds!
	define('VACATION_MIN_TIME'		  , 259200);	
	
	// Enable the one-Click SImulation on Spy-Raports
	define('ENABLE_SIMULATOR_LINK'    , true);
	
	// Max. User Session in Seconds
	define('SESSION_LIFETIME'		  , 43200);
	
	// DISCLAMER INFOS
	define('DICLAMER_NAME'            , "Edit constans.php!");
	define('DICLAMER_ADRESS1'         , "Edit constans.php!");
	define('DICLAMER_ADRESS2'         , "Edit constans.php!");
	define('DICLAMER_TEL'     		  , "Edit constans.php!");
	define('DICLAMER_EMAIL'    		  , "Edit constans.php!");

	// Time betwin Jumps for Jumpgates
	define('JUMPGATE_WAIT_TIME'		  , 3600);
	
	// UTF-8 Support for Names (Requried for non-english Chars!)
	define('UTF8_SUPPORT'          	  , false);	
	
	// OFFICIERS DEFAULT VALUES
	define('COMMANDANT'				  ,      3);
	define('AMIRAL'				  	  ,   0.05);
	define('ESPION'				  	  ,      5);
	define('CONSTRUCTEUR'             ,    0.1);
	define('SCIENTIFIQUE'			  ,    0.1);
	define('GENERAL'			      ,   0.10);
	define('DEFENSEUR'			  	  ,   0.25);
	define('TECHNOCRATE'			  ,   0.05);
	define('STOCKEUR'				  ,    0.5);
	define('GEOLOGUE'				  ,   0.05);
	define('INGENIEUR'				  ,   0.05);
	
	// AdminAuthlevels
	define('AUTH_ADM'                 , 3);
	define('AUTH_OPS'                 , 2);
	define('AUTH_MOD'                 , 1);
	
	// Data Tabells
	define('DB_NAME'				  , $database["databasename"]);
	define('DB_PREFIX'			  	  , $database["tableprefix"]);
	
	define('AKS'				  	  , $database["tableprefix"]."aks");
	define('ALLIANCE'			  	  , $database["tableprefix"]."alliance");
	define('BANNED'				  	  , $database["tableprefix"]."banned");
	define('BUDDY'				  	  , $database["tableprefix"]."buddy");
	define('CHAT'				  	  , $database["tableprefix"]."chat");
	define('CONFIG'				  	  , $database["tableprefix"]."config");
	define('DIPLO'				  	  , $database["tableprefix"]."diplo");
	define('FLEETS'				  	  , $database["tableprefix"]."fleets");
	define('NEWS'				  	  , $database["tableprefix"]."news");
	define('NOTES'				  	  , $database["tableprefix"]."notes");
	define('MESSAGES'			  	  , $database["tableprefix"]."messages");
	define('PLANETS'	              , $database["tableprefix"]."planets");
	define('RW'			              , $database["tableprefix"]."rw");
	define('SESSION'				  , $database["tableprefix"]."session");
	define('STATPOINTS'				  , $database["tableprefix"]."statpoints");
	define('SUPP'					  , $database["tableprefix"]."supp");
	define('TOPKB'					  , $database["tableprefix"]."topkb");
	define('USERS'				  	  , $database["tableprefix"]."users");
	define('USERS_VALID'		  	  , $database["tableprefix"]."users_valid");
	
	// MOD-TABLES
	
	
?>