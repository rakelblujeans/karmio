<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?>
<script type="javascript">
	alert('test');
	$('#fancybox-wrap').width('694');
	$('#fancybox-content').width('674');
	$.fancybox.resize();
</script>
<div class="thank-you" style="width:634px;">
	<img src="images/logo.png" alt="" style="margin-left:15px;" /><br>
	<span>CONGRATULATIONS, YOU ARE SUCCESSFULLY SIGNED UP,<br>
	<a href="<?php echo Yii::app()->user->returnUrl; ?>">CLICK HERE</a>, TO CONTINUE YOUR EXPERIENCE OF PLEDGEON</span>
</div>
