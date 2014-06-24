<?php

/*$this->breadcrumbs=array(

	'Products'=>array('index'),

	$model->name=>array('view','id'=>$model->id),

	'Update',

);



$this->menu=array(

	array('label'=>'List Product', 'url'=>array('index')),

	array('label'=>'Create Product', 'url'=>array('create')),

	array('label'=>'View Product', 'url'=>array('view', 'id'=>$model->id)),

	array('label'=>'Manage Product', 'url'=>array('admin')),

);*/

?>

<?php echo $this->renderPartial('create', array('model'=>$model, 'dd' => $dd)); ?>