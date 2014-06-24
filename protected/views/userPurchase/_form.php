<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-purchase-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'store_id'); ?>
		<?php echo $form->textField($model,'store_id'); ?>
		<?php echo $form->error($model,'store_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_id'); ?>
		<?php echo $form->textField($model,'invoice_id',array('size'=>60,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'invoice_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_method'); ?>
		<?php echo $form->textField($model,'transaction_method',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'transaction_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_id'); ?>
		<?php echo $form->textField($model,'transaction_id',array('size'=>60,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'transaction_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_status'); ?>
		<?php echo $form->textField($model,'transaction_status',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'transaction_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consumption_status'); ?>
		<?php echo $form->textField($model,'consumption_status',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'consumption_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expiry_date'); ?>
		<?php echo $form->textField($model,'expiry_date'); ?>
		<?php echo $form->error($model,'expiry_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collection_date'); ?>
		<?php echo $form->textField($model,'collection_date'); ?>
		<?php echo $form->error($model,'collection_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_price'); ?>
		<?php echo $form->textField($model,'paid_price'); ?>
		<?php echo $form->error($model,'paid_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'donated'); ?>
		<?php echo $form->textField($model,'donated'); ?>
		<?php echo $form->error($model,'donated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->