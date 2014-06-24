<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
<style>.red_bold{ padding-top:50px !important;}</style>
<div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            
            <div id="HomePage">

        <div class="ThankyouBox" >
<div class="ThankyouPopup" style=" margin-top:50px; text-align:center; width:100%">
<div class="ThankyouPopup">
<?php if($msg==1){ ?>




<h3 class="red_bold">CONGRATULATIONS, You have successfully signed up.<br>

	Please Check your email / spam folder to activate your account.<br />

	Thanks for using Karmio

	</h3>



<?php } ?>

<?php if($msg==2){ ?>



<h3 class="red_bold">

	<span>CONGRATULATIONS, your account has been activated.</span>
</h3>
	<span><a href="<?php echo CController::createUrl('userStore/create'); ?>">CLICK HERE</a>, to continue your experience of Karmio</span>



<?php } ?>



<?php if($msg==3){ ?>



<h3 class="red_bold">
	 Your account has already been activated.</h3>

<?php } ?>

<?php if($msg==4){ ?>



	<h3 class="red_bold">Invalid Activation Url</h3>

	 <a href="http://www.karm.io/design/index.php?r=site/login">CLICK HERE</a> to signup</span>



<?php } ?>

<?php if($msg==5){ ?>



<h3 class="red_bold">Your account has already activated.</h3>

	Please <a href="http://www.karm.io/design/index.php?r=site/login">LOGIN</a></span>



<?php } ?>



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
	
	var delay = 2000; //Your delay in milliseconds

//setTimeout(function(){ window.location = '<?php echo Yii::app()->baseUrl;?>'; }, delay);
	});

</script>