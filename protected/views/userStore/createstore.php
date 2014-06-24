<?php //$this->beginContent('//layouts/fbox');
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?>

<div id="postdealrow">
<p style=" color:#FFFFFF">In order to post a deal, you must add a store/Business</p>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userstore-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="postdealrow">
	<?php echo $form->errorSummary(array($model, $model)); ?>
</div><!--postdealrow-->


<div id="postdealrow">
 <div class="rowleft">
<div class="heading">Business Name</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
	<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Business Name')this.value='';", 'onblur'=>"if(this.value=='')this.value='Business Name';")); ?>
	<?php echo $form->error($model,'name'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
 <div class="rowleft">
<div class="heading">Address</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
	<?php echo $form->textField($model,'address',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Address')this.value='';", 'onblur'=>"if(this.value=='')this.value='Address';")); ?>
	<?php echo $form->error($model,'address'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


<div id="postdealrow">
 <div class="rowleft">
<div class="heading">Address 2</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
	<?php echo $form->textField($model,'address2',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='Address2')this.value='';", 'onblur'=>"if(this.value=='')this.value='Address2';")); ?>
	<?php echo $form->error($model,'address2'); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->



<div id="postdealrow">
 <div class="rowleft">
<div class="heading">State</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
<?php echo CHtml::dropDownList('state_id','', Location::getStates(),
															array(
															'prompt'=>'Select State',
																'ajax' => array(
																				'type'	=> 'POST',
																				'url' => array('/location/myCitys2'),
																				'update'	=> '#UserStore_location_id',
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
<div class="heading">Zip Code</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
	<?php echo $form->textField($model,'zip',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Zip Code')this.value='';", 'onblur'=>"if(this.value=='')this.value='Zip Code';")); ?>

</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


<div id="postdealrow">
 <div class="rowleft">
<div class="heading">Cellphone</div>
<div class="headingdetail"></div>

</div><!--rowleft-->
<div class="rowcenter">
<div class="titlemain"></div>
<div class="titlemaindiv">
	<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>90, 'onfocus'=>"if(this.value=='Phone')this.value='';", 'onblur'=>"if(this.value=='')this.value='Phone';")); ?>
	<?php echo $form->error($model,'cellphone'); ?>
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
<?php echo CHtml::submitButton($model->isNewRecord ? 'Add Store' : 'Save',array('class'=>'signupbun')); ?>
</div>
<br />
<div class="dottedline"></div>
</div><!--rowcenter-->
<div class="rowright"></div><!--rowright-->

</div><!--postdealrow-->


<?php $this->endWidget(); ?>
