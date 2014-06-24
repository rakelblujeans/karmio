<?php
$this->pageTitle=Yii::app()->name . ' - Create Store';
$this->breadcrumbs=array(
	'Stores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stores', 'url'=>array('index')),
	array('label'=>'Manage Stores', 'url'=>array('admin')),
);
?>

?>
<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/newsletter.css");
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseurl . "/css/charity-biz-signup.css");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl . "/js/newsletter.js");
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl . "/js/charity-biz-signup.js");
?>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
 

 <div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            <div id="HomePage">
     
     <center>
		<div class="videodiv">
		<div class="iframestyle" id="vtext">
                    <p class="thankyou_red_text biz_thanks_red_text">Thank you! for signing up.</p>
		    <p class="thankyou_red_text">We will get back to you shortly</p>
                    <p class="thankyou_red_text">If you have any questions,<br/>
		    email us at <span class="biz_thanks_text"><a href="mailto:team@karm.io">team@karm.io</a></span></p>
		</div>
		</div>
                <a href="<?php echo CController::createUrl('site/index'); ?>">
                <button value="" id="bbtn">Close</button>
                </a>
     </center>
     
                                  
</div>
</div>
</div>
</div>

<div class="clear"></div>

