 <div id="postdealrow">

<?php $this->renderPartial('admin_menu');?>

</div>





<div id="postdealrow">

 <div class="current-deals">

  <div class="t-deal">DASHBOARD</div>

 </div>

<div class="rowleft">

<div class="headingcoupon">Search Coupon</div>



</div><!--rowleft-->

<div class="rowcenterlong">

<form action="<?php $searching=''; echo CController::createUrl('searchcoupon', array('searching' => $searching)); ?>" name="" method="post" id="s-form">

 		<div style="color:#FF0000; font-size:10px" class="errs"></div>

       <input type="text" name="searching" id="searching" class="header-searchleft" value="coupon ID , name" onfocus="if(this.value=='coupon ID , name')this.value='';" onblur="if(this.value=='')this.value='coupon ID , name';" />

	  



       <input type="button" name="" class="header-searchright" value="" onclick="submitform()" />



      </form>	  

</div><!--rowcenter-->



</div><!--postdealrow-->



 <div id="postdealrow">

			<div class="admin-pub" style="background:#FD2B0D repeat"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'published')); ?>">PUBLISH</a></div>

			<div class="admin-hol" style="background:#41b0e5 repeat"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'holding')); ?>">HOLDING</a></div>

			<div class="admin-sus" style="background:#666666 repeat"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'suspended')); ?>">SUSPENDED</a></div>

			<div class="admin-unpub" style="background:#000000 repeat"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'unpublished')); ?>">UNPUBLISHED</a></div>

				<div class="admin-sold" style="background:#CCCCCC repeat"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'sold_out')); ?>">SOLD OUT</a></div>

					<div class="admin-end" style="background:#FF0000 repeat"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'ended')); ?>">ENDED</a></div>

 <br />

					<div class="admin-pub"a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'published')); ?>">(<?php echo $countpub;?>)</a></div>

					<div class="admin-hol"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'holding')); ?>">(<?php echo $counthold;?>)</a></div>

					<div class="admin-sus"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'suspended')); ?>">(<?php echo $countsus;?>)</a></div>

					<div class="admin-unpub"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'unpublished')); ?>">(<?php echo $countunpub;?>)</a></div>

					<div class="admin-sold"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'sold_out')); ?>">(<?php echo $countsold;?>)</a></div>

				<div class="admin-end"><a href="<?php echo CController::createUrl('/seller/dashboard', array('status' => 'ended')); ?>">(<?php echo $countend;?>)</a></div>  

  

	<div style="height:auto; margin-top: 50px; font-size:30px; vertical-align: bottom">

    	<?php  if($status =='holding'){ echo ucwords('holding');} elseif($status =='unpublished'){ echo ucwords('unpublished');} elseif($status =='sold_out'){ echo ucwords('sold out');} else { echo ucwords($status);} ?>&nbsp;Deals

    </div>

	<div style="height:15px; border-bottom: <?php if($status == 'holding'){?>#41b0e5 <?php } ?> <?php if($status == 'published'){?> #FD2B0D <?php } ?> <?php if($status == 'suspended'){?>#666666<?php } ?> <?php if($status == 'unpublished'){?>#000000<?php } ?><?php if($status == 'sold_out'){?>  #CCCCCC <?php } ?> <?php if($status == 'ended'){?> #FF0000 <?php } ?>  solid 17px;">

    </div>

 </div>



 <!-- widget here -->

 <div id="postdealrow">

	<?php 

	if($status=='ended')

	{

		$this->widget('zii.widgets.CListView', array(

		'dataProvider'=>$cDeal,

		'viewData'=>array('status'=>'published'),

		'itemView'=>'_view_box_dashboardend',

		//'summaryText'=>'',

	)); 

	}

	elseif($status=='sold_out')

	{

		$this->widget('zii.widgets.CListView', array(

		'dataProvider'=>$cDeal,

		'viewData'=>array('status'=>'published'),

		'itemView'=>'_view_box_dashboardsold',

		//'summaryText'=>'',

	)); 

	}

	else

	{

	$this->widget('zii.widgets.CListView', array(

		'dataProvider'=>$cDeal,

		'viewData'=>array('status'=>$status),

		'itemView'=>'_view_box_dashboard',

		//'summaryText'=>'',

	)); 

}

	?>

 



<?php



	$this->widget('application.extensions.fancybox.EFancyBox', array(

    	'target'=>'a.mapBox',

		'config'=>array(),

    	)

	);

?>

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

