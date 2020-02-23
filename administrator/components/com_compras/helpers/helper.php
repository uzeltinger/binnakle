<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// No direct access
defined('_JEXEC') or die;

class ComprasHelper
{
	public static $extention = 'com_compras';
	
	public static function addSubmenu($vName)
	{		
	$user = JFactory::getUser();
	$userId	= $user->get('id');	
	$manageProduct = $user->authorise('core.manage.product', 'com_compras');	
	$coreAdmin = $user->authorise('core.admin', 'com_compras');

$vName = JRequest::getVar('view');	
//print_r($vName);
	
	if($coreAdmin)
					{					
		JSubMenuHelper::addEntry(
		''.JText::_('COM_COMPRAS_MENU_PANEL'),
			'index.php?option=com_compras&view=panel',
			$vName == 'panel');			
		JSubMenuHelper::addEntry(
			''.JText::_('COM_COMPRAS_MENU_COUNTRIES'),
			'index.php?option=com_compras&view=countries',
			$vName == 'countries');			
		JSubMenuHelper::addEntry(
			''.JText::_('COM_COMPRAS_MENU_REGIONS'),
			'index.php?option=com_compras&view=regions',
			$vName == 'regions');			
		JSubMenuHelper::addEntry(
			''.JText::_('COM_COMPRAS_MENU_MALETAS'),
			'index.php?option=com_compras&view=maletas',
			$vName == 'maletas');		
		JSubMenuHelper::addEntry(
			''.JText::_('COM_COMPRAS_MENU_COMPRAS'),
			'index.php?option=com_compras&view=compras',
			$vName == 'compras');		
		JSubMenuHelper::addEntry(
			''.JText::_('COM_COMPRAS_MENU_IMPUESTOS'),
			'index.php?option=com_compras&view=impuestos',
			$vName == 'impuestos');		
		JSubMenuHelper::addEntry(
			''.JText::_('COM_COMPRAS_MENU_ENVIOS'),
			'index.php?option=com_compras&view=envios',
			$vName == 'envios');
			JSubMenuHelper::addEntry(
				''.JText::_('COM_COMPRAS_MENU_CUPONES'),
				'index.php?option=com_compras&view=cupons',
				$vName == 'cupons');	
									
					}
					
	}
	
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.delete', 'core.edit', 'core.edit.state', 'core.manage.product'
		);
		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, 'com_compras'));
		}
		return $result;
	}
	
	
	
	
	
	
}