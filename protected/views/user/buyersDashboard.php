<?php
$this->pageTitle=Yii::app()->name . ' - Buyer Dshboard';
$this->breadcrumbs=array(
	'Login',
);
?>
<style>
.list-view .summary { display:none;}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg) ');
		 //$(".cheadingdeal").boxfit({multiline: true, width:455, height:35});

});
</script>
 <div id="slider" style="min-height:865px;">
 <div id="MainBody" style="position:relative;">
            <div class="CenterAlign">
            <div class="HundredPercent">
            <div id="HomePage">
<!--<div id="CompanyLogo"><a href="< ?php echo Yii::app()->getBaseUrl(true)?>"><img src="images/CompanyLogo.png" alt="logo"/></a></div>-->

<div id="HomePage">
                      <div class="bg-top" ></div>
                       <div class="bg-mid" >
                        <h3 class="PHeadTxt">MY PURCHASED DEALS</h3>

<?php 
//print_r($dataProvider->__get('id')); exit;
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_with_image_buyer',
	'id' => '#abcdef',
	 'afterAjaxUpdate'=>"function(id,data){ $('a[class=preview]').fancybox(); }",
	
)); ?>

</div>
<div class="bg-bottom" ></div>
</div>

</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
