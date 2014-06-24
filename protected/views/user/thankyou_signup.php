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




<h3 class="red_bold">Congratulations! You have successfully signed up.<br>

	Please Check your email / spam folder to activate your account.<br />

	Thanks for using Karmio!

	</h3>



<?php } ?>

<?php if($msg==2){ ?>

<h3 class="red_bold">
	<span>Congratulations! Your account has been activated.</span>
</h3>
	<a href="<?php echo CHtml::normalizeUrl(array('/product/index')); ?>">Continue on to Karmio</a>

<?php } ?>


<?php if($msg==3){ ?>

<h3 class="red_bold">
	 Your account has already been activated.</h3>

<?php } ?>


<?php if($msg==4){ ?>

	<h3 class="red_bold">Invalid Activation Url</h3>
	 <a href="<?php echo CHtml::normalizeUrl(array('/site/login')); ?>">Want to signup?</a>

<?php } ?>


<?php if($msg==5){ ?>

   <h3 class="red_bold">Your account has already activated.</h3>
	Please <a href="<?php echo CHtml::normalizeUrl(array('/site/login')); ?>">Why don&#39;t you login?</a>

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