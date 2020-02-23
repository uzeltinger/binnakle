<?php
// No direct access.
defined('_JEXEC') or die;
if (!defined('DS')) {
  define('DS', DIRECTORY_SEPARATOR);
}
/*  
require_once(dirname(__file__) . DS . 'framework' . DS . 'helper.cache.php');
$this->cache = new GKTemplateCache($this);
$this->cache->registerCache(); 
$this->cache->registerJSCompression();	 
*/
require('libs/detectmobilebrowser.php');
$params = JFactory::getApplication()->getTemplate(true)->params;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;

unset($doc->_scripts[$this->baseurl . '/media/jui/js/jquery-noconflict.js']);
unset($doc->_scripts[$this->baseurl . '/media/jui/js/bootstrap.min.js']);
unset($doc->_scripts[$this->baseurl . '/media/jui/js/jquery-migrate.min.js']);
unset($doc->_scripts[$this->baseurl . '/media/system/js/caption.js']);
$this->addFavicon($this->baseurl . '/images/favicon.png');
/*$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.css');*/
$doc->addStyleSheet('templates/' . $this->template . '/css/bootstrap.min.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/style.css');

$doc->addScript($this->baseurl . '/media/jui/js/jquery.min.js');
$doc->addScript($this->baseurl . '/media/jui/js/jquery-noconflict.js');
$doc->addScript($this->baseurl . '/media/jui/js/jquery-migrate.min.js');
$doc->addScript('templates/' . $this->template . '/js/popper.min.js');
$doc->addScript('templates/' . $this->template . '/js/bootstrap.min.js');
$doc->addScript('templates/' . $this->template . '/js/main.js');

if (isset($doc->_scripts[$this->baseurl . '/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js'])) {
  unset($doc->_scripts[$this->baseurl . '/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']);
  $doc->addScript($this->baseurl . '/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js');
}
?><?php

//print_r($doc->_scripts);
/*
$doc->addScript($this->baseurl.'/media/jui/js/jquery.min.js');
$doc->addScript($this->baseurl.'/media/jui/js/jquery-noconflict.js');
$doc->addScript($this->baseurl.'/media/jui/js/jquery-migrate.min.js');  
$doc->addScript('templates/'.$this->template.'/js/bootstrap.min.js');
$doc->addScript('templates/'.$this->template.'/js/main.min.js');
*/

$doc->setGenerator('Binnakle');
if (JRequest::getInt('Itemid') == 101) {
  $doc->addCustomTag('<link rel="canonical" href="https://www.binnakle.com"/> ');
}elseif (JRequest::getInt('Itemid') == 123) {
  $doc->addCustomTag('<link rel="canonical" href="https://www.binnakle.com/en"/> ');
}


$lang = substr( JRequest::getVar('lang','es') , 0, 2);


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo $this->baseurl . '/images/favicon.png' ?>">
  <link rel="shortcut icon" href="<?php echo $this->baseurl . '/images/favicon.png' ?>">
  <link rel="apple-touch-icon" href="<?php echo $this->baseurl . '/images/favicon.png' ?>">
  <jdoc:include type="head" />
  <link rel="stylesheet" href="<?php echo 'templates/' . $this->template . '/css/bootstrap.min.css'; ?>">

  <link rel="stylesheet" href="<?php echo 'templates/' . $this->template . '/css/style.css'; ?>">

  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <?php









  ?>
  <!--[if lt IE 9]>
      <script src="<?php echo 'templates/' . $this->template . '/js/html5shiv.min.js'; ?>"></script>
      <script src="<?php echo 'templates/' . $this->template . '/js/respond.min.js'; ?>"></script>
<![endif]-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
  if (JRequest::getVar('option') != 'com_properties') {
    $doc->addCustomTag('<meta property="og:type" content="website" /> ');
    $doc->addCustomTag('<meta property="og:url" content="' . JURI::current() . '" />');
    $doc->addCustomTag('<meta property="og:title" content="Binnakle." />');
    $doc->addCustomTag('<meta property="og:image" content="http://www.binnakle.com/images/logo.png" />');
    $doc->addCustomTag('<meta property="og:description" content="Juego Binnakle" />');
  }
  ?>

</head>
<?php if (!$detectmobilebrowser) {
  $detectmobilebrowserBody = 'nomobilebrowserbody';
} else {
  $detectmobilebrowserBody = 'mobilebrowserbody';
} ?>
<body class="tmpl-component">
	
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	
</body>
</html>
