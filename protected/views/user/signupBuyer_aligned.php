<?php
$this->pageTitle = Yii::app()->name . ' - Signup';
$this->breadcrumbs = array(
    'Login',
);
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')
    });
    function closeErrors()
    {
        jQuery(".errors").hide();
    }
    function submit_form()
    {
         if (jQuery("#terms").is(':checked'))
        {
            return true;

        }
        else
        {
            alert('Please accept terms and conditions first');
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
                        <h3 class="ARegTxt" style="margin: 9px 94px 0px; padding-bottom: 10px;">Register</h3>
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'user_form',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('onsubmit' => 'return submit_form()'),
                        ));
                        ?>
                        <?php if ($form->errorSummary($model) != '') {
                            ?>
                            <div class="errors">
                                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
                                <?php echo $form->errorSummary($model); ?>
                            </div>
                        <?php } ?>

                        <div class="col_w310 float_l" style="margin: 0 0 15px 122px; padding: 20px 70px 19px 0;">


                            <label for="author">Name:</label> 
                            <div class="for RegisterFieldBox">
                                <?php echo $form->textField($model, 'fname', array('class' => 'input')); ?>

                            </div>
                            <div class="cleaner_h10"></div>
                            <!--<label for="author">Last Name:</label> 
                             <div class="for">
                            <?php echo $form->textField($model, 'lname', array('class' => 'input')); ?>
 
                              </div>
                             <div class="cleaner_h10"></div>-->

                            <label for="author">Zip Code:<span style="margin-left: 55px;">Phone Number:</span></label> 
                            <div class="for RegisterFieldBox" >
                                <?php echo $form->textField($model, 'zip', array('class' => 'input', 'onkeyup' => 'numericFilter(this);', 'maxlength' => 5)); ?>

                                <?php echo $form->textField($model, 'cellphone', array('class' => 'input', 'onkeyup' => 'numericFilter(this);', 'maxlength' => 10)); ?>
                            </div>
                            <div class="cleaner_h10"></div>
                            <style type="text/css">
                                #User_zip
                                {
                                    width: 90px ! important;
                                    float:left;
                                }
                                #User_cellphone
                                {
                                    width: 250px ! important;
                                    float:left;
                                    margin-left: 10px;
                                }
                            </style>


                            <label for="author">Email address (this is also your user ID):</label> 
                            <div class="for RegisterFieldBox">
                                <?php echo $form->textField($model, 'email', array('class' => 'input')); ?> </div>
                            <div class="cleaner_h10"></div>

                            <label for="author">Password:</label> 
                            <div class="for RegisterFieldBox">
                                <?php echo $form->passwordField($model, 'password', array('class' => 'input')); ?></div>
                            <div class="cleaner_h10"></div>

                            <label for="author">Confirm Password:</label> 
                            <div class="for RegisterFieldBox">
                                <?php echo $form->passwordField($model, 'password_repeat', array('class' => 'input')); ?></div>
                            <div class="cleaner_h10"></div>

                            <div class="remember"><input type="checkbox" id="terms"><span>I read and agree with <a href="<?php echo CController::createUrl('site/terms') ?>">terms and conidtions</a></span></div>

                        </div>
                        <div style="width: 410px; float: left; margin:0 0px 0px 94px;">
                            <div class="RegTxt" style="margin:0px 0px 0px 0px; display:inline-block;"> 
                                <span style="font-size:14px">Already Registered?</span> <br/> 
                                <a href="<?php echo CController::createUrl('site/login') ?>"  >
                                    <span class="float_l SignRedTxt">Sign In!</span>
                                </a>
                            </div>  
                            <input style="margin:0px 0px 0px;" type="submit" class="submit_btns float_r" name="submit" id="submit" value="Register" />                              
                        </div>

                        <div class="col_w311 float_r" style="margin:-249px auto; width:350px;">

                            <div class="fbconnect">
                                <?php $this->renderPartial('/site/fb_view'); ?>
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
<script type="text/javascript">
    function numericFilter(txb) {
        txb.value = txb.value.replace(/[^\0-9]/ig, "");
    }
</script>