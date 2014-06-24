<?php
$this->breadcrumbs=array(
	'Charities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Charities', 'url'=>array('index')),
	array('label'=>'Create Charities', 'url'=>array('create')),
	array('label'=>'View Charities', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Charities', 'url'=>array('admin')),
);
?>

<h1>Update Charities <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>