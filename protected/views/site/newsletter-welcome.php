<?php
$this->pageTitle=Yii::app()->name . ' - Newsletter';
$this->breadcrumbs=array(
	'Login',
);
?>
<?php
// include the newsletter.css file
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/newsletter.css");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl . "/js/newsletter.js");
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
		<center>
		<div class="videodiv">
		<div class="iframestyle" id="vtext">
		<h1 id="vheading">FINALLY MONEY CAN <br />BUY HAPPINESS!</h1>
		<p id="play_link"><span id="how">HOW?</span> <a href="javascript:void(-1)" onclick="play_video()"><img src="images/play.png" /></a></p>
		</div>
		<div class="iframestyle" id="vvideo">
            
            </div>
		</div>
		
  <?php if ($showForm) { ?>
		<a href="<?php echo CController::createUrl("site/newsletter", 
array('showform' => true) ); ?>" >

			 <?php } ?>

 <button value="" id="bbtn">Sign Up Now!</button>
 </a>
		
		</center>
		</div>
		</div>
	</div>
</div>

<div class="clear"></div>



<!-- Press links -->
<center>
<span>
		  <a href="http://www.psfk.com/2013/04/sibte-hassan-karmio-psfk-2013.html" target="_blank"> <img class="cover" height="50" width="50" src="<?php echo Yii::app()->baseUrl ?>/images/psfk_logo.jpg" /></a>
		  <a href="http://ecopreneurist.com/2012/12/11/brooklyn-tech-startup-karm-io-launches-online-deal-site-that-benefits-charities/" target="_blank"> <img class="cover" height="50" width="133" src="<?php echo Yii::app()->baseUrl ?>/images/ecopreneurist.jpg" /></a>
		  <a href="http://www.businessinsider.com/the-20-most-inspiring-companies-of-2012-2012-12?op=1" target="_blank"> <img class="cover" height="50" width="84" src="<?php echo Yii::app()->baseUrl ?>/images/business_insider.jpg" /></a>
		  <a href="http://www.thenetworkforgood.org/t5/Companies-For-Good/Karmio-Social-Good-Start-up-to-Watch/ba-p/11391" target="_blank"> <img class="cover" height="50" width="110" src="<?php echo Yii::app()->baseUrl ?>/images/network_for_good.jpg" /></a>
</span>
</center>
