<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class ComprasModelCheckout extends JModelList
{
	public $_context = 'com_compras.checkout';
	protected $_extension = 'com_compras';

	protected function populateState($ordering = 'ordering', $direction = 'ASC')
	{

		$app = JFactory::getApplication();
		$params		= JComponentHelper::getParams('com_compras');
		$this->setState('filter.published', 1);
	}

	function getListQuery()
	{

		$params		= JComponentHelper::getParams('com_compras');
		$lang = JFactory::getLanguage();
		$thisLang = $lang->getTag();
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select($this->getState('list.select', 'm.*'));
		$query->from('#__compras_maleta AS m');
		$query->where('m.published = 1');
		$query->group('m.id');
		$query->order('m.ordering' . ' ' . 'ASC');
		//echo '<br>';
		//echo nl2br(str_replace('#_','rkgje',$query));
		return $query;
	}

	public function &getItems()
	{
		$items	= parent::getItems();
		return $items;
	}

	public function getPaises(){
		$db 	= JFactory::getDBO(); 
		$query = 'SELECT p.id, p.name, p.region, 
		i.id as impuesto_id, i.name as impuesto_name, i.value as impuesto_value,
		e.id as envio_id, e.name as envio_name, e.costo as envio_costo, e.dias as envio_dias
		FROM #__compras_country as p 
		LEFT JOIN #__compras_impuesto as i on i.country = p.id
		LEFT JOIN #__compras_envio as e on e.region = p.region
		order by p.name asc';	
		
        $db->setQuery($query);        
		$profile = $db->loadObjectList();		
		return $profile;
	}

	public function storeCompra($data){
	
		$db		 = JFactory::getDBO();		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_compras/tables');			
		$row = JTable::getInstance('compra', 'ComprasTable');
			
		if (!$row->bind($data)) {
			 $this->setError( $this->_db->getErrorMsg() );
			echo $this->_db->getErrorMsg();
			JError::raiseError(500, $this->_db->getErrorMsg() );
			return false;
		}

		// Make sure the hello record is valid
		if (!$row->check()) {
			$this->setError( $this->_db->getErrorMsg() );
			echo $this->_db->getErrorMsg();
			JError::raiseError(500, $this->_db->getErrorMsg() );
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );	
			echo $this->_db->getErrorMsg();	
				JError::raiseError(500, $this->_db->getErrorMsg() );
			return false;
		}
		
		return $row;
	}
	/*
	public function getImpuestos(){
		$db 	= JFactory::getDBO(); 
		$query = 'SELECT i.id, i.name, i.value, c.name as pais FROM #__compras_impuesto as i 
		LEFT JOIN #__compras_country as c on c.id = i.country';		
        $db->setQuery($query);        
		$impuestos = $db->loadObjectList();
		return $impuestos;
	}
	public function getEnvios(){
		$db 	= JFactory::getDBO();
		$query = 'SELECT e.id, e.name, e.region, e.costo, e.dias, c.id as pais_id, c.name as pais_nombre FROM #__compras_envio as e 
		LEFT JOIN #__compras_country as c on c.region = e.region';		
        $db->setQuery($query);        
		$profile = $db->loadObjectList();		
		return $profile;
	}
	public function getRegiones(){
		$db 	= JFactory::getDBO(); 
		$query = 'SELECT * FROM #__compras_region';		
        $db->setQuery($query);        
		$profile = $db->loadObjectList();		
		return $profile;
	}
	*/
}
