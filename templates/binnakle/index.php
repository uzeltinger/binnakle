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

<body class="<?php echo $detectmobilebrowserBody; ?> body-itemid-<?php echo JRequest::getInt('Itemid'); ?>">
  
  <div id="dimensions" style="position:fixed; z-index:99999000; background-color:#fff;"></div>


  <div class="top-header">
    <div class="container">
      <div class="cabecera">
      <?php if ($this->countModules('lenguaje')) : ?>
        <div class="flag">
          <jdoc:include type="modules" name="lenguaje" style="xhtml" />
        </div>
      <?php endif; ?>
        <!--<div class="flag"><a href="<?php if( $this->language == 'es-es'){ echo './en';}else{ echo './es';} ?>">
          <img src="./images/flag-<?php echo $this->language ; ?>.png"></a>
        </div>-->
        <div class="redes">
          <div class="red"><a target="blank_" href="https://www.facebook.com/Binnakle-Innovation-Games-387805865132957/?modal=admin_todo_tour"><span class="fab fa-facebook-f"></span></a></div>
          <div class="red"><a target="blank_" href="https://twitter.com/IntCreativa"><span class="fab fa-twitter"></span></a></div>
          <div class="red"><a target="blank_" href="https://www.youtube.com/channel/UCDiBAhZX0_bmH4u3PudoZqw?view_as=subscriber"><span class="fab fa-youtube"></span></a></div>
          <div class="red"><a target="blank_" href="https://www.instagram.com/binnakle_seriousgames/"><span class="fab fa-instagram"></span></a></div>
        </div>
        <div class="top-link-contacto"><a href="<?php echo $lang=='en'?'/en/contact.html':'/es/contacto.html';?>"><?php echo JText::_('BINNAKLE_CONTACTO');?></a></div>

        <div class="link-juegos link-juegos-mobile">
          <div class="nuestro-serius-game-mobile">
            <a class="juego_theexpedition_open_submenu link-juego <?php if (JRequest::getInt('Itemid') == 108) { echo ' active'; } ?>" 
            href="<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>">BINNAKLE<br>THE EXPEDITION</a>
            <ul class="serious-games-submenu dropdown-menu juego_theexpedition_submenu">
              <li class="nav-item item-conocer"><a href="<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_CONOCER');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/buy-binnakle-the-expedition.html':'/es/comprar-binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_COMPRAR');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/play-binnakle-the-expedition.html':'/es/jugar-binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_JUGAR');?></a></li>
            </ul>
          </div>
          

          <div class="nuestro-serius-game-mobile last">
            <a class="juego_mission0_open_submenu link-juego link-juego-last <?php if (JRequest::getInt('Itemid') == 109) {
                                                                                echo ' active';
                                                                              } ?>" href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>">BINNAKLE<br>MISSION 0</a>
            <ul class="serious-games-submenu dropdown-menu juego_mission0_submenu">
              <li class="nav-item item-conocer"><a href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_CONOCER');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/buy-binnakle-mission-0.html':'/es/comprar-binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_COMPRAR');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/play-binnakle-mission-0.html':'/es/jugar-binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_JUGAR');?></a></li>
          </div>
        </div>

        <div class="link-juegos-tablet">
          <a class="juego_theexpedition_open_submenu link-juego <?php if (JRequest::getInt('Itemid') == 108) {
                                                                  echo ' active';
                                                                } ?>" href=".<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>">BINNAKLE<br>THE EXPEDITION</a>
          <ul class="serious-games-submenu dropdown-menu juego_theexpedition_submenu">
            <li class="nav-item item-conocer"><a href="<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_CONOCER');?></a></li>
            <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/buy-binnakle-the-expedition.html':'/es/comprar-binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_COMPRAR');?></a></li>
            <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/play-binnakle-the-expedition.html':'/es/jugar-binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_JUGAR');?></a></li>
          </ul>
          <a class="juego_mission0_open_submenu link-juego link-juego-last <?php if (JRequest::getInt('Itemid') == 109) {
                                                                              echo ' active';
                                                                            } ?>" href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>">BINNAKLE<br>MISSION 0</a>
          <ul class="serious-games-submenu dropdown-menu juego_mission0_submenu">
            <li class="nav-item item-conocer"><a href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_CONOCER');?></a></li>
            <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/buy-binnakle-mission-0.html':'/es/comprar-binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_COMPRAR');?></a></li>
            <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/play-binnakle-mission-0.html':'/es/jugar-binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_JUGAR');?></a></li>
        </div>

        <div class="link-juegos-descktop">
          <div class="nuestros-serius-games"><?php echo JText::_('BINNAKLE_NUESTROS_SERIOUS_GAMES');?></div>
          <div class="fondo-diagonal"></div>
          <div class="nuestro-serius-game">
            <a class="link-juego link-juego-theexpedition <?php if (JRequest::getInt('Itemid') == 108) {
                                                            echo ' active';
                                                          } ?>" href="<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>">BINNAKLE <br>THE EXPEDITION</a>
            <ul class="serious-games-submenu dropdown-menu">
              <li class="nav-item item-conocer"><a href="<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_CONOCER');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/buy-binnakle-the-expedition.html':'/es/comprar-binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_COMPRAR');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/play-binnakle-the-expedition.html':'/es/jugar-binnakle-the-expedition.html';?>"><?php echo JText::_('BINNAKLE_JUGAR');?></a></li>
            </ul>
          </div>
          <div class="nuestro-serius-game">
            <a class="link-juego link-juego-last link-juego-theexpedition <?php if (JRequest::getInt('Itemid') == 109) {
                                                                            echo ' active';
                                                                          } ?>" href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>">BINNAKLE <br>MISSION 0</a>
            <ul class="serious-games-submenu dropdown-menu">
              <li class="nav-item item-conocer"><a href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_CONOCER');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/buy-binnakle-mission-0.html':'/es/comprar-binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_COMPRAR');?></a></li>
              <li class="nav-item item-112"><a href="<?php echo $lang=='en'?'/en/play-binnakle-mission-0.html':'/es/jugar-binnakle-mission-0.html';?>"><?php echo JText::_('BINNAKLE_JUGAR');?></a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <header id="header" class="header">
    <nav class="navbar navbar-expand-md navbar-light container-menu-all">
      <div class="container">
        <a class="navbar-brand" href="<?php if( $this->language == 'es-es'){ echo './es';}else{ echo './en';} ?>">
          <img class="navbar-logo" src="../images/navbar-logo.jpg" alt="Binnakle logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <jdoc:include type="modules" name="navmenu" />
        </div>
      </div>
    </nav>
  </header>

  <?php if ($this->countModules('topcarousel')) : ?>
    <div class="position_topcarousel">
      <jdoc:include type="modules" name="topcarousel" style="xhtml" />
    </div>
  <?php endif; ?>


  <?php if ($this->countModules('topsearch')) : ?>
    <div class="position_topsearch">
      <jdoc:include type="modules" name="topsearch" style="xhtml" />
    </div>
  <?php endif; ?>

  <?php if ($this->countModules('topfeatured')) : ?>
    <div class="position_topfeatured">
      <div class="container">
        <jdoc:include type="modules" name="topfeatured" style="xhtml" />
      </div>
    </div>
  <?php endif; ?>




  <jdoc:include type="message" />

  <div class="main_container main_container-itemid-<?php echo JRequest::getInt('Itemid'); ?>">

    <?php if ($this->countModules('left')) { ?>
      <div class="position_left">
        <div class="container">
          <jdoc:include type="modules" name="left" style="xhtml" />
        </div>
      </div>
    <?php } ?>

    <?php
    if ($this->countModules('left')) {
      $showLeft = true;
    } else {
      $showLeft = false;
    }
    if ($this->countModules('right')) {
      $showRight = true;
    } else {
      $showRight = false;
    }
    $contentClass = ' ';
    if ($showRight) {
      $contentClass = 'col-xs-12 col-sm-12  col-md-8';
    }
    if ($showLeft) {
      $contentClass = 'col-xs-12 col-sm-12  col-md-8';
    }
    ?>
    <?php if (JRequest::getInt('Itemid') == 101 || JRequest::getInt('Itemid') == 123) : ?>

    <?php else : ?>

      <div class="main_content <?php echo $contentClass; ?>">
        <div class="position_component">
          <jdoc:include type="component" />
        </div>

      <?php endif; ?>

      <?php if ($this->countModules('right')) { ?>
        <div class="sidebar sidebar-right col-xs-12 col-sm-12  col-md-4 ">
          <jdoc:include type="modules" name="right" style="xhtml" />
        </div>
      <?php   } ?>

    </div> <!--	container	-->

    <?php if ($this->countModules('bottom-content')) : ?>
      <div class="bottom-content">
        <jdoc:include type="modules" name="bottom-content" style="raw" />
      </div>
    <?php endif; ?>

    <?php if ($this->countModules('bottom')) { ?>
      <div class="bottom">
        <jdoc:include type="modules" name="bottom" style="xhtml" />
      </div>
    <?php   } ?>





    <?php if (JRequest::getInt('Itemid') == 101 || JRequest::getInt('Itemid') == 123) : ?>
   

      <section class="resultados resultados-itemid-101">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center binnakle-combina titulo-seccion"><?php echo JText::_('BINNAKLE_SERIOUS_GAMES_AYUDAN_EMPRESAS');?></h2>
            </div>
          </div>
        </div>
        <div class="resultados-list">
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-15"></div>
              <div class="resultado col-6 col-sm-4 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-sesiones-creativas.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_OPTIMIZAR_SESIONES_CREATIVAS');?></p>
                </div>
              </div>
              <div class="resultado col-6 col-sm-4 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-co-creacion.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_IMPULSAR_CO_CREACION');?></p>
                </div>
              </div>
              <div class="resultado col-6 col-sm-4 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-hackatones-innovacion.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_ANADIR_VALOR_EVENTOS');?></p>
                </div>
              </div>
              <div class="col-12 col-sm-15 d-none d-sm-block"></div>
            
              <div class="resultado col-6 col-sm-3 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-innovacion.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_FOMENTAR_INNOVACION');?></p>
                </div>
              </div>
              <div class="resultado col-6 col-sm-3 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-cultura.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_FORMAR_EN_CULTURA');?></p>
                </div>
              </div>
              <div class="resultado col-6 col-sm-3 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-detectar-perfiles.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_DETECTAR_PERFILES');?></p>
                </div>
              </div>
              <div class="resultado col-6 col-sm-3 col-lg-3">
                <div class="imagen"><img src="images/iconos/icon-alinear.png"></div>
                <div class="bajada">
                  <p><?php echo JText::_('BINNAKLE_ALINEAR_VISION');?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="combina">
        <div class="container-fluid">
        </div>
        <div class="container-fluid combina-content">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center binnakle-combina titulo-seccion"><?php echo JText::_('BINNAKLE_BINNAKLE_COMBINA');?></h2>
            </div>
          </div>
          <div class="row">
            <div class="col-5 d-none d-lg-block">
              <p><?php echo JText::_('BINNAKLE_METODOLOGIA_CONTRASTADA');?></p>
            </div>
            <div class="col-2 d-none d-lg-block">
              <p class="text-center">+</p>
            </div>
            <div class="col-5 d-none d-lg-block">
              <p><?php echo JText::_('BINNAKLE_BENEFICIOS_GAMIFICACION');?></p>
            </div>
          </div>
          <div class="row valign-center">
            <div class="col-12 col-lg-7 col-xl-6">
              <p class="text-center d-lg-none"><?php echo JText::_('BINNAKLE_METODOLOGIA_CONTRASTADA');?></p>
              <div class="image-combina-left">
              <?php if( $this->language == 'es-es'){ echo '<img class="img-fluid" src="images/funnel-innovacion-binnakle.png">';}else{ echo '<img class="img-fluid" src="images/funnel.png">';} ?>
              
              </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-6">
              <p class="text-center d-lg-none">+</p>
              <p class="text-center d-lg-none"><?php echo JText::_('BINNAKLE_BENEFICIOS_GAMIFICACION');?></p>
              <div class="image-combina-right">
                <?php if( $this->language == 'es-es'){ echo '<img class="img-fluid" src="images/beneficios-gamificacion.png">';}else{ echo '<img class="img-fluid" src="images/gamification-benefits.png">';} ?>
              </div>
              
            </div>
          </div>
        </div>
      </section>

      

      <section class="home-footer">
        <h2 class="text-center footer-title titulo-seccion"><?php echo JText::_('BINNAKLE_NUESTROS_SERIOUS_GAMES');?></h2>

        <div class="footer-juegos-mobile d-lg-none">
          <div class="container-fluid container-juego-left">
            <div class="row row-juegos">
              <div class="col-4"></div>
              <div class="col-8">
                <div class="juego juego-left">
                  <div class="logo-footer">
                  <?php if( $this->language == 'es-es'){ echo '<img class="logo" src="images/footer/logo-footer-the-expedition.png">';}else{ echo '<img class="logo" src="images/footer/logo-footer-the-expedition-en.png">';} ?>
                    
                  </div>
                  <div class="bajada-footer">
                    <?php echo JText::_('BINNAKLE_PODRAS_ENCONTRAR_SOLUCIONES');?>
                  </div>
                  <a href="/binnakle-the-expedition.html" class="footer-button orange"><?php echo JText::_('BINNAKLE_CONOCER_EXCLAMACION');?></a>
                  <div class="botones">
                    <a href="/comprar-binnakle-the-expedition.html" class="footer-button green"><?php echo JText::_('BINNAKLE_COMPRAR');?></a>
                    <a href="/jugar-binnakle-the-expedition.html" class="footer-button green"><?php echo JText::_('BINNAKLE_JUGAR_PARTIDA');?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid container-juego-right">
            <div class="row row-juegos">
              <div class="col-8">
                <div class="juego juego-right">
                  <div class="logo-footer">

                    <?php if( $this->language == 'es-es'){ echo '<img class="logo" src="images/footer/logo-footer-mission-0.png">';}else{ echo '<img class="logo" src="images/footer/logo-footer-mission-0-en.png">';} ?>
                  </div>
                  <div class="bajada-footer">
                  <?php echo JText::_('BINNAKLE_PODRAS_TRANSFORMAR_PROBLEMATICAS');?>
                  </div>
                  <a href="/binnakle-mission-0.html" class="footer-button orange"><?php echo JText::_('BINNAKLE_CONOCER_EXCLAMACION');?></a>
                  <div class="botones">
                    <a href="/comprar-binnakle-mission-0.html" class="footer-button green"><?php echo JText::_('BINNAKLE_COMPRAR');?></a>
                    <a href="/jugar-binnakle-mission-0.html" class="footer-button green"><?php echo JText::_('BINNAKLE_JUGAR_PARTIDA');?></a>
                  </div>
                </div>
              </div>
              <div class="col-4"></div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">

                <div class="footer-info">
                  <h3><?php echo JText::_('BINNAKLE_COMO_PUEDO_IMPLEMENTAR');?></h3>
                  <p><?php echo JText::_('BINNAKLE_COMPRANDO_PARTIDAS_ONLINE');?></p>
                  <p><?php echo JText::_('BINNAKLE_FORMANDO_FACILITADORES_INTERNOS');?></p>
                  <p><?php echo JText::_('BINNAKLE_CONTRATANDO_PARTNERS_OFICIALES');?></p>
                </div>

              </div>

            </div>
          </div>
        </div>

        <div class="footer-fondos d-none d-lg-block">
          <div class="container">
            <div class="row row-juegos">
              <div class="col-lg-1 d-md-none d-lg-block"></div>
              <div class="col-lg-5 col-md-12">
                <div class="juego juego-left">
                  <div class="logo-footer">
                  <?php if( $this->language == 'es-es'){ echo '<img class="logo" src="images/footer/logo-footer-the-expedition.png">';}else{ echo '<img class="logo" src="images/footer/logo-footer-the-expedition-en.png">';} ?>
                  </div>
                  <div class="bajada-footer">
                    <?php echo JText::_('BINNAKLE_PODRAS_ENCONTRAR_SOLUCIONES');?>
                  </div>
                  <div class="botones">
                    <div class="boton">
                      <a href="<?php echo $lang=='en'?'/en/binnakle-the-expedition.html':'/es/binnakle-the-expedition.html';?>" class="footer-button orange"><?php echo JText::_('BINNAKLE_CONOCER_EXCLAMACION');?></a>
                    </div>
                    <div class="boton">
                      <a href="<?php echo $lang=='en'?'/en/buy-binnakle-the-expedition.html':'/es/comprar-binnakle-the-expedition.html';?>" class="footer-button green"><?php echo JText::_('BINNAKLE_COMPRAR');?></a>
                      <a href="<?php echo $lang=='en'?'/en/play-binnakle-the-expedition.html':'/es/jugar-binnakle-the-expedition.html';?>" class="footer-button green"><?php echo JText::_('BINNAKLE_JUGAR_PARTIDA');?></a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-5  col-md-12">
                <div class="juego juego-right">
                  <div class="logo-footer">
                  <?php if( $this->language == 'es-es'){ echo '<img class="logo" src="images/footer/logo-footer-mission-0.png">';}else{ echo '<img class="logo" src="images/footer/logo-footer-mission-0-en.png">';} ?>
                  </div>
                  <div class="bajada-footer">
                    <?php echo JText::_('BINNAKLE_PODRAS_TRANSFORMAR_PROBLEMATICAS');?>
                  </div>
                  <div class="botones">
                    <div class="boton">
                      <a href="<?php echo $lang=='en'?'/en/binnakle-mission-0.html':'/es/binnakle-mission-0.html';?>" class="footer-button orange"><?php echo JText::_('BINNAKLE_CONOCER_EXCLAMACION');?></a>
                    </div>
                    <div class="boton">
                      <a href="<?php echo $lang=='en'?'/en/buy-binnakle-mission-0.html':'/es/comprar-binnakle-mission-0.html';?>" class="footer-button green"><?php echo JText::_('BINNAKLE_COMPRAR');?></a>
                      <a href="<?php echo $lang=='en'?'/en/play-binnakle-mission-0.html':'/es/jugar-binnakle-mission-0.html';?>" class="footer-button green"><?php echo JText::_('BINNAKLE_JUGAR_PARTIDA');?></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 d-md-none d-lg-block"></div>

            </div>
            <div class="row">
              <div class="col-12">
                <div class="footer-info">
                  <h3><?php echo JText::_('BINNAKLE_COMO_PUEDO_IMPLEMENTAR');?></h3>
                  <p><?php echo JText::_('BINNAKLE_COMPRANDO_PARTIDAS_ONLINE');?></p>
                  <p><?php echo JText::_('BINNAKLE_FORMANDO_FACILITADORES_INTERNOS');?></p>
                  <p><?php echo JText::_('BINNAKLE_CONTRATANDO_PARTNERS_OFICIALES');?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>


      <section class="clientes">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center titulo-seccion"><?php echo JText::_('BINNAKLE_NUESTROS_CLIENTES_DICEN');?></h2>
            </div>
          </div>
          <div class="clientes-carousel">
            <div id="carouselClientesHome" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php if ($this->countModules('nuestros_clientes_dicen')) : ?>

                  <jdoc:include type="modules" name="nuestros_clientes_dicen" style="raw" />

                <?php endif; ?>
              </div>
              <a class="carousel-control carousel-control-prev" href="#carouselClientesHome" role="button" data-slide="prev">
                <i class="fa fa-chevron-left"></i>
              </a>
              <a class="carousel-control carousel-control-next" href="#carouselClientesHome" role="button" data-slide="next">
                <i class="fa fa-chevron-right"></i>
              </a>
            </div>
          </div>

        </div>
      </section>

      <section class="explicanos-tus-retos">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center titulo-seccion"><?php echo JText::_('BINNAKLE_CONTACTA_CON_NOSOTROS');?></h2>
            </div>
          </div>
        </div>
      </section>

    <?php endif; ?>

