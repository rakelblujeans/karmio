<?php
$this->pageTitle=Yii::app()->name . ' - Create Charity';
$this->breadcrumbs=array(
	'Charities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Charities', 'url'=>array('index')),
	array('label'=>'Manage Charities', 'url'=>array('admin')),
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
                    <h1 class="thankyou_heading">Congratulations!</h1>
                    <p class="thankyou_red_text">You have taken a great step forward.</p>
		    <p class="thankyou_red_text">We will get back to<br/>you very shortly.</p>
                    <p class="thankyou_text">email: <a href="mailto:team@karm.io">team@karm.io</a></p>
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

