<?php
$this->breadcrumbs=array(
	'User Purchases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserPurchase', 'url'=>array('index')),
	array('label'=>'Manage UserPurchase', 'url'=>array('admin')),
);
?>

<h1>Create UserPurchase</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>