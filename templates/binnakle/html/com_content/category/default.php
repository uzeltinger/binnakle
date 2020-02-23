

<?php
JHtml::_('behavior.modal', 'a.galery-modal');
/*
echo '<pre>';
print_r($this->items);
echo '</pre>';
*/

if($this->category->id == 12){
    echo $this->loadTemplate('galeria'); 
}
if($this->category->id == 11){
    echo $this->loadTemplate('medios'); 
}
if($this->category->id == 16){
    echo $this->loadTemplate('galeria'); 
}
if($this->category->id == 17){
    echo $this->loadTemplate('medios'); 
}
/*
echo '<pre>';
print_r($this->category);
echo '</pre>';
*/
?>