<?php

/*

$this->breadcrumbs=array(

	'Users'=>array('index'),

	'Create',

);



$this->menu=array(

	array('label'=>'List User', 'url'=>array('index')),

	array('label'=>'Manage User', 'url'=>array('admin')),

);

*/

?>



<div id="postdealrow"><h1 style="color: #FFFFFF">SignUp</h1></div>



<?php echo $this->renderPartial('_form_create', array('model'=>$model, 'msg' => $msg)); ?>

