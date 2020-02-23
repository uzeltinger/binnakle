<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class ComprasTableCupon extends JTable
{    

   function __construct(&$db)
  {
    parent::__construct( '#__compras_cupones', 'id', $db );
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