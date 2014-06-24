<div id="postdealrow">

<div class="dashboardLinks">
<?php if(isset(Yii::app()->user->isAdmin))
{ ?>
	<a href="<?php echo CController::createUrl('/user/admin'); ?>">User</a>
<span><?php echo ' | '; }?></span>
<?php if(isset(Yii::app()->user->isAdmin))
{ ?>
	<a href="<?php echo CController::createUrl('/seller/dashboard'); ?>">Dashboard</a>
<span><?php  echo ' | ';}?></span>
<?php if(isset(Yii::app()->user->isAdmin))
{?>
	<a href="<?php echo CController::createUrl('/userPurchase/admin'); ?>">Deal Purchase List</a>
<span><?php }?></span>
<?php if(isset(Yii::app()->user->isBuyer))
{ ?>
	<a href="<?php echo CController::createUrl('/user/buyersDashboard'); ?>">Purchase Details</a>
<?php  }?>
<?php if(isset(Yii::app()->user->isSeller))
{
	echo ' <span> | </span> ';
?>
	<a href="<?php echo CController::createUrl('/seller'); ?>">Sales Details</a>
<?php }?>
<?php if(isset(Yii::app()->user->isAdmin))
{  echo ' <span> | </span> ';?>
	<a href="<?php echo CController::createUrl('/administrator/admin'); ?>">FAQs</a>
<?php }?>

<?php if(isset(Yii::app()->user->isAdmin))
{?>
<a href="<?php echo CController::createUrl('/seller/dashboard'); ?>"><img src="images/bk.png" ></a>
<?php } ?>
</div>
</div>


<div id="postdealrow">

	 <div class="current-deals">
  	<div class="t-deal">Search Result</div>
 	</div>
 
 <div class="rowleft">
	<div class="headingcoupon">COUPON CONTROL</div>
</div><!--rowleft-->
<div class="rowcenterlong">
 <form action="<?php echo CController::createUrl('searchcoupon', array('searching' => $searching)); ?>" name="" method="post" id="s-form">
 		<div style="color:#FF0000; font-size:10px" class="errs"></div>
       <input type="text" name="searching" id="searching" class="header-searchleft" value="coupon ID , name" onfocus="if(this.value=='coupon ID , name')this.value='';" onblur="if(this.value=='')this.value='coupon ID , name';" />
	  

       <input type="button" name="" class="header-searchright" value="" onclick="submitform()" />

      </form>
 

	</div>
	  <div style="margin-top:110px; height:11px;border-bottom:#FF0000 solid 17px;"></div>

	</div>
	 
<div id="postdealrow">
 <?php 
 if(isset($searching)){}else {$searching="";}
 
 if(!empty($msg)){ echo $msg; } else{?>
<?php 
$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$pDatum,
		'viewData'=>array('searching'=>$searching),
		'itemView'=>'_view_coupon',)); 
		?>
		<?php } ?>
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
