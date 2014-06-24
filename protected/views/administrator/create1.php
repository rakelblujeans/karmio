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

<div class="clear"></div><br style="clear:both" /><div class="current-deals"><div class="t-deal">Add FAQ</div></div><br />
<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'faq-form',

	'enableAjaxValidation'=>false,

));
?>
<?php //echo $form->errorSummary($model); ?>

 <div class="add-non" style="width:915px;">
   <div class="part-2">
    <br style="clear:both" />

    <div class="step"> <span>Question</span></div>

	

	<?php echo $form->textArea($model,'question',array('maxlength'=>90, 'class'=>"step-titles", 'id'=>"question")); ?>
<?php echo $form->error($model,'question'); ?>


    <div class="step"> <span>Answer</span> </div>

	<?php echo $form->textArea($model,'answer',array('class'=>"step-titles", 'style'=>"height:180px",'id'=>"answer")); ?><?php echo $form->error($model,'answer'); ?></div>
   <br style="clear:both;" />
</div>
   <br style="clear:both;" />
    <?php if($_GET['id']){ ?>

	<div  class='cancle-button'><a href="<?php echo Yii::app()->request->urlReferrer; ?>">Cancel</a></div>
	<?php } else { ?>
<?php echo CHtml::submitButton('SAVE!', array('name'=>'inactive', 'class'=>'save-button')); ?>
<?php } ?>
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Publish' : 'Update', array('name'=>'publish', 'class'=>'publish-button')); ?>

<?php $this->endWidget(); ?>



