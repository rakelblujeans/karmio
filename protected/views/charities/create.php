<?php
$this->breadcrumbs=array(
	'Charities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Charities', 'url'=>array('index')),
	array('label'=>'Manage Charities', 'url'=>array('admin')),
);
?>

<h1>Create Charities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>