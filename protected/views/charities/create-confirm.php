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
                    <div class="modify_container">
                        <div class="arrow_left"></div>
                        <a href="<?php echo CController::createUrl('charities/create', array('modify'=>1)); ?>"><div id="modify_link">MODIFY</div></a>
                    </div>
                    <p class="confirm_text charity_confirm_text_first_line"><?php echo Yii::app()->session['charity_name']; ?></p>
		    <p class="confirm_text"><?php echo Yii::app()->session['charity_owner_name']; ?></p>
                    <p class="confirm_text"><?php echo Yii::app()->session['charity_email']; ?></p>
                    <p class="confirm_text"><?php echo Yii::app()->session['charity_ein']; ?></p>
		</div>
		</div>
                <a href="<?php echo CController::createUrl('charities/create', array('confirmentry'=>1)); ?>">
                <button value="" id="bbtn">Submit</button>
                </a>
     </center>
     
                                  
</div>
</div>
</div>
</div>

<div class="clear"></div>

