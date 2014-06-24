 <div class="form">
 <?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>
 <div id="postdealrow">

<?php echo $form->errorSummary($model); ?>
<?php echo $form->hiddenField($model,'fbId'); ?>
</div>
  <div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'fname'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">

		<?php echo $form->textField($model,'fname',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'fname'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->

 <div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'lname'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->textField($model,'lname',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'lname'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


 <div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'email'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->

 <div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'zip'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">

		<?php echo $form->textField($model,'zip',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'zip'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


 <div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'State'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
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
															
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



 <div id="postdealrow">
 <div class="rowleft">
<div class="heading">City</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">

		<?php echo $form->dropDownList($model,'location_id', array(''=>'Select City')); ?>
		<?php echo $form->error($model,'location_id'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'password'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">

		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'password'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'password_repeat'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->passwordField($model,'password_repeat',array('size'=>32,'maxlength'=>90)); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'cellphone'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->textField($model,'cellphone',array('size'=>32,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cellphone'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'phone'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'phone'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


<div id="postdealrow">
 <div class="rowleft">
<div class="heading"><?php echo $form->labelEx($model,'address'); ?></div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">

		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>37)); ?>
		<?php echo $form->error($model,'address'); ?>
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
<?php echo CHtml::submitButton($model->isNewRecord ? 'Sign Up' : 'Save',array('class'=>'signupbun')); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


<?php $this->endWidget(); ?>


</div>

