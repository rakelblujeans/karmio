<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>
<br />
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

<div class="clear"></div><br style="clear:both" /><div class="current-deals"><div class="t-deal">View FAQ</div></div><br />

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'answer',
		'status',
	),
)); ?>
