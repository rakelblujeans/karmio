<div id="MainBody" class="FBGIMG">
    <div class="CenterAlign">
        <div class="HundredPercent">
        <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-store-form',
			'enableAjaxValidation'=>false,
		)); ?>
        <div class="BForm">
        <h1>Work with Karmio and make a difference in the world<br /> Karmio ............ Through these relationships, we&#39;ve learned the most effective ways to <br /> increase your revenue and grow your business. Apply now and get Karmio working for you.</h1>
        <?php if ($form->errorSummary($model) != '') {
                            ?>
                            <div class="errors">
                                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
                                <?php echo $form->errorSummary($model); ?>
                            </div>
         <?php } ?>
        
        <?php if(!$model->isNewRecord && $form->errorSummary($model) == '' && $model->is_verified == 0 & $msg == 'success'){?>
        <div class="errors">
                                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
         <h2 style="color:#0F0"> Your information is being reviewed. we will let you know as soon as possible.</h2>
         </div>
        <?php }else if(!$model->isNewRecord && $form->errorSummary($model) == '' && $msg =='success'){?>
        <div class="errors">
       <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
        <h2 style="color:#0F0"> Business info Updated successfully</h2>
        </div>
        <?php }?>
        <div class="FormLeftSide">
        
		    <h2>Tell us about your business.</h2>
            <b>Business Name</b>
           <?php echo $form->textField($model,'name',array('class' => 'Fieldset')); ?>
            <b>Address</b>
           <?php echo $form->textField($model,'address',array('class' => 'Fieldset')); ?>
            <b>Address 2</b>
           <?php echo $form->textField($model,'address2',array('class' => 'Fieldset')); ?>
            <div style="float:left; margin:0px 15px 0px 0px;">
            <b>City</b>
           <?php echo $form->textField($model,'location_id',array('class' => 'Fieldset2')); ?>
            </div>
            <div style="float:left; margin:0px 15px 0px 0px;">
            <b>ST</b>
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

            </div>
            <div style="">
            <b>Zip</b>
            <?php echo $form->textField($model,'zip',array('class' => 'Fieldset4', 'maxlength' => 5)); ?>
            </div>
            <b>Website</b>
             <?php echo $form->textField($model,'website',array('class' => 'Fieldset')); ?>
        </div>
        <div class="FormRightSide">
		    <h2>Tell us about yourself.</h2>
            <b>Your Name</b>
             <?php echo $form->textField($model,'owner_name',array('class' => 'Fieldset')); ?>
            <b>Phone Number</b>
            <?php echo $form->textField($model,'phone',array('class' => 'Fieldset')); ?>

            <b>Email</b>
            <?php echo $form->textField($model,'email',array('class' => 'Fieldset')); ?>

            <b>Job Title</b>
             <?php echo $form->textField($model,'job_title',array('class' => 'Fieldset')); ?>
            <div style="width:203px; ">
            <b>Best Time To Contact You</b>
             <?php echo $form->textField($model,'contact_time',array('class' => 'Fieldset2')); ?>
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
