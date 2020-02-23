<?php
/**
* @copyright	Copyright(C) 2008-2014 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/

// No direct access
defined('_JEXEC') or die;


class ComprasViewCupon extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	public function display($tpl = null)
	{
		$canDo	= ComprasHelper::getActions();		
		if (!$canDo->get('core.admin')) {
		$app =& JFactory::getApplication();
		$msg = JText::_('USER ERROR AUTHENTICATION FAILED').' : '. $this->Profile->name;
		$app->Redirect(JRoute::_('index.php?option=com_compras', $msg));	
		}
		
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		
		
		
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		
		JToolBarHelper::title($isNew ? JText::_('COM_compras_MANAGER_cupon_NEW') : JText::_('COM_compras_MANAGER_cupon_EDIT'), 'cupons.png');
		
		JToolBarHelper::apply('cupon.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('cupon.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('cupon.save2new', 'JTOOLBAR_SAVE_AND_NEW');
			
			if (empty($this->item->id))  {
			JToolBarHelper::cancel('cupon.cancel', 'JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('cupon.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
