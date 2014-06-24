<!--<div id="postdealrow">
<div class="current-deals"><div class="t-deal">Update Profile</div></div>
</div>-->
<?php
//Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?>
 <script>
 function toggle2(showHideDiv, switchImgTag) {
        var ele = document.getElementById(showHideDiv);
	    var imageEle = document.getElementById(switchImgTag);
        if(ele.style.display == "block") {
                ele.style.display = "none";
        }
        else {
                ele.style.display = "block";
        }
}  
 </script>
 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'action'=>CController::createUrl('user/updateSeller'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="CenterContents">
	<h1> MY PROFILE </h1>
	<div class="MyProfile">
    	<ul>
  
       	<li>
            	<h2> <a href="<?php echo Yii::app()->createAbsoluteUrl('user/updatePassword')?>">Change Password</a></h2>
            </li>
			<li>

<input type="hidden" value="signupBuyer" />
	<?php echo $form->errorSummary(array($store, $model));
		 //echo $form->errorSummary($model); 
	 ?>
</li>

<li><?php echo $form->labelEx($model,'Store Name', array('class' => 'BoxLabel')); ?>
	<?php echo $form->textField($store,'name',array('size'=>32,'maxlength'=>255,'class'=>'TextBox1')); ?>
	<?php echo $form->error($store,'name'); ?>
</li>
 <li><?php echo $form->labelEx($store,'Website', array('class' => 'BoxLabel')); ?>
<?php echo $form->textField($store,'website',array('size'=>32,'maxlength'=>255, 'onfocus'=>"if(this.value=='http://')this.value='';", 'onblur'=>"if(this.value=='')this.value='http://';",'class'=>'TextBox1')); ?>
	<?php echo $form->error($store,'website'); ?>
</li>
 <li><?php echo $form->labelEx($model,'Email', array('class' => 'BoxLabel')); ?>
	<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>255,'readonly'=>true,'class'=>'TextBox1')); ?>
	<?php echo $form->error($model,'email'); ?>
</li>
  <li><?php echo $form->labelEx($store,'Address', array('class' => 'BoxLabel')); ?>
	<?php echo $form->textField($store,'address',array('size'=>32,'maxlength'=>255,'class'=>'TextBox1')); ?>
	<?php echo $form->error($store,'address'); ?>
	</li>
  <li><?php echo $form->labelEx($store,'Address2', array('class' => 'BoxLabel')); ?>
	<?php echo $form->textField($store,'address2',array('size'=>32,'maxlength'=>255,'class'=>'TextBox1')); ?>
	<?php echo $form->error($store,'address2'); ?>
	</li>
 <li><?php echo $form->labelEx($model,'State', array('class' => 'BoxLabel')); ?>
<?php echo $form->textField($model, 'state_id', array('size'=>32,'maxlength'=>2,'class'=>'TextBox1'));?>
</li>
<li><?php echo $form->labelEx($model,'City', array('class' => 'BoxLabel')); ?>
<?php echo $form->textField($model, 'location_id', array('size'=>32,'maxlength'=>90,'class'=>'TextBox1'));  ?>
		<?php echo $form->error($model,'location_id'); ?>
		<div class="errloc" style="color:#FF0000; font-size:9;"></div>
</li>




 <li>	<?php echo $form->labelEx($model,'Zip Code', array('class' => 'BoxLabel', 'maxlength' => 5 )); ?>

<?php echo $form->textField($model,'zip',array('size'=>32,'maxlength'=>5,'class'=>'TextBox1')); ?>

<div class="errzip" style="color:#FF0000; font-size:9;"></div>

</li>

 

 

 

 

 <li><?php echo $form->labelEx($model,'Cellphone', array('class' => 'BoxLabel')); ?>

<?php echo $form->textField($model,'cellphone',array('size'=>32,'maxlength'=>10,'class'=>'TextBox1')); ?>

<div class="errc" style="color:#FF0000; font-size:9;"></div>
</li>


 

 

 

 

 <li><?php echo $form->labelEx($model,'First Name', array('class' => 'BoxLabel')); ?>

	<?php echo $form->textField($model,'fname',array('size'=>32,'maxlength'=>90,'class'=>'TextBox1')); ?>

	<?php echo $form->error($model,'fname'); ?>

	<div class="errf" style="color:#FF0000; font-size:9;"></div>
</li>






<li><?php echo $form->labelEx($model,'Last Name', array('class' => 'BoxLabel')); ?>

<?php echo $form->textField($model,'lname',array('size'=>32,'maxlength'=>90,'class'=>'TextBox1')); ?>

	<?php echo $form->error($model,'lname'); ?>

	<div class="errl" style="color:#FF0000; font-size:9;"></div>
</li>



 
  

 <li>
  <div class="ButtonsRow">
        	<a href="<?php echo Yii::app()->createAbsoluteUrl('user/view', array('id' =>Yii::app()->user->id));?>"><input type="button" name="cancel" value="Cancel" class="FormButton" /></a>
            <input type="submit" name="cancel" value="Update" class="FormButton ActiveButton" /> 
        </div>
		</li>
		</ul>
</div>
</div>



<?php $this->endWidget(); ?>



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

