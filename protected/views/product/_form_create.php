<div class="form">

<?php

	$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a#addStore',
		'config'=>array(
							'onClosed' => 'js:function(){
												updStoreList("'.CHtml::normalizeUrl(array('/userStore/getStores')).'");
											return true;
											}'
						),
    	)
	);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
	<legend>Deal Information</legend>
	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'expiry_date'); ?>
		<?php echo $form->textField($model,'expiry_date',array('size'=>32)); ?>
		<?php echo $form->error($model,'expiry_date'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'regular_price'); ?>
		<?php echo $form->textField($model,'regular_price',array('size'=>32,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'regular_price'); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>32,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'Category'); ?>
		<?php echo CHtml::dropDownList('category_M','', $model->getCategorys(),
																array(
																	'ajax' => array(
																					'type'	=> 'POST',
																					'url' => '?r=product/myCategorys',
																					'update'	=> '#Product_category_id',
																				),
																)
															); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id', array(''=>'Select Category')); ?>
		<?php echo $form->error($model,'category_id'); ?>
		</div>

		<div class="clear">&nbsp;</div>

	</div>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>37)); ?>
		<?php echo $form->error($model,'description'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>
	</fieldset>

	<fieldset>
	<legend>Select Outlets</legend>

	<div class="row">
		<div class="left-col" id="storePlace">
		<?php //echo $form->labelEx($model,'storeArray'); ?>
		<?php echo $form->checkboxList($model,'storeArray',UserStore::getStores()); ?>
		<?php echo $form->error($model,'storeArray'); ?>
		</div>
		<?php echo CHtml::link('Add A Store', array('/userStore/create', 'fbox'=>1), array('id' => 'addStore')); ?>
		<div class="clear">&nbsp;</div>

<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#inline',
        'config'=>array(
                'scrolling'             => 'yes',
                'titleShow'             => true,
        ),
        )
);
?>

	</div>
	</fieldset>

	<fieldset>
	<legend>Organization Information</legend>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'organization_id'); ?>
		<?php echo $form->dropDownList($model,'organization_id',$model->getOrgList()); ?>
		<?php echo $form->error($model,'organization_id'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>

	<div class="row">
		<div class="left-col">
		<?php echo $form->labelEx($model,'amount_share'); ?>
		<?php echo $form->textField($model,'amount_share',array('size'=>32, 'maxsize'=>10)); ?>
		<?php echo $form->error($model,'amount_share'); ?>
		</div>

		<div class="right-col">
		<?php echo $form->labelEx($model,'percentage_share'); ?>
		<?php echo $form->textField($model,'percentage_share',array('size'=>32, 'maxsize'=>10)); ?>
		<?php echo $form->error($model,'percentage_share'); ?>
		</div>

		<div class="clear">&nbsp;</div>
	</div>
	</fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Post' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

