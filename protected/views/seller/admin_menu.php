<div class="dashboardLinks">

<?php if(isset(Yii::app()->user->isAdmin))

{ ?>

	<a href="<?php echo CController::createUrl('/user/admin'); ?>">Users</a>

<?php echo ' | '; }?>

<?php if(isset(Yii::app()->user->isAdmin))

{ ?>
	<a href="<?php echo CController::createUrl('/userStore/admin'); ?>"> Stores </a> |
	<a href="<?php echo CController::createUrl('/charities/admin', array('type' => 'Partner')); ?>"> Partner Charities</a> |
    <!--<a href="<?php //echo CController::createUrl('/charities/admin', array('type' => 'Fav')); ?>"> Fav Charities</a> |-->

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