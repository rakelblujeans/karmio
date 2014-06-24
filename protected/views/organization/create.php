<?php
$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Organization', 'url'=>array('admin')),
);
?>
<h1 align="right"><a href="<?php echo CController::createUrl('/seller/dashboard'); ?>"><img src="images/backtoad.jpg" /></a></h1>
<h1><img src="images/nonpro.jpg" /></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>