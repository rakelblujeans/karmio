<?php

$this->breadcrumbs=array(

	'User Stores'=>array('index'),

	'Create',

);


 
$this->menu=array(

	array('label'=>'List UserStore', 'url'=>array('index')),

	array('label'=>'Manage UserStore', 'url'=>array('admin')),

);

?>







<?php echo $this->renderPartial('_form', array('model'=>$model, 'msg' => $msg)); ?>

