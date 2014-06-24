<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?>
<div class="signup" id="signup">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gift-form',
	'enableAjaxValidation'=>false,
)); ?>
<input type="hidden" value="giftthis" />

<input name="email" type="text" id="email" value="Email Address" onfocus="if(this.value=='Email Address')this.value='';" onblur="if(this.value=='')this.value='Email Address';" /><br />
<div style="color:#FF0000" class="erremail"></div>
<textarea name="message" cols="28" rows="5" id="message" onfocus="if(this.value=='Message')this.value='';" onblur="if(this.value=='')this.value='Message';">Message</textarea>
<div align="center">
<input name="" type="button" value="Send" onclick="submitform()" />
</div>
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
function submitform()
{
var email = $("#email").val();
var erremail = "";
var error= false;
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if(email == '')
{
error=true;
$("#email").addClass('error');
erremail += "Enter email";
}
else if(!emailReg.test(email))
{
error=true;
$("#email").addClass('error');
erremail += "Enter valid email";
}
if(error == false){
		$("#gift-form").submit();
	}else{
		$(".erremail").html(erremail);
	}

}
</script>