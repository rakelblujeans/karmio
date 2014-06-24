 <?php require_once('protected/extensions/fpdf172/fpdf.php'); ?>
<br style="clear:both" />
<div class="dashboardLinks">
<?php if(isset(Yii::app()->user->isBuyer))
{?>
	<a href="<?php echo CController::createUrl('/user/buyersDashboard'); ?>">Purchase Details</a>
<?php }?>
<?php if(isset(Yii::app()->user->isAdmin))
{
	echo ' | ';
?>
	<a href="<?php echo CController::createUrl('/seller/dashboard'); ?>">Admin Panel</a>
<?php }?>
</div>
<div class="deal">
 
 <div class="current-deals" style="background:#41b0e5;margin-top:20px;">
  <div class="t-deal">SHARE ON DEALS</div>
  <div class="t-total"><?php //echo $pData->quantity; ?></div>
  <div class="t-average"><?php //echo $pData->paid_price+$pData->donated; ?></div>
  <div class="t-gross"><?php //echo $pData->paid_price; ?></div>
  <div class="t-pleged"><?php //echo $pData->donated; ?></div>
 </div>
 <?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$cDeal,
		'itemView'=>'_view_box_share',
		//'summaryText'=>'',
	)); ?>
 <?php /*?><?php foreach($cDeal as $t)
 {
?>
 <div class="l-deal">
  <div class="deal-title"><?php echo CHtml::encode($t->name); //Deal Name?></div>
  <div class="deal-regular-price">
   <div class="regular-price-r">$<?php echo CHtml::encode($t->regular_price); //Deal Regual Price?><br /><span>regular price</span></div>
   <div class="regular-price-r">$<?php echo CHtml::encode($t->price); //Deal Sale Price?><br /><span>deal price</span></div>
  </div>
 <div class="sold-price">
   <div class="sold"><?php echo $t->amount_share; ?><br /><span class="checked">Shared Amount</span></div>
   <div class="s-gross"><?php echo $t->percentage_share; ?>%<br /><span class="checked">Percentage</span></div>
   <div class="net-incom"><?php //echo $t->paid_price;?><br /><span class="checked"></span></div>
   <div class="s-pledged"><?php //echo $t->donated;?><br /><span class="checked"></span></div>
  
  </div></div>
   <div class="result-right">
   <div class="pro-image"><img src="images/orgLogos/<?php //echo CHtml::encode($org->logo);  ?>" alt="" /></div>
  </div>
  <br style="clear:both" />
 <hr style="clear:both; color:#40b0e5;" />
<?php  } ?><?php */?>
</div>
<?php

	$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.mapBox',
		'config'=>array(),
    	)
	);
?>