<?php //$this->beginContent('//layouts/fbox');

Yii::app()->clientScript->scriptMap['jquery.js'] = false;

 ?>



<div class="signup" id="signup">

<p style="background:none">In order to post a deal, you must add a store</p>

<?php $form=$this->beginWidget('CActiveForm', array(



	'id'=>'userstore-form',
	'enableAjaxValidation'=>false,

)); ?>


	<?php echo $form->errorSummary($model); ?>

<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Business Name')this.value='';", 'onblur'=>"if(this.value=='')this.value='Business Name';")); ?>



	<?php echo $form->error($model,'name'); ?>







	<?php echo $form->textField($model,'website',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='http://')this.value='';", 'onblur'=>"if(this.value=='')this.value='http://';")); ?>



	<?php echo $form->error($model,'website'); ?>







	<?php echo $form->textField($model,'address',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Address')this.value='';", 'onblur'=>"if(this.value=='')this.value='Address';")); ?>



	<?php echo $form->error($model,'address'); ?>



	<?php echo $form->textField($model,'address2',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Address2')this.value='';", 'onblur'=>"if(this.value=='')this.value='Address2';")); ?>



	<?php echo $form->error($model,'address2'); ?>
	
	<?php echo $form->textField($model,'location_id',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='City Name')this.value='';", 'onblur'=>"if(this.value=='')this.value='City Name';")); ?>
	
	<?php echo $form->textField($model,'state_id',array('size'=>32,'maxlength'=>2, 'onfocus'=>"if(this.value=='State')this.value='';", 'onblur'=>"if(this.value=='')this.value='State';")); ?>

	<?php echo $form->textField($model,'zip',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Zip Code')this.value='';", 'onblur'=>"if(this.value=='')this.value='Zip Code';")); ?>



	<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Phone')this.value='';", 'onblur'=>"if(this.value=='')this.value='Phone';")); ?>

	<?php echo $form->error($model,'cellphone'); ?>

<div  id='cancled'><a href="<?php //echo Yii::app()->user->returnUrl; ?>" onclick="closeBox()">Cancel</a></div>&nbsp;&nbsp;&nbsp;

	<?php if($model->isNewRecord) echo CHtml::ajaxSubmitButton('Add Store', 

											CController::createUrl('/userStore/create',array('fbox'=>1)),



											array('success'=>'js: function(data) {

						                        $("#signup").replaceWith(data);

                							}'));
			else echo CHtml::ajaxSubmitButton('Modify', 

											CController::createUrl('/userStore/update',array('id' => $model->id, 'fbox'=>1)),



											array('success'=>'js: function(data) {

						                        $("#signup").replaceWith(data);

                							}'));
			?>



<?php $this->endWidget(); ?>

<script type="text/javascript">
function closeBox()
{
	
	$("#fancybox-overlay").hide();
	$("#fancybox-outer").hide();
	window.location = window.location;
}
</script>