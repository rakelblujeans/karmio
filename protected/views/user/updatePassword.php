<?php



$this->pageTitle=Yii::app()->name . ' - My Profile';

$this->breadcrumbs=array(

	'My Profile',

);

?>

<script type="text/javascript">

jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});

</script>





 <div id="slider" style="height:765px;">



 <div id="MainBody" style="top:72px;">

            <div class="CenterAlign">

            <div class="HundredPercent">

            

            <div id="HomePage">

<!--<div id="CompanyLogo"><a href="< ?php echo Yii::app()->getBaseUrl(true)?>"><img src="images/CompanyLogo.png" alt="logo"/></a></div>-->

        <div class="SignInBox">

        

        <div id="login_form">
               <h3 style="margin:35px 94px 0;" class="ARegTxt">Password</h3> 


                <?php $form=$this->beginWidget('CActiveForm', array(

					'id'=>'password-form',

					'clientOptions'=>array(

					),

				)); ?>

                       

                        <div class="col_w312 float_l">

							 <?php if($msg == 'successful'){?>

                             <h1 style="margin-left:4px; color:#000"> Password updated successfully </h1>

                             <?php }?>


                             <?php echo $form->errorSummary($model); ?>

                            

                             

                            <label for="author">Current Password</label> 

                            <div class="for">

                           <?php echo $form->passwordField($model,'old_password',array('class'=>'input')); ?>

                             </div>

                            <div class="horizontalLine"></div>

                           

                            

                             <label for="author">New password:</label> 

                            <div class="for">

                            <?php echo $form->passwordField($model,'password',array('value' => '', 'class'=>'input')); ?> </div>

                             

                              <label for="author">Reenter new password:</label> 

                            <div class="for">

                         

                            <?php echo $form->passwordField($model,'password_repeat',array('class'=>'input')); ?>

                             </div>

                                 <div class="cleaner_h10"></div>

                              <div style="margin-left:4px;" class="float_l RedTxt" ><a href="<?php echo Yii::app()->createAbsoluteUrl('product/index')?>"> Cancel</a></div> 

                             <input style="margin-right: 10px;" type="submit" class=" submit_btns float_r" name="submit" id="submit" value="Save Changes" />

                             

                            

                            <div class="cleaner_h10"></div>

                                             

                           

                        </div>

                       

                        

        			<?php $this->endWidget(); ?>

                    </div>

        <!--signin Box Ends Here-->     

          </div>  

                                  

</div>

</div>

</div>

</div>

</div>

<div class="clear"></div>

<script type="application/javascript">

$(document).ready( function (){

	if('<?php echo $msg?>' == 'successful')	

	{

		var delay = 2000; //Your delay in milliseconds

		setTimeout(function(){ window.location = '<?php echo Yii::app()->baseUrl;?>'; }, delay);

	}

	});



</script>















