<?php

/**
 *  2Moons
 *  Copyright (C) 2011  Slaver
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Slaver <slaver7@gmail.com>
 * @copyright 2009 Lucky <lucky@xgproyect.net> (XGProyecto)
 * @copyright 2011 Slaver <slaver7@gmail.com> (Fork/2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.3.5 (2011-04-22)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */
 
class Theme
{
	static public $Themes;
	
	function __construct()
	{	
		$this->skininfo = array();
		$this->skin		= isset($_SESSION['dpath']) ? $_SESSION['dpath'] : DEFAULT_THEME;
		$this->setUserTheme($this->skin);
	}
	
	function isHome() {
		$this->template		= ROOT_PATH.'styles/home/';
		$this->customtpls	= array();
	}
	
	function setUserTheme($Theme) {
		if(!file_exists(ROOT_PATH.'styles/theme/'.$Theme.'/style.cfg'))
			return false;
			
		$this->skin		= $Theme;
		$this->parseStyleCFG();
	}
		
	function getTheme() {
		return './styles/theme/'.$this->skin.'/';
	}
	
	function getThemeName() {
		return $this->skin;
	}
	
	function getTemplatePath() {
		return ROOT_PATH.'/styles/templates/'.$this->skin.'/';
	}
		
	function isCustomTPL($tpl) {
		return in_array($tpl, $this->customtpls);
	}
	
	function parseStyleCFG() {
		require(ROOT_PATH.'styles/theme/'.$this->skin.'/style.cfg');
		$this->skininfo		= $Skin;
		$this->customtpls	= $Skin['templates'];	
	}
	
	static function getAvalibleSkins() {
		if(isset(self::$Themes))
			return self::$Themes;
		
		if(file_exists(ROOT_PATH.'cache/cache.themes.php'))
			return unserialize(file_get_contents(ROOT_PATH.'cache/cache.themes.php'));
			
		$Skins	= array_diff(scandir(ROOT_PATH.'styles/theme/'), array('..', '.', '.svn', '.htaccess', 'index.htm'));
		$Themes	= array();
		foreach($Skins as $Theme) {
			require(ROOT_PATH.'styles/theme/'.$Theme.'/style.cfg');
			$Themes[$Theme]	= $Skin['name'];
		}
		self::$Themes	= $Themes;
		file_put_contents(ROOT_PATH.'cache/cache.themes.php', serialize($Themes));
		return self::$Themes;
	}
}

?>