 <?php $org = $data->getOrgInfo();
 ?>
 
<div class="l-deal">
  <div class="deal-title"><?php echo CHtml::encode($data->name); //Deal Name?></div>
  <div class="deal-regular-price">
   <div class="regular-price-r">$<?php echo CHtml::encode($data->regular_price); //Deal Regual Price?><br /><span>regular price</span></div>
   <div class="regular-price-r">$<?php echo CHtml::encode($data->price); //Deal Sale Price?><br /><span>deal price</span></div>
  </div>
  <div class="sold-price">
   <div class="s-pledged">[$<?php echo $data->amount_share;?>]<br /><span class="checked">pledged</span></div>
   <div class="s-pledged"><?php  echo $data->percentage_share; ?>%<br /><span class="checked">pledged</span></div>
    <div class="s-pledged"></div>
	 <div class="pdf-down"><?php echo CHtml::link('Download PDF',array('seller/Downloadpdf',
                                         'pid'=>$data->id,'orgid'=>$data->organization_id)); ?></div>
  </div>
  <div class="deal-suspend">
	<div class="status-update">
	</div>
    <br style="clear:both" />
  </div>
 </div>
 <div class="result-right">
   <div class="pro-image"><img src="images/orgLogos/<?php echo CHtml::encode($org->logo); ?>" alt="<?php echo CHtml::encode($org->name);?>" /></div>
  </div>
  <br style="clear:both" />
 <hr style="clear:both; color:#40b0e5;" />
 
