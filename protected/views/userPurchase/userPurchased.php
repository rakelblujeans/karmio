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
<div class="clear"></div>
 <div class="current-deals">
  <div class="t-deal">User Purchased List</div>
 </div>
 <br />
<?php echo CHtml::link('Export List',array('UserPurchase/UserPurchasedExport','id'=>$id)); ?>
 <br />
 <?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_purchased',
	'summaryText'=>'',
)); ?>
<?php

	$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.mapBox',
		'config'=>array(
							'onClosed' => 'js:function(){
												$.ajax({
													type	: "POST",
													cache	: false,
													error	: function() {
														alert("error");
													}
												});

											return true;
											}'
						),
    	)
	);
?>
