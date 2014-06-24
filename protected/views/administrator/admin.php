<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="postdealrow">
<div class="dashboardLinks">
<?php if(isset(Yii::app()->user->isAdmin))
{ ?>
	<a href="<?php echo CController::createUrl('/user/admin'); ?>">User</a>
<?php echo ' | '; }?>
<?php if(isset(Yii::app()->user->isAdmin))
{ ?>
	<a href="<?php echo CController::createUrl('/seller/dashboard'); ?>">Dashboard</a>
<?php  echo ' | ';}?>
<?php if(isset(Yii::app()->user->isAdmin))
{?>
	<a href="<?php echo CController::createUrl('/userPurchase/admin'); ?>">Deal Purchase List</a>
<?php }?>
<?php if(isset(Yii::app()->user->isBuyer))
{ echo ' | ';?>
	<a href="<?php echo CController::createUrl('/user/buyersDashboard'); ?>">Purchase Details</a>
<?php }?>
<?php if(isset(Yii::app()->user->isSeller))
{
	echo ' | ';
?>
	<a href="<?php echo CController::createUrl('/seller'); ?>">Sales Details</a>
<?php }?>
<?php if(isset(Yii::app()->user->isAdmin))
{  echo ' | ';?>
	<a href="<?php echo CController::createUrl('/administrator/admin'); ?>">FAQs</a>
<?php }?>
</div>
</div>
<div id="postdealrow">
<div class="current-deals"><div class="t-deal">Manage FAQs</div></div><br />
</div>
<div id="postdealrow">
<a href="<?php echo CController::createUrl('/administrator/create'); ?>"><img src="images/anew.png" /></a>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
</div>
<div id="postdealrow">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'faq-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'question',
		'answer',
		 array(
            'name' => 'status',
            'type' => 'raw',
            'value' => 'CHtml::link($data->status,Yii::app()->createUrl("administrator/status", array("id"=>$data->id)))'
        ),
		'createdon',
		'Action'=>array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>