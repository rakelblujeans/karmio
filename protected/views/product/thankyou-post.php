<script type="text/javascript">

jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});

</script>

 <?php  $cname = $model->charity->name; ?>





 <div id="MainBody">

            <div class="CenterAlign">

            <div class="HundredPercent">

            

            <div id="HomePage">



        <div class="ThankyouBox" >

<div class="ThankyouPopup" style=" margin-top:75px; text-align:center; width:100%">



 <h3 class="red_bold RedH3">Thank you!</h3>

 <h3 class="RedHilight">Your unique code is:</h3>   

 <h3 class="red_bold RedH3">  <?php echo $model->couponcode?></h3>

 <p class="SmTxt">you can also find this in your <a href="<?php echo CHtml::normalizeUrl(array('/seller/index')); ?>" style="border:none">dashboard</a></p>

 <p class="red NormTxt">As Karmio believes in transparency </p>

 <p class="RedHilight BoldTxt">     $<?php echo $model->amount_share ;?>  for <?php echo $cname?> is</p>

 <p class="red NormTxt">processed and will be delivered by networkforgood.org</p>

<p><a href="http://www.networkforgood.org" target="_blank"><img src="images/logo_network_for_good.png" alt=""  border="0"/></a></p>

<!--<p class="red">10 sec, then redirect to main page </p>-->

</div> 



     <!--signin Box Ends Here-->     

          </div>  

                                  

</div>

</div>

</div>

</div>



<div class="clear"></div>

<script type="application/javascript">

$(document).ready( function (){

	

	//var delay = 2000; //Your delay in milliseconds



//setTimeout(function(){ window.location = '<?php echo Yii::app()->baseUrl;?>'; }, delay);

	});



</script>