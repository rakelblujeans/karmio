<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?> <style type="text/css">
 
/* Set the font for all of the elements */
 form#user-form ul {
	list-style-type:none;
	padding:0;
	margin:0;
}

form#user-form ul li {
	position:relative;
}
/* Make our title a bit bigger */
form#user-form div.title {
	font-size:24px;
	font-weight:bold;
	margin-bottom:10px;
}
/* Give our input fields a fixed width and a bit of padding */
form.login input[type='password'] {
	width:280px;
	padding:5px;
	margin-bottom:10px;
}
/* Position the labels inside our input fields. */
form#user-form label {
	 color: #878888;
    font-size: 22px;
    left: 9px;
    position: absolute;
     padding-top: 9px;
}
</style> 
 <script language="javascript">
$(document).ready(function(){
 
	// Find each of our input fields
	var fields = $("form#user-form input[type='password']");
 
	// If a field gets focus then hide the label
	// (which is the previous element in the DOM).
	fields.focus(function(){
		$(this).prev().hide();
	});
 
	// If a field loses focus and nothing has
	// been entered in the field then show the label.
	fields.blur(function(){
		if (!this.value) {
			$(this).prev().show();
		}
	});
 
	// If the form is pre-populated with some values
	// then immediately hide the corresponding labels. 
	fields.each(function(){
		if (this.value) {
			$(this).prev().hide();
		}
	});
 
});
 
</script>
<div class="signup" id="signup">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>
	<input type="hidden" value="signupBuyer" />
	<div class="signuppopup">
    <div class="signhead">  Signup As a Vendor</div><br />
	<div  class="signupleft"><a href="javascript:fancyLoad('<?php echo CController::createUrl('user/signupBuyer')?>', 'signup');"><img src="images/checkbox.png" /></a></div><div class="signuplright"><a href="javascript:fancyLoad('<?php echo CController::createUrl('user/signupBuyer')?>', 'signup');">Me</a></div>
	</div><p>&nbsp;<br /></p>
	<div class="newsignup">

	<?php echo $form->errorSummary(array($store, $model)); ?>

	<?php echo $form->textField($store,'name',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Business Name')this.value='';", 'onblur'=>"if(this.value=='')this.value='Business Name';")); ?>
	<?php echo $form->error($store,'name'); ?>

	<?php echo $form->textField($store,'website',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='http://')this.value='';", 'onblur'=>"if(this.value=='')this.value='http://';")); ?>
	<?php echo $form->error($store,'website'); ?>

	<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Email Address')this.value='';", 'onblur'=>"if(this.value=='')this.value='Email Address';")); ?>
	<?php echo $form->error($model,'email'); ?>
<ul>
	<li>
	<label for="password">Password</label>
		
	<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>90,)); ?>
	<?php echo $form->error($model,'password'); ?>
	</li><li>
	<label for="rpassword">Confirm Password</label>
	<?php echo $form->passwordField($model,'password_repeat',array('size'=>32,'maxlength'=>90, 'id'=>"password_repeat",)); ?>
	<?php echo $form->error($model,'password_repeat'); ?>
	</li>
	</ul>
	<?php echo $form->textField($store,'address',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Address')this.value='';", 'onblur'=>"if(this.value=='')this.value='Address';")); ?>
	<?php echo $form->error($store,'address'); ?>
	<?php echo $form->textField($store,'address2',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Address2')this.value='';", 'onblur'=>"if(this.value=='')this.value='Address2';")); ?>
	<?php echo $form->error($store,'address2'); ?>

	<?php echo $form->dropDownList($model,'state_id',Location::getStates(),
															array(
															'prompt'=>'Select State',
																'ajax' => array(
																				'type'	=> 'POST',
																				'url' => array('/location/myCitys'),
																				'update'	=> '#User_location_id',
																			),
															)
														); ?>

	<?php
	$dataA=Location::model()->findAll('id=:id',array(':id'=>$model->location_id));
    $t=CHtml::listData($dataA,'id', 'value');
	if(empty($t)){$t=array(''=>'Select City');}
	
	 echo $form->dropDownList($model,'location_id',$t, array(''=>'Select City')); ?>
	<?php echo $form->error($model,'location_id'); ?>

	<?php echo $form->textField($model,'zip',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Zip Code')this.value='';", 'onblur'=>"if(this.value=='')this.value='Zip Code';")); ?>

	<?php echo $form->textField($model,'tax_id',array('size'=>32,'maxlength'=>9, 'onfocus'=>"if(this.value=='Tax id')this.value='';", 'onblur'=>"if(this.value=='')this.value='Tax id';")); ?>
	<?php echo $form->error($model,'tax_id'); ?>
	<?php echo $form->textField($model,'cellphone',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Cellphone')this.value='';", 'onblur'=>"if(this.value=='')this.value='Cellphone';")); ?>
	<?php echo $form->error($model,'cellphone'); ?>
<br />
	example: 0/1(Areacode)number

	<?php echo $form->textField($model,'fname',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='First Name')this.value='';", 'onblur'=>"if(this.value=='')this.value='First Name';")); ?>
	<?php echo $form->error($model,'fname'); ?>

	<?php echo $form->textField($model,'lname',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Last Name')this.value='';", 'onblur'=>"if(this.value=='')this.value='Last Name';")); ?>
	<?php echo $form->error($model,'lname'); ?>

	<?php echo CHtml::ajaxSubmitButton('SignUP', 
											CController::createUrl('/user/signupSeller',array('fbox'=>1)),

											array('success'=>'js: function(data) {
						                        $("#signup").replaceWith(data);
												updateWidthFancy();
                							}')); ?>
                							
     <a href="index.php" style="text-decoration:none;"><div id="cancled">Cancel</div></a>
</div>
<?php $this->endWidget(); ?>
</div>
