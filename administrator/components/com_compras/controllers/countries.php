<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class ComprasControllerCountries extends JControllerAdmin
{
		
	function &getModel($name = 'Country', $prefix = 'ComprasModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}