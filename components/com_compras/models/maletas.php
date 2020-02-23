<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class ComprasModelMaletas extends JModelList
{
	public $_context = 'com_compras.maletas';
	protected $_extension = 'com_compras';

	protected function populateState($ordering = 'ordering', $direction = 'ASC')
	{

		$app = JFactory::getApplication();
		$params		= JComponentHelper::getParams('com_compras');
		$this->setState('params', $app->getParams());
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
}
