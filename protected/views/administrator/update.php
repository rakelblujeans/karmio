<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>

<?php echo $this->renderPartial('create', array('model'=>$model)); ?>
