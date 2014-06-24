<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<style>#contact_form textarea{ width:300px !important;}</style>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
<div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            
            
                    <div id="MainBody2">
                      <div class="CenterAlign">
                      <div class="HundredPercent">
                      
                      <div id="HomePage">
                       <div class="bg-top" ></div>
                       <div class="bg-mid" >
                       <div id="contact_form">
                       
<div class="left">
<?php $this->renderPartial('pages/left_menu'); ?>
</div>

<div class="right">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<?php if(Yii::app()->user->hasFlash('contact')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>
<?php else: ?>
<h3 class="ARegTxt">Contact Us</h3>
<div>

	<?php echo $form->errorSummary($model); ?>
</div>


<label><?php echo $form->labelEx($model,'name'); ?></label>
<div class="for">
<?php echo $form->textField($model,'name',array('class'=>'input')); ?>
</div>



<label><?php echo $form->labelEx($model,'email'); ?></label>
<div class="for">
<?php echo $form->textField($model,'email',array('class'=>'input')); ?>
</div>
<label><?php echo $form->labelEx($model,'subject'); ?></label>
<div class="for">
<?php echo $form->textField($model,'subject',array('class'=>'input')); ?>
</div>
<label><?php echo $form->labelEx($model,'body'); ?></label>
<div class="for">
<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>39)); ?>
</div>

<?php if(CCaptcha::checkRequirements()): ?>
<label><?php echo $form->labelEx($model,'verifyCode'); ?></label>
<div class="for">
<?php $this->widget('CCaptcha'); ?><br />
<?php echo $form->textField($model,'verifyCode', array('class' =>'input')); ?>
		
</div>

<?php endif; ?>
<div>
 
<div class="rowcenter">

<div class="titlemaindiv">
<?php echo CHtml::submitButton('Submit',array('class'=>'signupbun')); ?>
</div>


</div><!--rowcenter-->

</div><!--postdealrow-->
<?php endif; ?>
<?php $this->endWidget(); ?>
</div>


</div>
						</div>
						<div class="bg-bottom" ></div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>