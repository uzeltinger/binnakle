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
<div id="quedicendenosotros" class="container">
	<div class="row">
<?php 
$x=0;
foreach ($list as $item) : 	
	$text = $item->introtext;
    echo "
        <div class=\"col-12 col-sm-6\">
            <div class=\"comment\">
		        $text
            </div>
	    </div>";
	$x++;
?>
<?php 
endforeach; 
?>
    </div>
</div>
