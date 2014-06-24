<?php
$this->breadcrumbs=array(
	'User Stores'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserStore', 'url'=>array('index')),
	array('label'=>'Create UserStore', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-store-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="postdealrow">

<?php $this->renderPartial('/seller/admin_menu');?>

</div>
<h1>Manage User Stores</h1>

<p>
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-store-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id' =>array('name' => 'user_id', 'value' => '$data->user->fullName'),
		'name',
		'phone',
		'address',
		'zip',
		'is_verified' => array('name' => 'is_verified', 'header' => 'Status', 'value' => '($data->is_verified == 0)?"Not Approved ":"Approved"'),
		array('header' => 'action', 'value' => '($data->is_verified == 1)?CHtml::link("create_deal", Yii::app()->createAbsoluteUrl("product/create", array("uid" => $data->user_id)) )."/".CHtml::link("reject", Yii::app()->createAbsoluteUrl("userStore/denyStore", array("id" => $data->id)) ):CHtml::link("approve", Yii::app()->createAbsoluteUrl("userStore/approveStore", array("id" => $data->id)) )."/".CHtml::link("reject", Yii::app()->createAbsoluteUrl("userStore/denyStore", array("id" => $data->id)) )', 'type' => 'raw'),
		/*
		'location_id',
		*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{delete}',
		),
	),
)); ?>
