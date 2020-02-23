<?php
/**
 * @version		$Id: compras.php 1 2010-2014 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_compras
 * @copyright	Copyright (C) 2008 - 2019 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
// Access check.

if (!JFactory::getUser()->authorise('core.manage', 'com_compras')) {
	return JFactory::getApplication()->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
}

$doc = JFactory::getDocument();
$doc->addStyleSheet('components/com_compras/includes/css/index.css');
JLoader::register('ComprasHelper', __DIR__ . '/helpers/helper.php');
$controller = JControllerLegacy::getInstance('Compras');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();