<?php
$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Organization', 'url'=>array('index')),
	array('label'=>'Create Organization', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('organization-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Organizations</h1>

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'organization-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'status',
		'slogon',
		'url',
		'summary',
		'detail',
		'email',
		'logo',
		/*
		'zipcode',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 

?>

