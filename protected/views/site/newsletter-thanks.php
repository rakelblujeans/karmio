<?php
$this->pageTitle=Yii::app()->name . ' - Newsletter';
$this->breadcrumbs=array(
	'Login',
);
?>
<?php
// include the newsletter.css and newsletter.js files
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
		
		<h1 id="vheading">Thank you for providing the details</h1>
		    <p>We have just sent you a confirmation email. Please click on the link contained in that e-mail to start getting our latest updates.</p>
		</div>
		</div>
		</center>
		
		
						  
		</div>
		</div>
	</div>
</div>

<div class="clear"></div>

