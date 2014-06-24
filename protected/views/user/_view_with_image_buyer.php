<style>
#fancybox-wrap{ left:500px !important;}
/*.signuppopup{ width:1010px !important;}*/
</style>
<?php 
$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.preview',
		'config'=>array(

							'enableEscapeButton'	=> true,
							'showCloseButton'		=> true,
							'hideOnOverlayClick'	=> false,
							'centerOnScroll'		=> true,
							'margin-top'			=> '5',
							'onClosed'			=> 'js:function(){
														$("#preview").hide();
														return true;
													}',
							'onComplete'			=> 'js:function(){
							$("#fancybox-content").css({"border-color":"#404040"});
							$("#fancybox-wrap").css({"left":"310px !important", "margin-left":"190px"});
															updateWidthFancy();
										

														}'

					),

    	)
	);
	?>
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
	$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.gft',
		'config'=>array(
						'enableEscapeButton'	=> true,
							'showCloseButton'		=> false,
							'hideOnOverlayClick'	=> true,
							'centerOnScroll'		=> true,
							'onComplete'			=> 'js:function(){
															updateWidthFancy();
														}'
						),
    	)
	);
$org = $data->purchase->product->getOrgInfo();
$store = $data->purchase->product->getStoreInfo();
$gft=$data->purchase->product->getGiftqunt($data->purchase->product->id); 
$store=array(); $store = $data->purchase->product->getStoreInfo();
$chk = UserPurchase::model()->find('product_id='.$data->purchase->product->id.' AND user_id='.Yii::app()->user->id);
$date = new DateTime($chk->collection_date);
$chk->collection_date = $date->format('d M Y');
$date2 = new DateTime($data->purchase->product->redeming_date_end);
$chk->expiry_date = $date2->format('d M Y');
?>
<div class=""> 
                <!--Deal Box Start Here-->
               
                
                <!--Purchase Box Start Here-->
                <div class="PurchaseBox">
              
<div class="PurchaseBoxLeft">
  <div class="Cuponco"> <p class="cupontxt"><?php echo $data->invoice_id?> </p> <p class="cupontxtBlue">  COUPON CODE </p> </div>

 <div class="Cuponprc"> <p class="Cuponprctxt"><?php echo $chk->collection_date?> </p> <p class="CuponprctxtBlue">  PURCHASED </p> </div>
  <div class="Cuponprc"> <p class="Cuponprctxt"><?php echo $chk->expiry_date ?> </p> <p class="CuponprctxtBlue">  EXPIRES  </p> </div>
                </div>
                
                
                 <!--Purchase Box right Start Here-->
                  <div class="PurchaseBoxRight">
                   <div class="copyimg"> 
                   <?php echo CHtml::link('<img src="images/icon.png" width="36" height="34" />', CController::createUrl('user/printpopup', array('id' => $data->purchase->product->id, 'pid' => $data->purchase->id, 'cid' => $data->id)), array('class' => 'preview'));?>
                    </div>
                    <div class="PurchaseBoxTop"></div>
                    <div class="PurchaseBoxMid">
                    
                      <div class="PurchaseBoxMidleft">
                        <h1><?php echo CHtml::encode($data->purchase->product->name); //Deal Name?></h1>
                        <div class="mapDiv"> map it 
                        <?php echo CHtml::link('<img src="images/map_icon.png" alt="" height="22" width="19" border="0" align="bottom" />',array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address?>
                         </div>
                        <div class="crusisDiv"><p> <b><?php echo CHtml::encode($store->name);//Store Name?></b> </p>
                          <p><?php echo $store->address ?> &nbsp;<?php echo $store->location_id; ?>, &nbsp;<?php echo $store->state_id.' '.$store->zip; ?> </p>
                          <p> <?php echo CHtml::encode($user->cellphone); ?> </p>
                          
                          
                          
                        </div>
                    </div>
                   
                    <div class="PurchaseBoxMidright">
                       <h1> $<?php $disc = round(($data->purchase->product->price*$data->purchase->product->regular_price)/100);
								echo round($data->purchase->product->regular_price-$disc); ?> </h1>
                       <p> Pledge included </p>
                   </div>
                      </div>
                      <div class="PurchaseBoxBottom">
                      <p class="cheadingdeal" id="cheading<?php echo $data->id?>"> <strong> <?php   echo ($data->purchase->product->ein != '')?$data->purchase->product->charity->name:$data->purchase->charity->name; ?></strong> was supported for 
                       <h1> $<?php echo $data->purchase->product->amount_share?> </h1>
                       </p>
                      
                      </div>
                      <div class="fine-print"  id="fine-print<?php echo $data->purchase->product->id?>">
                        <p style="text-align:right; margin:0px; margin-bottom:5px; "><a href="javascript:void(-1)" onclick="close_fineprint('fine-print<?php echo $data->purchase->product->id?>')">close</a></p>
                        <p>
                        <?php echo $data->purchase->product->fine_print?>
                        </p>
                        </div>
                      <p class="fineTxt"><a href="javascript:void(-1)" onclick="show_fineprint('fine-print<?php echo $data->purchase->product->id?>')">Fine Print</a></p>
                    
                    </div>
                    
                   
                  </div>
                  
                  <!--Deal Box Ends Here--> 
                  
                  
                  
                  
                </div>

<?php Yii::app()->clientScript->registerScript('boxfit',' $("#cheading'.$data->id.'").boxfit({multiline: true, width:455, height:35});', CClientScript::POS_READY);
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	// $("#cheading<?php echo $data->id?>").boxfit({multiline: true, width:455, height:35});
});
</script>
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

