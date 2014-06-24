<?php
$this->pageTitle=Yii::app()->name . ' - Newsletter';
$this->breadcrumbs=array(
	'Login',
);
?>
<?php
// include the newsletter.css file
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/newsletter.css");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl . "/js/newsletter.js");
?>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
function closeErrors()
	  {
		  jQuery(".errors").hide();
	  }
</script>
 

 <div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            <div id="HomePage">
     
     <center>
		<div class="videodiv">
		<div class="iframestyle" id="vtext">

  <h2 id="vheadingFake">&nbsp;</h2>

	<?php $form=$this->beginWidget('CActiveForm', array(
				   'enableClientValidation'=>true,
				   'clientOptions'=>array(
					   'validateOnSubmit'=>true,
				   ),
			   )); ?>
			   <?php echo $form->errorSummary($model); ?>
			   <?php echo $errorMessage; ?>
                            <!-- <div class="for RegisterFieldBox"> -->
			<?php $attributeLabels = $model->attributeLabels() ?>
                            <?php //echo $form->textField($model, 'name',
					//		array('class' => 'nltextfield',
					//		      'placeholder' => $attributeLabels['name'] )); ?>
			<?php //echo $form->error($model, 'name'); ?>
                             <!-- </div> -->
                            <div class="cleaner_h10"></div>
                            <div id="nlEmailFieldContainer" class="for RegisterFieldBox">
                            <?php echo $form->textField($model, 'email',
							array('class' => 'nltextfield',
							      'placeholder' => $attributeLabels['email']  )); ?>
			<?php echo $form->error($model, 'email'); ?>
                             </div>
                              
                            <div class="cleaner_h10"></div>
			    <?php echo CHtml::submitButton('Request an invite', array('id'=>'bbtn', 'class'=>'nlSubscribeBtn') ); ?>
                       <?php $this->endWidget(); ?>
		</div>
		</div>		
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
