<div id="MainBody" class="FBGIMG">
    <div class="CenterAlign">
        <div class="HundredPercent">
        <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-store-form',
			'enableAjaxValidation'=>false,
		)); ?>
        <div class="BForm">
        <h1>Work with Karmio and make a difference in the world<br /> Karmio ............ Through these relationships, we&#39;ve learned the most effective ways to <br /> increase your revenue and grow your business. Apply now and get Karmio working for you.</h1>
   <?php if ($form->errorSummary($model) != '' || $form->errorSummary($user) != '') {
   ?>
   <div class="errors">
   <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
   <?php echo $form->errorSummary($model); ?>
   <?php echo $form->errorSummary($user); ?>
   </div>
   <?php } ?>
   
        <div class="FormLeftSide">
        
		    <h2>Tell us about your business.</h2>
           <?php echo $form->labelEx($model,'name'); ?>
           <?php echo $form->textField($model,'name',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($model,'name'); ?>

           <?php echo $form->labelEx($model,'address'); ?>
           <?php echo $form->textField($model,'address',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($model,'address'); ?>

           <?php echo $form->labelEx($model,'address2'); ?>
           <?php echo $form->textField($model,'address2',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($model,'address2'); ?>

           <div style="float:left; margin:0px 15px 0px 0px;">
           <?php echo $form->labelEx($model,'location_id'); ?><br />
           <?php echo $form->textField($model,'location_id',array('class' => 'Fieldset2')); ?>
  		   <?php echo $form->error($model,'location_id'); ?>
            </div>

            <div style="float:left; margin:0px 15px 0px 0px;">
           <?php echo $form->labelEx($model,'state_id'); ?><br />
            <!-- ?php echo $form->textField($model,'state_id',array('class' => 'Fieldset3', 'maxlength' => 2)); ? -->

           <?php echo $form->dropDownList($model,'state_id',Location::getStates(),
                                          array(
                                                'prompt'=>'---',
                                                'ajax' => array(
                                                                'type'	=> 'POST',
                                                                'url' => array('/location/myCitys'),
                                                                'update'	=> '#User_location_id',
                                                                ),
                                                'class' => 'Fieldset3',
                                                'maxlength' => 5,
                                                )
                                          ); ?>

  		   <?php echo $form->error($model,'state_id'); ?>
            </div>

            <div style="">
           <?php echo $form->labelEx($model,'zip'); ?><br />
           <?php echo $form->textField($model,'zip',
                                       array('class' => 'Fieldset4','onkeyup' => 'numericFilter(this);', 'maxlength' => 5)); ?>
  		   <?php echo $form->error($model,'zip'); ?>
           </div>

           <?php echo $form->labelEx($model,'website'); ?><br />
             <?php echo $form->textField($model,'website',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($model,'website'); ?>

               Enter Captcha Code *<br />
                <?php if(CCaptcha::checkRequirements()): ?>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($user,'captcha_code',
                                array('class' => 'Fieldset4')); ?>
                <?php endif; ?>

        </div>
        <div class="FormRightSide">
		    <h2>Tell us about yourself.</h2>
            Your Name
             <?php echo $form->textField($user,'fname',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($user,'fname'); ?>

           <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone',
array('class' => 'Fieldset', 'onkeyup' => 'numericFilter(this);', 'maxlength' => 10)); ?>
  		   <?php echo $form->error($model,'phone'); ?>

           <?php echo $form->labelEx($user,'password'); ?>
            <?php echo $form->passwordField($user, 'password', array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($user,'password'); ?>

           <?php echo $form->labelEx($user,'password_repeat'); ?> *
            <?php echo $form->passwordField($user, 'password_repeat', array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($user,'password_repeat'); ?>

           <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($model,'email'); ?>

           <?php echo $form->labelEx($model,'job_title'); ?>
             <?php echo $form->textField($model,'job_title',array('class' => 'Fieldset')); ?>
  		   <?php echo $form->error($model,'job_title'); ?>

            <div style="width:203px; ">
            Best Time To Contact You
             <?php echo $form->textField($model,'contact_time',array('class' => 'Fieldset2')); ?>
  		   <?php echo $form->error($model,'contact_time'); ?>
            </div>




            <input type="image" src="images/form_btn.png" border="0" alt="submit" style="float:right; margin-right:33px;" />
        </div>
		</div>
        <?php $this->endWidget(); ?>
        </div>
    </div>
</div>


<script type="text/javascript">
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
<script type="application/javascript">
$(document).ready( function (){
	if('<?php echo $msg?>' == 'success')	
	{
		var delay = 2000; //Your delay in milliseconds
		//setTimeout(function(){ window.location = '<?php echo Yii::app()->baseUrl;?>'; }, delay);
	}
	});
function closeErrors()
    {
        jQuery(".errors").hide();
    }
</script>
