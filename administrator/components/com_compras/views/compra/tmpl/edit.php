<?php
/**
 * @version		$Id: edit.php 17780 2010-06-20 09:03:02Z dextercowley $
 * @package		Joomla.Administrator
 * @subpackage	com_banners
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

$this->hiddenFieldsets = array();
$this->hiddenFieldsets[0] = 'basic-limited';
$this->configFieldsets = array();
$this->configFieldsets[0] = 'editorConfig';

// Create shortcut to parameters.
$params = $this->state->get('params');

$app = JFactory::getApplication();
$input = $app->input;
$assoc = JLanguageAssociations::isEnabled();

// This checks if the config options have ever been saved. If they haven't they will fall back to the original settings.
$params = json_decode($params);

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'compra.cancel' || document.formvalidator.isValid(document.id('item-form')))
		{
			<?php //echo $this->form->getField('articletext')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_compras&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
	
    <?php //echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
<div class="form-horizontal">    
    <div class="row-fluid form-horizontal-desktop">
		<div class="span12">
			<h3>Detalle</h3>
								 
		<?php 
		print_r($this->item->detalles);
		?>
                
					
		</div>
		<div class="span12">
			<h3>Datos del comprador</h3>
<table class="bordered table">
			<?php 
			//print_r($this->item->comprador);
			$comprador = json_decode($this->item->comprador);
			foreach($comprador as $k=>$v){
				echo '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
			}
			?>
</table>
		</div>
	</div>
</div>



	<input type="hidden" name="task" value="" />
    <input type="hidden" name="return" value="<?php echo $input->getCmd('return'); ?>" />
	<?php echo JHtml::_('form.token'); ?>


<div class="clr"></div>
</form>
