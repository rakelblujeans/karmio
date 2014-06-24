<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?>
<div class="signuppopup" id="signup" style="top:0;">
 <div  class="signupleft">
 <a href="javascript:fancyLoad('<?php echo CController::createUrl('user/signupBuyer')?>', 'signup');"><img src="images/checkbox.png" /></a>
 </div>
 
 <div class="signuplright"><a href="javascript:fancyLoad('<?php echo CController::createUrl('user/signupBuyer')?>', 'signup');">ME</a></div>
 <p>&nbsp;</p>
  <div  class="signupleft"><a href="javascript:fancyLoad('<?php echo CController::createUrl('user/signupSeller')?>', 'signup');"><img src="images/checkbox.png" /></a>
  </div>
  <div class="signuplright"><a href="javascript:fancyLoad('<?php echo CController::createUrl('user/signupSeller')?>', 'signup');">Business</a></div>
</div>
