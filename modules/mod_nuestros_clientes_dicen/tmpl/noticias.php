<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="lista-noticias noticias">
    <div class="container">
        <div class="row">
<?php 
$x=0;
foreach ($list as $item) : 	
	$text = $item->introtext;
	$title = $item->title;
    echo "
    <div class=\"col-12 col-sm-6 col-md-4\">    
        <div class=\"noticia\">
            <div class=\"contenido\">        
                $text
            </div>
            <div class=\"epigrafe\">
                $title
            </div>
        </div>
	</div>";
	$x++;
?>
<?php 
endforeach; 
?>
        </div>
    </div>
</div>