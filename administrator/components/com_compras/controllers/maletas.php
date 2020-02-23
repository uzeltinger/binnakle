<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class ComprasControllerMaletas extends JControllerAdmin
{
		
	function &getModel($name = 'Maleta', $prefix = 'ComprasModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}