<div class="form"><?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'organization-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	  'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	  
)); 


?>

<?php echo $form->errorSummary($model); ?>
<form name="">
 <div class="add-field">

   <div class="add-field">

    <div class="add-label"><label>TITLE</label></div>

    <div class="add-text"><?php //echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>90, 'class'=>"adds-title")); ?>
		<?php echo $form->error($model,'name'); ?></div>

   </div>

   <div class="add-field">

    <div class="add-label"><label>URL</label></div>

    <div class="add-text"><?php //echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>100,'maxlength'=>200,'class'=>"adds-title")); ?>
		<?php echo $form->error($model,'url'); ?></div>

   </div>
   
     <div class="add-field">

    <div class="add-label"><label>Admin Email</label></div>

    <div class="add-text">
		<?php echo $form->textField($model,'email',array('size'=>100,'maxlength'=>200,'class'=>"adds-title")); ?>
		<?php echo $form->error($model,'email'); ?></div>

   </div>

   <div class="add-field">

    <div class="add-label"><label>LOGO</label></div>

    <div class="add-text">
	
	
	
	<div id="divinputfile"><?php echo $form->FileField($model,'logo',array( 'size' =>"40", 'id'=>"logo")); ?> 
	</div><?php echo $form->error($model,'logo'); ?>

</div></div>

    

   </div>

   <br style="clear:both" />

   <div class="add-help">

   <div style="height:2px; background-color:#41b0e5;"></div>

   <div class="add-help-field">

    <div class="add-help-label"><label>YOU WILL HELP</label></div>

    <div class="add-help-text"><?php //echo $form->labelEx($model,'help'); ?>
		<?php echo $form->textField($model,'slogon',array('size'=>100, 'maxlength'=>200,'class'=>"adds-help-title")); ?>
		<?php echo $form->error($model,'slogon'); ?></div>

   </div>

   <div style="height:2px; background-color:#41b0e5;"></div>

   <div class="add-help-field">

    <div class="add-help-label" style="font-size:18px;color:#e9522d;"><label>SUMMARY</label></div>

    <div class="add-help-textarea"><?php //echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('row'=>3,'col'=>7)); ?>
		<?php echo $form->error($model,'summary'); ?></div>

   </div>

   <div class="add-help-field">

    <div class="add-help-label" style="font-size:18px; color:#e9522d;"><label>DETAIL</label></div>

    <div class="add-help-textarea"><?php //echo $form->labelEx($model,'detail'); ?>
		<?php echo $form->textArea($model,'detail',array('row'=>3,'col'=>7)); ?>
		<?php echo $form->error($model,'detail'); ?></div>

   </div>

   <div class="add-help-field">
  <?php //echo CHtml::submitButton('SAVE!', array('name'=>'holding', 'class'=>'save-button')); ?>
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('name'=>'save', 'class'=>'save-button')); ?>&nbsp;&nbsp;
<?php echo CHtml::submitButton($model->isNewRecord ? 'Publish' : 'Update', array('name'=>'publish', 'class'=>'publish-button')); ?>
  

   </div>

   </div>

  </form>


<?php $this->endWidget(); ?>

</div><!-- form -->