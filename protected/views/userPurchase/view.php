<?php
$this->breadcrumbs=array(
	'User Purchases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserPurchase', 'url'=>array('index')),
	array('label'=>'Create UserPurchase', 'url'=>array('create')),
	array('label'=>'Update UserPurchase', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserPurchase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserPurchase', 'url'=>array('admin')),
);
?>

<h1>View UserPurchase #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'user_id',
		'store_id',
		'invoice_id',
		'transaction_method',
		'transaction_id',
		'transaction_status',
		'consumption_status',
		'expiry_date',
		'collection_date',
		'paid_price',
		'donated',
		'quantity',
	),
)); ?>
