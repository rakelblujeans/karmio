<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-store-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'phone'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'State'); ?>
		<?php echo CHtml::dropDownList('state_id','', Location::getStates(),
																array(
																	'ajax' => array(
																					'type'	=> 'POST',
																					'url' => array('/location/myCitys'),
																					'update'	=> '#UserStore_location_id',
																				),
																)
															); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'location_id'); ?>
		<?php echo $form->dropDownList($model,'location_id', array(''=>'Select State')); ?>
		<?php echo $form->error($model,'location_id'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>37)); ?>
		<?php echo $form->error($model,'address'); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'zip'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
