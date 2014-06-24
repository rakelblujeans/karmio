<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/captcha.css"); ?>
<script type="text/javascript">
     jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>


<div id="MainBody">
     <div class="CenterAlign">
          <div class="HundredPercent">

               <div id="HomePage">

                    <div class="SignInBox">
                         <div id="contact_form">

                              <h3 class="ARegTxt" style="margin: 35px 75px 0px;;">Sign In</h3> 

                              <?php
                              $form = $this->beginWidget('CActiveForm', array(
                                  'enableClientValidation' => true,
                                  'clientOptions' => array(
                                      'validateOnSubmit' => true,
                                  ),
                                      ));
                              ?>

                              <div class="col_w310 float_l" style="margin: 0px 0px 15px 95px; padding-right: 100px; padding-top: 22px; height: 250px;">

                                   <?php
                                   echo $form->error($model, 'username');
                                   echo $form->error($model, 'password');
                                   ?>
                                   <label for="author">User ID:</label> 
                                   <div class="for RegisterFieldBox">
<?php echo $form->textField($model, 'username', array('class' => 'input')); ?>
                                   </div>
                                   <div class="cleaner_h10"></div>


                                   <label for="author">Password:</label> 
                                   <div class="for RegisterFieldBox">
<?php echo $form->passwordField($model, 'password', array('class' => 'input')); ?>

                                   </div>
                                   <div class="float_l RedTxt" >Forgot your<a href="<?php echo CController::createUrl('site/forgetPassword') ?>" > Password</a></span></div>
                                   <?php if ($model->scenario == 'withCaptcha' && CCaptcha::checkRequirements()): ?>
                                   <div class="cleaner_h10"></div>
                                   <label for="author">Verification Code:</label> 
                                   <div class="for RegisterFieldBox">
<?php $this->widget('CCaptcha'); ?>
<?php echo $form->textField($model, 'verifyCode', array('class' => 'input')); ?>
                                   </div>
                                   <?php endif; ?>
                                   <div class="cleaner_h10"></div>

                                   <div class="cleaner_h10"></div>
                              </div>
                              <div style="width: 410px; float: left; margin:0 0px 0px 94px;">
                                   <div class="float_l RegTxt" style="margin:0px 0px 0px 0px; display:inline-block;"> 
                                        <span style="font-size:14px">New to Karmio?</span> <br/>
                                        <a href="<?php echo CController::createUrl('user/signupAcType') ?>" >
                                             <span class="float_l SignRedTxt">Register Here!</span> </a>
                                   </div>  
                                   <input style="margin:0px 0px 0px;" type="submit" class=" submit_btns float_r" name="submit" id="submit" value="Sign in" />
                              </div>
                              <div class="col_w311 float_r"  style="margin:-265px auto; width:350px;">
                                   <div class="fbconnect">
                                     
                                        <?php
                                        $this->renderPartial('fb_view');
                                        ?>
                                    
                                   </div>

                              </div>

<?php $this->endWidget(); ?>

                         </div>   


                         <!--signin Box Ends Here-->     
                    </div>  

               </div>
          </div>
     </div>
</div>

<div class="clear"></div>

