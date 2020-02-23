<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class ComprasTableCompra extends JTable
{    

   function __construct(&$db)
  {
    parent::__construct( '#__compras_compra', 'id', $db );
  }
    function check()
	{
		$date = JFactory::getDate();
		if ($this->id)
		{
			$this->modified = $date->toSql();
		}
		else
		{
			$this->created = $date->toSql();
        }        
        
		return true;
	}		
}
?>