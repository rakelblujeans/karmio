<?php
$this->pageTitle=Yii::app()->name . ' - Create Store';
$this->breadcrumbs=array(
	'Stores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stores', 'url'=>array('index')),
	array('label'=>'Manage Stores', 'url'=>array('admin')),
);
?>
?>
<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/newsletter.css");
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/charity-biz-signup.css");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl . "/js/newsletter.js");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl . "/js/charity-biz-signup.js");
?>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
 

 <div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            <div id="HomePage">
     
     <center>
		<div class="videodiv">
		<div class="iframestyle" id="biz_charity_vtext">
		
	<?php $form=$this->beginWidget('CActiveForm', array(
				   'enableClientValidation'=>true,
				   'clientOptions'=>array(
					   'validateOnSubmit'=>true,
				   ),
			   )); ?>
			    <div class="for RegisterFieldBox fullwidth">
			<?php $attributeLabels = $model->attributeLabels() ?>
                            <?php echo $form->textField($model, 'name',
							//array('class' => 'nltextfield bizfirstfield',
							array('class' => 'nltextfield firstfield',
							      'placeholder' => $attributeLabels['name'] )); ?>
			<!-- from this point forward, class of error messages has been updated
			from biz_error to charity_error -->
			<?php echo $form->error($model, 'name', array('class'=>'errorMessage charity_error')); ?>
                              </div>
                            <div class="cleaner_h10"></div>
                            <div class="for RegisterFieldBox fullwidth">
			<?php $attributeLabels = $model->attributeLabels() ?>
                            <?php echo $form->textField($model, 'owner_name',
							array('class' => 'nltextfield',
							      'placeholder' => $attributeLabels['owner_name'] )); ?>
			<?php echo $form->error($model, 'owner_name', array('class'=>'errorMessage charity_error')); ?>
                              </div>
                            <div class="cleaner_h10"></div>
                            <div class="for RegisterFieldBox fullwidth">
                            <?php echo $form->textField($model, 'email',
							array('class' => 'nltextfield',
							      'placeholder' => $attributeLabels['email']  )); ?>
			<?php echo $form->error($model, 'email', array('class'=>'errorMessage charity_error')); ?>
                             </div>
                            <div class="cleaner_h10"></div>
			    
			<div class="for RegisterFieldBox fullwidth">
			    <?php if(CCaptcha::checkRequirements()): ?>
				<?php $this->widget('CCaptcha', array(
				    'imageOptions' => array(
							    'id' => 'biz_charity_captcha_image',
							    'title' => 'Click to get a new image!',
							    ),
				    'showRefreshButton' => false,
				    'clickableImage' => true,
							  )); ?>
				<?php echo $form->textField($model,'verifyCode',
							    array('class' => 'nltextfield',
							  'placeholder' => $attributeLabels['verifyCode']  )); ?>
			    <?php endif; ?>
			    <?php echo $form->error($model, 'verifyCode', array('class'=>'errorMessage charity_error')); ?>
			</div>
			<div class="cleaner_h10"></div>
		</div>
		</div>		
		<?php echo CHtml::submitButton('+Business Sign Up', array('id'=>'bbtn') ); ?>
                       <?php $this->endWidget(); ?>
     
     </center>
     
                                  
</div>
</div>
</div>
</div>

<div class="clear"></div>

