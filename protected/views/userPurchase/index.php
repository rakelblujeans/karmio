<?php
$this->breadcrumbs=array(
	'User Purchases',
);

$this->menu=array(
	array('label'=>'Create UserPurchase', 'url'=>array('create')),
	array('label'=>'Manage UserPurchase', 'url'=>array('admin')),
);
?>

<h1>User Purchases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
