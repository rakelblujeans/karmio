<?php
$this->breadcrumbs=array(
	'Charities',
);

$this->menu=array(
	array('label'=>'Create Charities', 'url'=>array('create')),
	array('label'=>'Manage Charities', 'url'=>array('admin')),
);
?>

<h1>Charities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
