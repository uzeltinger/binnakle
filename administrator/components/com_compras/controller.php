<?php
/**
 * @version		$Id: compras.php 1 2010-2014 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_compras
 * @copyright	Copyright (C) 2008 - 2014 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

class ComprasController extends JControllerLegacy
{		
	protected $default_view = 'panel';	
	public function display($cachable = false, $urlparams = false)
	{
		parent::display();		
		return $this;
	}
	/*
	public function addCountries(){
		$paises = $this->getCountires();
		//print_r($paises);
		$model = $this->getModel('country');
		$c = new JObject;
		foreach($paises as $pais){
			$c->id = 0;
			$c->published = 1;
			$c->name = $pais->name;
			$c->cuntry_code = $pais->country_2_code;
			$row = $model->storeCountry($c);
			//print_r($row);
			//die();
		}
		
	}

	public function storeBlob(){
		
		$model = $this->getModel('country');
		$c = new JObject;
		$c->id = 0;
		$c->blob = file_get_contents(__DIR__.'store.pdf');
		
		$row = $model->storeBlob($c);

	}

	public function getCountires(){
		$db 	= JFactory::getDBO(); 
		$query = 'SELECT a.* FROM #__virtuemart_countries as a';
		$db->setQuery($query);        
		$cupon = $db->loadObjectList();		
		return $cupon;
	}
*/
}