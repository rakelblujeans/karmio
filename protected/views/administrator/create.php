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
<div class="current-deals"><div class="t-deal">Add FAQ</div></div>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'faq-form',

	'enableAjaxValidation'=>false,

));
?>

<div id="postdealrow">
<div class="rowleft">
<div class="heading">Question</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->textArea($model,'question',array('maxlength'=>90, 'class'=>"textarea", 'id'=>"question")); ?>
<?php echo $form->error($model,'question'); ?>

</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


<div id="postdealrow">
<div class="rowleft">
<div class="heading">Answer</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->textArea($model,'answer',array('class'=>"textarea", 'id'=>"answer")); ?><?php echo $form->error($model,'answer'); ?>

</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
<div class="rowleft">
<div class="heading">&nbsp;</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
 <?php if(isset($_GET['id'])){ ?>

	<div id='cancled'><a href="<?php echo Yii::app()->request->urlReferrer; ?>">Cancel</a></div>
	<?php } else { ?>
<?php echo CHtml::submitButton('SAVE!', array('name'=>'inactive', 'class'=>'save', 'value'=>"")); ?>
<?php } ?>
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Publish' : 'Update', array('name'=>'publish', 'class'=>'publish', 'value'=>"")); ?>


</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<?php $this->endWidget(); ?>
