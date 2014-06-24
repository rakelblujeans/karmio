
 <br /><div class="current-deals"><div class="t-deal">FAQs</div></div><br /> 
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_faq',
)); ?>
<?php

$this->widget('ext.slidetoggle.ESlidetoggle',
array(
     'itemSelector' => 'div.collapsible',
     'titleSelector' => 'div.collapsible h3',
     //only the collapsible div container with the class 'closed' is collapsed by default
     'collapsed' => 'div.collapsible.closed', //a subset of the itemSelector
));
 

 
?>
