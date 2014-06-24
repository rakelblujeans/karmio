<?php
$this->breadcrumbs=array(
	'User Purchases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserPurchase', 'url'=>array('index')),
	array('label'=>'Create UserPurchase', 'url'=>array('create')),
	array('label'=>'View UserPurchase', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserPurchase', 'url'=>array('admin')),
);
?>

<h1>Update UserPurchase <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>