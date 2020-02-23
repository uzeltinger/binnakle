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

<?php 
$x=0;
foreach ($list as $item) : 
	$class = "";
	if($x==0){
		$class = " active";
	}
	$text = $item->introtext;
	echo "<div class=\"carousel-item $class\">
		$text
	</div>";
	$x++;
?>
<?php 
endforeach; 
?>