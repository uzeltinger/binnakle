<?php
/**
 * @version		$Id: properties.php 1 2010-2014 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2014 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

class Com_ComprasInstallerScript {

	function install($parent) {
		global $mainframe;
		jimport('joomla.filesystem.folder');		
		
		$images_folder = JPATH_SITE.'/'.'images'.'/'.'compras';
		JFolder::create($images_folder,0755);
		JFolder::create($images_folder.'/'.'images',0755);
		JFolder::create($images_folder.'/'.'images'.'/'.'thumbs',0755);
		JFolder::create($images_folder.'/'.'pdfs',0755);
		JFolder::create($images_folder.'/'.'profiles',0755);
		echo '<h2>'. JText::_('Successfully installed compras') .'</h2>'; 
	}

	function uninstall($parent) {
		echo '<h2>'. JText::_('Successfully Uninstalled compras') .'</h2>';		
	}	
}
