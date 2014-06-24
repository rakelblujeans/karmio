<?php

Yii::app()->clientScript->scriptMap['jquery.js'] = false;

 ?>
 
<div class="ThankyouPopup">
<div class="thank-youstore">
	<a class="close" href="#" onclick="closeBox()"> Close</a>
	<p >
	<span>CONGRATULATIONS, </span>

	<span>Your Store Information

	 <span>is  added Successfully,</span><br>

	 <span><a href="<?php echo CController::createUrl('/product/create'); ?>">CLICK HERE</a>,

	 <span>To Continue your experience of Karmio</span>
</p>
</div>
</div>
<script type="text/javascript">
function closeBox()
{
	
	$("#fancybox-overlay").hide();
	$("#fancybox-outer").hide();
	window.location = window.location;
}
</script>