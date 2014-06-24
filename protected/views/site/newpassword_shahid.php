<?php
$this->pageTitle = Yii::app()->name . ' - New Password';
$this->breadcrumbs = array(
    'Login',
);
?>
<script type="text/javascript">
     jQuery(document).ready(function() {
          jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)');
     });

     function closeErrors()
     {
          window.open('http://beta.karm.io/');
          location.href = 'http://beta.karm.io/';
          window.location='http://beta.karm.io/';
          jQuery(".errors").hide();
          //window.location='http://beta.karm.io/';
     }
     function submit_form1()
     {
          var pass = jQuery('#pass_filed').val();
          var confirm_pass = jQuery('#confir_pss_filed').val();
          if (pass === '' || confirm_pass === '')
          {
               alert("New Password and Confirm Password have Not Null! ");
               return false;
          }
          if (pass === confirm_pass)
          {
               return true;
          }
          else
          {
               alert("New Password and Confirm Password must have same! ");
               return false;
          }
     }

</script>

<div id="MainBody">
     <div class="CenterAlign">
          <div class="HundredPercent">
               <div id="HomePage">

                    <div class="SignInBox" >

                         <div id="contact_form">
                              <h3 class="ARegTxt" style="margin: 9px 94px 0px; padding-bottom: 10px;">Password Change</h3>
                              <?php
                              $form = $this->beginWidget('CActiveForm', array(
                                  'id' => 'user_form',
                                  'enableAjaxValidation' => false,
                                  'htmlOptions' => array('onsubmit' => 'return submit_form1()'),
                                      ));
                              ?>
                              <?php if ($form->errorSummary($model) != '') {
                                   ?>
                                   <div class="errors">
                                        <a class="close" href="http://beta.karm.io/">close</a>
                                        <?php echo $form->errorSummary($model); ?>
                                   </div>
                              <?php } ?>

                              <div class="col_w310 float_l" style="margin: 0 0 15px 122px; padding: 20px 115px 19px 0;">


                                   <div class="cleaner_h10"></div>


                                   <label for="author"> New Password:</label> 
                                   <div class="for RegisterFieldBox">
                                        <?php echo $form->passwordField($model, 'password', array('class' => 'input', 'id' => 'pass_filed')); ?></div>
                                   <div class="cleaner_h10"></div>

                                   <label for="author">Confirm Password:</label> 
                                   <div class="for RegisterFieldBox">
                                        <?php echo $form->passwordField($model, 'password_repeat', array('class' => 'input', 'id' => 'confir_pss_filed')); ?></div>
                                   <div class="cleaner_h10"></div>

                              </div>
                              <div style="width: 410px; float: left; margin:0 0px 0px 94px;">

                                   <input style="margin:0px 0px 0px; font-size: 12px;" type="submit" class="submit_btns float_r" name="submit" id="submit" value="Change Password" />                              
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
<script type="text/javascript">
     function numericFilter(txb) {
          txb.value = txb.value.replace(/[^\0-9]/ig, "");
     }
</script>