<?php

defined('_JEXEC') or die;

class ComprasViewMaletas extends JViewLegacy
{
	public function display($tpl = null)
	{
		$app        = JFactory::getApplication();
		$user       = JFactory::getUser();
		$dispatcher = JEventDispatcher::getInstance();
		$this->lang = substr( JRequest::getVar('lang','es') , 0, 2);

		$this->items  = $this->get('Items');
		$this->state = $this->get('State');
		$this->user  = $user;
		
		//echo '<pre>';print_r($this->maletasJson);echo '<pre>';
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}
		$this->_prepareDocument();
		$session = JFactory::getSession();
		$this->comprador = [];
		if($session->get('comprador')){
			$this->comprador = $session->get('comprador');
		}
		$params = $this->state->get('params');
		
		//print_r($params->get('game'));echo '<pre>'; print_r($params);
		$this->game = $params->get('game');
		if($this->game==1){
			$tpl = "the_expedition";
		}else if($this->game==2){
			$tpl = "mission0";
		}
		
		if($this->lang=='en'){
			foreach ($this->items as $key => $value) {
				//echo $this->items[$key]->name_en.'<br>';
				$this->items[$key]->name = $this->items[$key]->name_en; 
				$this->items[$key]->detail = $this->items[$key]->detail_en; 
			}
		}
		$this->maletasJson = json_encode($this->items);

		parent::display($tpl);
	}

	/**
	 * Prepares the document.
	 *
	 * @return  void
	 */
	protected function _prepareDocument()
	{
		$app     = JFactory::getApplication();
		$menus   = $app->getMenu();
		$pathway = $app->getPathway();
		$title   = null;

		/**
		 * Because the application sets a default page title,
		 * we need to get it from the menu item itself
		 */
		$menu = $menus->getActive();

		
		

		

	}
}
