<?php
$this->pageTitle=Yii::app()->name . ' - Newsletter';
$this->breadcrumbs=array(
	'Login',
);
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

        <div class="SignInBox">
           <div id="contact_form">
                
                        <!-- h3 class="ARegTxt" style="margin: 35px 94px 0px;;">Request an invite< / h3 --> 
                        
                       <?php $form=$this->beginWidget('CActiveForm', array(
						  'enableClientValidation'=>true,
						  'clientOptions'=>array(
							  'validateOnSubmit'=>true,
						  ),
					  )); ?>
                         
                        <div class="col_w310 float_l" style=" background:none; margin: 0px 0px 15px 122px; padding-right: 115px; padding-top: 22px; height: 150px;">
                        
							
                            <?php  if($msg != ''){?>
                           
                            
                             <div class="errors" style="margin-left:-28px">
                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
               <p <?php if($msg == 'success'){?>style="color:#0F0" <?php }else{?>style=" color:#FB3F36" <?php }?>>
               <?php if($msg == 'success'){?>Sent successfully. Thanks.
               
               <?php }else{?>
               Some error occured try again
               <?php }?>
               </p>
                     </div>       
                            
                            <?php }?>
                            <label for="author">Enter your name:</label> 
                            <div class="for RegisterFieldBox">
                            <?php echo CHtml::textField('name', '', array('class' => 'input')); ?>
                             </div>
                            <div class="cleaner_h10"></div>
                           
                            
                             <label for="author">Email:</label> 
                            <div class="for RegisterFieldBox">
                            <?php echo CHtml::textField('email', '', array('class' => 'input')); ?>

                             </div>
                              
                            <div class="cleaner_h10"></div>
                              
                            <div class="cleaner_h10"></div>
                        </div>
                        <div style="width: 410px; text-align: center; margin:0 0px 0px 94px;">
                            
                        <input style="margin:0px 0px 0px;" type="submit" class=" submit_btns float_r" name="submit" id="submit" value="Request an invite" />
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
