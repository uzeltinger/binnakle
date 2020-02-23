<?php
defined('_JEXEC') or die;
class ComprasController extends JControllerLegacy
{
	public function __construct($config = array())
	{
		parent::__construct($config);
	}	

	public function display($cachable = false, $urlparams = false)
	{	
		$cachable = false;
		$safeurlparams = array(
			'catid' => 'INT',
			'id' => 'INT',
			'cid' => 'ARRAY',
			'year' => 'INT',
			'month' => 'INT',
			'limit' => 'UINT',
			'limitstart' => 'UINT',
			'showall' => 'INT',
			'return' => 'BASE64',
			'filter' => 'STRING',
			'filter_order' => 'CMD',
			'filter_order_Dir' => 'CMD',
			'filter-search' => 'STRING',
			'print' => 'BOOLEAN',
			'lang' => 'CMD',
			'Itemid' => 'INT');

		parent::display($cachable, $safeurlparams);

		return $this;		

	}

	public function validarcodigo(){
		
		$app    = JFactory::getApplication();
		$model  = $this->getModel('checkout');		
		$codigo   = $this->input->getString('codigo');
		$valido = $this->getCupon($codigo);
		echo json_encode($valido);
		$app->close();
		die();
		//	index.php?option=com_compras&task=validarcodigo&codigo=123
	}

	public function getCupon($codigo){
		$db 	= JFactory::getDBO(); 
		$query = 'SELECT a.id, a.name, a.code, a.costo, a.discount FROM #__compras_cupones as a WHERE
		a.published = 1 AND a.code = "'.$codigo.'"';				
		$db->setQuery($query);        
		$cupon = $db->loadObject();		
		return $cupon;
	}
}