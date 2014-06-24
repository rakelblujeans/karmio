<?php
$this->pageTitle=Yii::app()->name . ' - Create Charity';
$this->breadcrumbs=array(
	'Charities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Charities', 'url'=>array('index')),
	array('label'=>'Manage Charities', 'url'=>array('admin')),
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
							array('class' => 'nltextfield charityfirstfield',
							      'placeholder' => $attributeLabels['name'] )); ?>
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
                            <?php echo $form->textField($model, 'ein',
							array('class' => 'nltextfield',
							      'placeholder' => $attributeLabels['ein']  )); ?>
			<?php echo $form->error($model, 'ein', array('class'=>'errorMessage charity_error')); ?>
                             </div>
                            <div class="cleaner_h10"></div>
                            
                            <div class="for RegisterFieldBox  fullwidth">
                                <?php if(CCaptcha::checkRequirements()): ?>
                                    <?php $this->widget('CCaptcha', array(
                                        'imageOptions' => array(
                                                                'id' => 'biz_charity_captcha_image',
                                                                'title' => 'Click to get a new image!',
                                                                'class' => 'charity_captcha_image',
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
		<?php echo CHtml::submitButton('Charity Sign Up', array('id'=>'bbtn') ); ?>
                       <?php $this->endWidget(); ?>
     
     </center>
     
                                  
</div>
</div>
</div>
</div>

<div class="clear"></div>


<!-- Press links -->
<center>
<span>
		  <a href="http://www.psfk.com/2013/04/sibte-hassan-karmio-psfk-2013.html" target="_blank"> <img class="cover" height="50" width="50" src="<?php echo Yii::app()->baseUrl ?>/images/psfk_logo.jpg" /></a>
		  <a href="http://ecopreneurist.com/2012/12/11/brooklyn-tech-startup-karm-io-launches-online-deal-site-that-benefits-charities/" target="_blank"> <img class="cover" height="50" width="133" src="<?php echo Yii::app()->baseUrl ?>/images/ecopreneurist.jpg" /></a>
		  <a href="http://www.businessinsider.com/the-20-most-inspiring-companies-of-2012-2012-12?op=1" target="_blank"> <img class="cover" height="50" width="84" src="<?php echo Yii::app()->baseUrl ?>/images/business_insider.jpg" /></a>
		  <a href="http://www.thenetworkforgood.org/t5/Companies-For-Good/Karmio-Social-Good-Start-up-to-Watch/ba-p/11391" target="_blank"> <img class="cover" height="50" width="110" src="<?php echo Yii::app()->baseUrl ?>/images/network_for_good.jpg" /></a>
</span>
</center>


