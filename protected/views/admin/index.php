
<br style="clear:both" />
<div class="deal">
 <div class="current-deals">
  <div class="t-deal">CURRENT DEALS</div>
  <div class="t-total"><?php echo $cData->quantity; ?></div>
  <div class="t-average">$<?php echo $cData->paid_price+$cData->donated; ?></div>
  <div class="t-gross">$<?php echo $cData->paid_price; ?></div>
  <div class="t-pleged">[$<?php echo $cData->donated; ?>]</div>
 </div>
 <!-- widget here -->
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$cDeal,
		'itemView'=>'_view_box',
		//'summaryText'=>'',
	)); ?>
 
 <div class="current-deals" style="background:#41b0e5;margin-top:20px;">
  <div class="t-deal">PREVIOUS DEALS</div>
  <div class="t-total"><?php echo $pData->quantity; ?></div>
  <div class="t-average">$<?php echo $pData->paid_price+$pData->donated; ?></div>
  <div class="t-gross">$<?php echo $pData->paid_price; ?></div>
  <div class="t-pleged">[$<?php echo $pData->donated; ?>]</div>
 </div>
 <!-- widget here -->
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$pDeal,
		'itemView'=>'_view_box',
		//'summaryText'=>'',
	)); ?>
 
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
