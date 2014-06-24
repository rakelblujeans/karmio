<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg) ')});
</script>
<style>
.list-view .summary { display:none;}
</style>
 <div id="slider" style="min-height:865px;">
 <div id="MainBody" style="position:relative;">
            <div class="CenterAlign">
            <div class="HundredPercent">
<!--<div id="CompanyLogo"><a href="< ?php echo Yii::app()->getBaseUrl(true)?>"><img src="images/CompanyLogo.png" alt="logo"/></a></div>-->

<div id="HomePage">
<div class="SignInBox">
<div class="DashBoardBox" style="width:1029px; padding-right:20px;"> 
 
                  <!--Deal Box Start Here-->
                  <h1>MY OFFERED DEALS</h1>
                  <!--Purchase Box right Start Here-->
                  
                 <?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$cDeal,
		'itemView'=>'_view_box',
		//'summaryText'=>'',
	));  ?>
                  
                  <!--Purchase Box right End Here--> 
                  </div>
                










<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.mapBox',
		'config'=>array(
							'onClosed' => 'js:function(){
												$.ajax({
													type	: "POST",
													cache	: false,
													error	: function() {
														alert("error");
													}
												});

										return true;
											}'
						),
    	)
	);
?>
</div>
</div>


</div>
</div>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript">

function submitform()

{

var searching = $("#searching").val();

var errs = "";

var error= false;



if(searching == '' || searching=='coupon ID , name')

{

error=true;

$("#searching").addClass('error');

errs += "Enter coupon id or name";

}



if(error == false){

		$("#s-form").submit();

	}else{

		$(".errs").html(errs);

	}



}

</script>

