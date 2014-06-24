<?php
$this->pageTitle=Yii::app()->name . ' - Profile';
$this->breadcrumbs=array(
	'Profile',
);
?>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
 
 <div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            <div id="HomePage">

<div class="SignInBox">
<div id="Profile_form">
                
                        <?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'user-form',
							'action'=>CController::createUrl('user/updateSignupBuyer'),
							'enableAjaxValidation'=>false,
						)); ?>
                         <?php echo $form->errorSummary($model); ?>
                        <div class="col_w310 float_l">
							
                             <h3 class="ARegTxt">Profile</h3> 
                             
                            <label for="author">First Name:</label> 
                             <?php echo $form->textField($model,'fname',array('class'=>'input')); ?>
                            
                            <div class="cleaner_h10"></div>
                            <label for="author">Last Name:</label> 
                             <?php echo $form->textField($model,'lname',array('class'=>'input')); ?>
                            
                            <div class="cleaner_h10"></div>
                            <label for="author">Email:</label> 
                           
                            <?php echo $form->textField($model,'email',array('class'=>'input')); ?>
							 <div class="cleaner_h10"></div>
                                                  
                           <!-- <div class="col_w5">
                             <label for="author" class="labelSmall float_l">Date of Birth:</label> 
                            <input type="text" id="author" class="inputSmall float_l" name="author" />
                            </div>-->
                            
                            <div class="col_w5">
                             <label for="author" class="labelSmall float_l">Cell Phone:</label> 
                            <?php echo $form->textField($model,'lname',array('class'=>'inputSmall float_l')); ?>
                            </div>
                           
                        </div>
                                                 
               
                         
                		<div class="col_w311 float_l">
							
                             <h3 class="ARegTxt">Address:</h3> 
                             
                            <label for="author">Address:</label> 
                            <?php echo $form->textField($model,'address',array('class'=>'input')); ?>
                            
                            <div class="cleaner_h10"></div>
                            <label for="author">Address 2:</label> 
                           
                           <?php echo $form->textField($model,'address2',array('class'=>'input')); ?>
                            
                            
							 <div class="cleaner_h10"></div>
                                                  
                            <div class="col_w6">
                             <label for="author" class="labelSmallST float_l">City:</label> 
                            <?php echo $form->textField($model,'location_id',array('class'=>'inputSmallS float_l')); ?>
                            </div>
                            
                            <div class="col_w6">
                             <label for="author" class="labelSmallST float_l">ST:</label> 
                            <?php echo $form->textField($model,'state_id',array('class'=>'inputSmallS float_l')); ?>
                            </div>
                            <div class="col_w6">
                             <label for="author" class="labelSmallST float_l">Zip:</label> 
                            <?php echo $form->textField($model,'zip',array('class'=>'inputSmallS float_l')); ?>
                            </div>
                            
                              <input type="submit" class="update_btns float_r" name="submit" id="submit" value="Update" /> 
                        </div>      
						<?php $this->endWidget(); ?>
                        <br clear="all" />
              <p> We do not share this information with anyone. </p>
                    </div>
                    </div>

</div>
</div>
</div>
</div>

<div class="clear"></div>


<script type="text/javascript">
function submitform()
{
var loc = $("#User_location_id").val();
var zip = $("#User_zip").val();
var fname = $("#User_fname").val();
var lname = $("#User_lname").val();
var cell = $("#User_cellphone").val();
var errloc = "";
var errzip = "";
var errf= "";
var errl = "";
var errc = "";
var reg=/^([0|1]?(\d{11}))$/;
var error= false;
if(loc == '')
{
error=true;
$("#User_location_id").addClass('error');
errloc += "select city";
}
if(cell == '' || cell == 'Cellphone')
{
error=true;
$("#User_cellphone").addClass('error');
errc += "enter cellphone #";
}
else if(!reg.test(cell))
{
error=true;
$("#User_cellphone").addClass('error');
errc += "enter valid cellphone #";
}
if(fname == '' || fname =='First Name')
{
error=true;
$("#User_fname").addClass('error');
errf += "enter first name";
}
if(lname == '' || fname =='Last Name')
{
error=true;
$("#User_lname").addClass('error');
errl += "enter last name";
}
if(zip == '' || zip=='Zip Code')
{
error=true;
$("#User_zip").addClass('error');
errzip += "enter zip code";
}
if(error == false)
	{
		$("#user-form").submit();
	}
	else{
		$(".errloc").html(errloc);
		$(".errzip").html(errzip);
		$(".errl").html(errl);
		$(".errf").html(errf);
		$(".errc").html(errc);
	}
}
</script>
