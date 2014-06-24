<div class="dashboardLinks">
<?php if(isset(Yii::app()->user->isBuyer))
{?>
	<a href="<?php echo CController::createUrl('/user/buyersDashboard'); ?>">Purchase Details</a>
<?php }?>
<?php if(isset(Yii::app()->user->isSeller))
{
	echo ' | ';
?>
	<a href="<?php echo CController::createUrl('/seller'); ?>">Sales Details</a>
<?php }?>
</div><br />
<div class="dashboardLinks">
<?php if(isset(Yii::app()->user->isBuyer))
{?>
	<a href="#"><img src="images/nonprofit.jpg" border="0" /></a>
<?php }?>
</div>
<div class="clear"></div>
<div class="deal">
 <div class="current-deals">
  <div class="t-deal">DASHBOARD</div>
 </div>
 <div style="height:189px; border-bottom: #ff735c solid 1px">
 	<div style="margin-top:30px; font-size:33px">
    	<div style="width:411px; float:left">COUPON CONTROL</div>
        <div style="float:right; width:636px">
        	<div>USER DATA</div>
            <div style="margin-top:20px">
            	<form>
            		<input type="text" class="search-field" name="">
                    <input type="submit" value="" class="search-buttom" name="">
                </form>
            </div>
        </div>
    </div>
 </div>
 <div style="height:202px; border-bottom: #41b0e5 solid 17px;">
 	<div style="height:51px; margin-top: 19px; font-size:33px">
    	COUPON CONTROL
    </div>
    <div>
		<form action="<?php echo CController::createUrl('/seller/dashboard'); ?>" id="dashboard-status-form" method="post">
			<input type="image" src="images/published.png" name="published"/>
			<input type="image" src="images/holding.png" style="margin-left:35px" name="holding"/>
			<input type="image" src="images/suspended.png" style="margin-left:35px" name="suspended"/>
			<input type="image" src="images/unpublished.png" style="margin-left:35px" name="unpublished"/>
		</form>
    </div>
 </div>

 <!-- widget here -->
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$cDeal,
		'viewData'=>array('status'=>$status),
		'itemView'=>'_view_box_dashboard',
		//'summaryText'=>'',
	)); ?>
 <br style="clear:both; " />
 
 
</div>
<?php

	$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.mapBox',
		'config'=>array(),
    	)
	);
?>
