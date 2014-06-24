<?php



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('user-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div id="postdealrow">

<?php $this->renderPartial('/seller/admin_menu');?>

</div>











<div id="postdealrow">

 <div class="current-deals">

  <div class="t-deal">Charities</div>

 </div>

 <br />

<div class="rowleft">

<div class="headingcoupon"><!--Charity Control--></div>





</div><!--rowleft-->

<div class="rowcenterlong">

<form action="<?php echo CController::createUrl('admin'); ?>" name="" method="post" id="s-form">

 		<div style="color:#FF0000; font-size:9px" class="errs"></div>

         <input type="text" name="searching" id="searching" class="header-searchleft"  value="name" onfocus="if(this.value=='name')this.value='';" onblur="if(this.value=='')this.value='name';" />

	  



       <input type="button" name="" class="header-searchright" value="" onclick="submitform()" />



      </form>  

	  

</div><!--rowcenter-->



</div><!--postdealrow-->



<!-- search-form -->
<style>

div.form label{ color:#FFF; width:150px; margin-left:10px;}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'charities-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note" style="color:#FFF">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag_line'); ?>
		<?php echo $form->textField($model,'tag_line',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tag_line'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'ein'); ?>
		<?php echo $form->textField($model,'ein',array('size'=>60,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'ein'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->dropDownList($model,'state',CHtml::listData(Charities::model()->findAll(), 'state', 'state'), array('empty' => '')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo CHtml::fileField('logo',$model->logo); ?>
		
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'isupdated'); ?>
		<?php echo $form->textField($model,'isupdated'); ?>
		<?php echo $form->error($model,'isupdated'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cause'); ?>
		<?php echo $form->textField($model,'cause',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cause'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php //echo $form->textField($model,'category',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->dropDownList($model,'category',CHtml::listData(Charities::model()->findAll(), 'category', 'category'), array('empty' => '')); ?>
		
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
           <?php echo $form->hiddenField($model,'type',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo CHtml::textField('type',$type,array('size'=>7,'maxlength'=>7, 'disabled'=>'disabled')); ?>
     
		<?php echo $form->error($model,'type'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">

function submitform()

{

var searching = $("#searching").val();

var errs = "";

var error= false;



if(searching == '' || searching=='first name, last name, email, zip , address')

{

error=true;

$("#searching").addClass('error');

errs += "Enter user information like name, email etc";

}



if(error == false){

		$("#s-form").submit();

	}else{

		$(".errs").html(errs);

	}



}

</script>