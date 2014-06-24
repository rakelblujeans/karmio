<?php

$this->breadcrumbs=array(

	'User Stores'=>array('index'),

	$model->name=>array('view','id'=>$model->id),

	'Update',

);



$this->menu=array(

	array('label'=>'List UserStore', 'url'=>array('index')),

	array('label'=>'Create UserStore', 'url'=>array('create')),

	array('label'=>'View UserStore', 'url'=>array('view', 'id'=>$model->id)),

	array('label'=>'Manage UserStore', 'url'=>array('admin')),

);

?>



<?php echo $this->renderPartial('_form', array('model'=>$model, 'msg' => $msg)); ?>