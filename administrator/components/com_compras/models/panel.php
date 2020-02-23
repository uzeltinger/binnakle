<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class ComprasModelPanel extends JModelList
{
	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		
	}
	
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.access');
		$id.= ':' . $this->getState('filter.published');
		
		return parent::getStoreId($id);
	}
	
	protected function getListQuery($resolveFKs = true)
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
				
		// Select the required fields from the table.
		$query->select(			
			'a.id, a.costo, a.game, a.name, a.alias, a.checked_out, a.checked_out_time, a.published, a.ordering'
		);
		$query->from('#__compras_maleta AS a');

		//$query->select('g.name AS game_name');
		//$query->join('LEFT', '`#__compras_game` AS g ON g.id = a.game');
	
		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}
	
		

	function getPaises() 
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);        
		$query->select('a.*');
		$query->from('#__compras_country AS a');
		$query->select('r.name AS region_name');
        $query->join('LEFT', '`#__compras_region` AS r ON r.id = a.region');
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        return $rows;
    }
	function getRegiones() 
    {   
        $query = 'SELECT * FROM #__compras_region ';		
		$this->_db->setQuery( $query );
		$row = $this->_db->loadObjectList();
		return $row;
    }
	function getCompras() 
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);        
		$query->select('a.*');
		$query->from('#__compras_compra AS a');
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        return $rows;
    }
	function getImpuestos() 
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);        
        $query->select('a.*');
        $query->from('#__compras_impuesto AS a');
		$query->select('cy.name AS country_name');
		$query->join('LEFT', '`#__compras_country` AS cy ON cy.id = a.country');
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        return $rows;
    }
	function getEnvios() 
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);        
        $query->select('a.*');
		$query->from('#__compras_envio AS a');
		$query->select('r.name AS region_name');
		$query->join('LEFT', '`#__compras_region` AS r ON r.id = a.region');
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        return $rows;
    }
/*
    $this->paises		= $this->get('Paises');
    $this->regiones		= $this->get('Regiones');
    $this->maletas		= $this->get('Items');
    $this->compras		= $this->get('Compras');
    $this->impuestos	= $this->get('Impuestos');
    $this->envios		= $this->get('Envios');
    */
}
