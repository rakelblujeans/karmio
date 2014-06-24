<?php
$this->pageTitle = Yii::app()->name . ' - Forgot Password';
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
window.location = 'http://beta.karm.io/';    
}
</script>


<div id="MainBody">
    <div class="CenterAlign">
        <div class="HundredPercent">

            <div id="HomePage">

                <div class="SignInBox">
                    <div id="contact_form">

                        <h3 class="ARegTxt" style="margin: 35px 94px 0px;;">Forgot Password</h3> 

                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'enableClientValidation' => false,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>
                        <?php if ($form->errorSummary($model) != '') {
                            ?>
                            <div class="errors">
                                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
                                <?php echo $form->errorSummary($model); ?>
                            </div>
                        <?php } if ($msg == 'success') { ?>
                            <div class="errors">
                                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
                                <p style="color:#090">
                                    <?php echo 'Instructions on how to reset your password have been emailed to you.';
                                    ?>
                                </p>
                            </div>
                        <?php }else{
                            
                         ?>
                        <div class="col_w312 float_l" >


                            <label for="author">Enter your Email Address:</label> 
                            <div class="for RegisterFieldBox">
                                <?php echo $form->textField($model, 'email', array('class' => 'input')); ?>
                            </div>

                        </div>
                        <div style="width: 683px; float: left; text-align:right">
                            <input style="margin:0px 0px 0px;" type="submit" class=" submit_btns float_r" name="submit" id="submit" value="Submit" />
                        </div>

                        <?php }?>
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

