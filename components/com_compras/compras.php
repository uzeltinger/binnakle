<?php
$input = JFactory::getApplication()->input;
$user  = JFactory::getUser();

$controller = JControllerLegacy::getInstance('Compras');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
?>