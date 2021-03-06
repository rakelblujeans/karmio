
 <?php $org = $data->getOrgInfo();?>
 <?php $store = $data->getStoreInfo();?>
<div class="l-deal">
  <div class="deal-title"><?php echo CHtml::encode($data->name); //Deal Name?></div>
  <div class="deal-regular-price">
   <div class="regular-price-r">$<?php echo CHtml::encode($data->regular_price); //Deal Regual Price?><br /><span>regular price</span></div>
   <div class="regular-price-r">$<?php echo CHtml::encode($data->price); //Deal Sale Price?><br /><span>deal price</span></div>
  </div>
  <div class="sold-price">
<?php $x = array();
	$x = $data->overAllSale();
?>
   <div class="sold"><?php echo $x->quantity; ?><br /><span class="checked">sold/checked-in</span></div>
   <div class="s-gross">$<?php echo $x->paid_price+$x->donated;?><br /><span class="checked">gross income</span></div>
   <div class="net-incom">$<?php echo $x->paid_price;?><br /><span class="checked">net income</span></div>
   <div class="s-pledged">[$<?php echo $x->donated;?>]<br /><span class="checked">pledged</span></div>
   <div class="time-remaining">5h 43m 1s <span>(<?php echo $data->expiry_date; ?>)</span><br /><span class="checked">pledged</span></div>
  </div>
  <div class="deal-suspend">
   <div class="plus-minus" id="plus-minus"><a id="imageDivLink-<?php echo $data->id; ?>" href="javascript:toggle('show-text-<?php echo $data->id; ?>', 'imageDivLink-<?php echo $data->id; ?>');"><img src="images/plus.png" alt="" border="0" /></a></div>
	
	<div class="status-update">
		<form action="<?php echo CController::createUrl('/seller/dashboard'); ?>" id="dashboard-status-update-form" method="post">
			<input type="hidden" name="id" value="<?php echo $data->id;?>" />
			<input type="hidden" name="status" value="<?php echo $status; ?>" />
			<?php if($data->status == 'published')
			{
					// if published, we can only suspend it
			?>
				<input type="hidden" name="status_update" value="suspended" />
				<input type="image" src="images/status_update_suspend.png" />
			<?php
			}
			else if ($data->status != 'suspended')
			{?>
				<input type="hidden" name="status_update" value="published" />
				<input type="image" src="images/status_update_publish.png" />
			<?php
			}?>
		</form>
	</div>
   <div class="show-text" id="show-text-<?php echo $data->id;?>">
    <p><?php echo CHtml::encode($data->description); //Deal Description?></p>
    </div>
    <br style="clear:both" />
    <div class="d-location">LOCATION: 
    <span><?php echo CHtml::link(CHtml::encode($store->address),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address?></span></div>
    
  </div>
 </div>
 <div class="result-right">
   <div class="pro-image"><img src="images/orgLogos/<?php echo CHtml::encode($org->logo); ?>" alt="<?php echo CHtml::encode($store->name).' logo';?>" /></div>
  </div>
  <br style="clear:both" />
 <hr style="clear:both; color:#40b0e5;" />
 
