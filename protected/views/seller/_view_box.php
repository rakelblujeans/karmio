<?php $org = $data->getOrgInfo();?>
<?php $store = $data->getStoreInfo();?>
<?php $store=array(); $store = $data->getStoreInfo();
$user = $data->getUserTax();
$loc2 = $data->getStatename();
$cty2 = $data->getCityname();
$x = array();
$chk = array();
$x = $data->overAllSale();
$chk = $data->overAllSaleCheckin();
$date = new DateTime($chk->collection_date);
$chk->collection_date = $date->format('d M Y');



?>

                  <!--Purchase Box right Start Here-->
                  
                  <div class="DashBox" style="margin-top:50px;">
                    <div class="DashBoxLeft">
                      <h1> <?php echo $data->couponcode ?> </h1>
                      <p> Deal ID </p>
                      <p class="buyer"><a href="<?php echo CController::createUrl('/seller/exportBuyers', array('deal_id' => $data->id)); ?>" > <img src="images/printlist.png" width="122" height="40" /> </a> 
                      <a href="<?php echo CHtml::normalizeUrl(array('/seller/checkIn')); ?>" title="Check IN" class="PurpleLink">Check IN</a>
                      </p>
                    </div>
                    <div class="DashBoxRight" style="width:455px;">
                      <div class="TxtSimple"> <?php echo $data->name; ?></div>
                      <div> <a href="#" class="print" onclick="show_fineprint('fine-print<?php echo $data->id?>')">Fine Print</a> </div>
                      <hr/>
                      <br />
                      <p><?php echo $data->description?></p>
                      <div class="PriceBoxesLeft">
                        <ul>
                          <li><span>Original Price</span></span>
                          <span> /</span>
                          <li><span>Discount</span></li>
                          <span> / </span>
                          </ul>
                          <ul>
                         <li><span class="Redcolor">Amount towards Charity</span></li>
                          <span> / </span>
                          <li><span class="Redcolor" >Final Price</span></li>
                         
                          
                        </ul>
                        <ul>
                          <li>Coupons: </li>
                          <li><span class="Purplecolor">Checked in</span></li>
                          <span> / </span>
                          <li><span class="Redcolor">Sold</span></li>
                          <span> / </span>
                          <li><span class="BlackColor" >Offered</span></li>
                                                    
                        </ul>
                        <ul>
                          <li>Redeem dates </li>
                        </ul>
                      </div>
                      
                      
                       <div class="PriceBoxesRight" style="width:175px;">
                        <ul>
                          <li><span> $<?php echo round($data->regular_price) ?> </span></li>
                          <span> /</span>
                          <li><span> <?php echo round($data->price); ?> %</span></li>
                          
                         </ul>
                          <ul>
                           <li><span class="Redcolor"> $<?php echo $data->amount_share ?> </span></li>
                          <span> /</span>
                         <li><span class="Redcolor"> $<?php $disc = $data->regular_price*$data->price/100; echo round($data->regular_price - $disc)?> </span></li>
                        
                        </ul>
                        <ul>
                           <li><span class="Purplecolor"> <?php echo $data->CheckedCoupons?>  </span></li>
                          <span> /</span>
                          <li ><span class="Redcolor"> <?php echo $data->soldCoupons?> </span></li>
                          <span> /</span>
                          <li><span class="BlackColor"> <?php echo $data->coupons?> </span></li>
                         
                        </ul>
                        
                        <ul>
                        <?php $rd_start =  new DateTime($data->redeming_date_start);
						$rd_end =  new DateTime($data->redeming_date_end);
						?>
                          <li><?php echo $rd_start->format('d M Y');?> <span class="BlackColor">to</span> <?php echo $rd_end->format('d M Y');?> </li>
                        </ul>
                      </div>
                      
                    </div>
                  </div>
                  
                


<div style="clear:both;"></div>
<div class="fine-print" style="display:none; left:684px; margin-top:-181px" id="fine-print<?php echo $data->id?>">
<p style="text-align:right; margin:0px; margin-bottom:5px; "><a href="#" onclick="close_fineprint('fine-print<?php echo $data->id?>')">close</a></p>
<p>
<?php echo $data->fine_print?>
</p>
</div>



 <script type="text/javascript">

 function show_fineprint(id)
 {
 	
	if(document.getElementById(id).style.display=='block')
	document.getElementById(id).style.display='none';
	else
	document.getElementById(id).style.display='block';
	
 }
 function close_fineprint(id)
 {

 	$("#"+id).hide();
	
 }
 </script>

 