<?php if ($this->countModules('contacto')) : ?>

  <jdoc:include type="modules" name="contacto" style="raw" />

<?php endif; ?>


    <section class="footer">
      <div class="footer-bottom">
        <p>@Binnakle Innovation Games 2018</p>
        <ul>
          <li>
            <a href="/aviso-legal-y-politica-de-privacidad.html"><?php echo JText::_('BINNAKLE_AVISO_LEGAL');?></a>
          </li>
          <li class="separador">|</li>
          <li>
            <a href="/politica-de-cookies.html"><?php echo JText::_('BINNAKLE_POLITICA_DE_COOKIES');?></a>
          </li>
        </ul>
      </div>
    </section>

    <button onclick="topFunction()" id="goTop" class="goTop" title="Go to top">
      <span class="fa fa-angle-up"></span>
    </button>

    <?php require('analyticstracking.php'); ?>
    <div class="modal fade menuvideo" id="bootstrap-modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div id="demo-modal">
<?php if( $this->language == 'es-es'){?>
            <iframe class="iframe-video" width="100%" height="500" src="https://www.youtube.com/embed/zzqq1mvSeqw?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope" allowfullscreen></iframe>
<?php }else{ ?>
            <iframe class="iframe-video" width="100%" height="500" src="https://www.youtube.com/embed/VLjl1Ep6kwc?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope" allowfullscreen></iframe>
<?php } ?>
          </div>
        </div>
      </div>
    </div>


<?php if( $this->language == 'es-es'){?>

<?php }else{ ?>

<?php } ?>

</body>

</html>

              