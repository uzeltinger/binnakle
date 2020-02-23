<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class ComprasTableEnvio extends JTable
{    

   function __construct(&$db)
  {
    parent::__construct( '#__compras_envio', 'id', $db );
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
        
        if(empty($this->alias)) {
			$this->alias = $this->name;
		}
		$this->alias = JFilterOutput::stringURLSafe($this->alias);
		if(trim(str_replace('-','',$this->alias)) == '') {
			$datenow =& JFactory::getDate();
			$this->alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
        }
        
		return true;
	}		
}
?>