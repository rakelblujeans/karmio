<?php /*?><div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php */?>

<div id="postdealrow">

<div class="rowleft">
<div class="headingcoupon">Search Deal </div>

</div><!--rowleft-->
<div class="rowcenterlong">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textField($model,'product_id',array('class'=>"header-searchleft", 'value'=>"coupon code", 'onfocus'=>"if(this.value=='coupon code')this.value='';", 'onblur'=>"if(this.value=='')this.value='coupon code';")); ?>

	  <?php echo CHtml::submitButton('Search',array('class'=>"header-searchright", 'value'=>'')); ?>

<?php $this->endWidget(); ?>
</div><!--rowcenter-->

</div><!--postdealrow-->
