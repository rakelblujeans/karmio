<div >
<ul>
<!--li><a href="<?php echo CController::createUrl('/site/about'); ?>"   <?php if(Yii::app()->controller->action->id == 'about'){?> class="current"<?php }?>>About </a></li-->

<!--li><a href="<?php echo CController::createUrl('/site/faq'); ?>" <?php if(Yii::app()->controller->action->id == 'faq'){?> class="current"<?php }?>>FAQ </a></li-->

<li><a href="<?php echo CController::createUrl('/site/contact'); ?>" <?php if(Yii::app()->controller->action->id == 'contact'){?> class="current"<?php }?>>Contact </a></li>
 
<li><a href="<?php echo CController::createUrl('/site/terms'); ?>" <?php if(Yii::app()->controller->action->id == 'terms'){?> class="current"<?php }?>>Terms </a></li>

<li><a href="<?php echo CController::createUrl('/site/privacypolicy'); ?>" <?php if(Yii::app()->controller->action->id == 'privacypolicy'){?> class="current"<?php }?>>Privacy </a></li>

</ul>
</div>