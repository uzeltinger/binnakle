<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/

defined('_JEXEC') or die;

class ComprasViewPanel extends JViewLegacy
	{
	protected $items;
	protected $pagination;
	protected $state;
	
	
	public function display($tpl = null)
	{	
		if ($this->getLayout() !== 'modal')
		{
			ComprasHelper::addSubmenu('panel');
		}
		
		$canDo	= ComprasHelper::getActions();		
		if (!$canDo->get('core.admin')) {
		$app =& JFactory::getApplication();
		$msg = JText::_('USER ERROR AUTHENTICATION FAILED').' : '. $this->Profile->name;
		$app->Redirect(JRoute::_('index.php?option=com_compras', $msg));	
		}
				
		$this->paises		= $this->get('Paises');
		$this->regiones		= $this->get('Regiones');
		$this->maletas		= $this->get('Items');
		$this->compras		= $this->get('Compras');
		$this->impuestos	= $this->get('Impuestos');
		$this->envios		= $this->get('Envios');


		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();			
		}

		parent::display($tpl);
	}		
	
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('PANEL'));
		require_once JPATH_COMPONENT.'/helpers/helper.php';
		$canDo	= ComprasHelper::getActions();		

		if ($canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_compras');
		}
		
	}
	
}