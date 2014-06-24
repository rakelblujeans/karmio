<style>
#fancybox-wrap {
    left: 113px !important;
}
.RedBoxContents {
    background: url("<?php echo Yii::app()->baseUrl?>/images/RedBox.png") no-repeat scroll 0 0 transparent;
    color: #FFFFFF;
    display: block;
    float: left;
    height: 80px;
    margin: 3px 0 0px -3px;
    padding: 20px 25px 20px 35px;
    position: relative;
    text-align: center !important;
    width: 328px;
    z-index: 10;
}
.CouponPrice {
    display: inline-block;
    font-size: 32px;
    font-weight: bold;
}
.CouponDetail {
    display: inline-block;
    float: none;
    font-size: 13px;
    font-weight: normal;
    padding: 10px 0 0;
}
</style>
<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
$org = $data->product->getOrgInfo();
$store = $data->product->getStoreInfo();
$chk = $data;//UserPurchase::model()->find('product_id='.$data->id.' AND user_id='.Yii::app()->user->id);
$date = new DateTime($chk->collection_date);
$chk->collection_date = $date->format('d M Y');

$date2 = new DateTime($data->product->redeming_date_end);
$chk->expiry_date = $date2->format('d M Y');
 ?>
<div class="signuppopup" style="width:660px; ">
<div style="text-align:right">
<a href="#" onclick="javascript:window.print()">Print</a>
</div>
<table border="0" cellspacing="0" cellpadding="0" style=" width:660px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#999999">
  <tr>
    <td align="left" valign="top">
		<table  border="0" cellspacing="1px" cellpadding="1px" style="width:330px;">
		  <tr>
			<td align="center" valign="top"><img src="images/logo.png" width="150" height="197" style="margin:2px 0px 25px 0px" /></td>
		  </tr>
		  <tr>
			<td align="left" valign="top"><b>notes/appointments</b>
            <?php for($i=0; $i<20; $i++){?>
            <li style="width:100%; border-bottom:1px solid #999999; list-style:none">&nbsp;</li>
            <?php }?>
 
 			</td>
		  </tr>
		  <tr>
			<td align="center" valign="top"><img src="images/clearpixel.gif" width="100%" height="55" /></td>
		  </tr>
		  <tr>
			<td align="center" valign="top" style="background-color:#1d1d1b; color:#9d9d9c; font-size:24px; font-weight:bold; margin-top:10px;">KODE <b style="color:#FFFFFF"><?php echo $cp_code?></b></td>
		  </tr>
		  <tr>
			<td align="center" valign="top"><img src="images/clearpixel.gif" width="100%" height="55"/></td>
		  </tr>
		</table>
	</td>
    <td align="left" valign="top">
		<table width="330" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td align="right" valign="top">
				<table border="0" cellspacing="3" cellpadding="2" style=" width:265px; color:#000">
				  <tr>
					<td align="center" valign="top"><img src="<?php echo ($data->product->picture)?$data->product->picture:'images/orgLogos/GreenBank.jpg'; ?>" width="235" height="140"></td>
				  </tr>
				  <tr>
					<td align="left" valign="top"><p style="margin:5px 20px 5px 20px;"><div class="cheading" id="cheading<?php echo $data->product->id ?>"><?php echo $data->product->name ?></div></p></td>
				  </tr>
				  <tr>
					<td width="235px" style="padding:5px 20px 5px 20px; border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:2px;" align="left" valign="top" height="25px"><b><?php echo $data->product->description ?></b></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" style="color:#FF0000; padding:0px 20px 0px 20px"><h1>$<?php $disc = round(($data->product->price*$data->product->regular_price)/100);
								echo round($data->product->regular_price-$disc);   ?></h1><p>pledge included</p></td>
				  </tr>
				  <tr>
					<td align="center" valign="top">
						<!--<table  width="265" height="79" border="0" cellspacing="0" cellpadding="0" style="color:#FFFFFF; background:url(images/coupon_red.jpg) no-repeat;">
						  <tr>
							<td width="36" align="center" valign="middle" style="padding-left:15px; padding-top:5px;"><h2>$<?php echo $data->product->amount_share?></h2></td>
							<td width="78" align="left" valign="middle" style="padding:0px 5px;"><p>from every<br /> coupon will<br /> be donated to</p></td>
							<td width="151" align="left" valign="middle"><b> <?php echo ($data->product->charity->name != '')? $data->product->charity->name: $data->charity->name; ?></b></td>
						  </tr>
						</table>-->
                        <div class="RedBoxContents">
                                                  <span class="CouponPrice">$<?php echo round($data->product->amount_share); ?></span>
                                                  <p class="CouponDetail">from every coupon will be donated to</p>
                                                   <h3 class="CouponTitle">
                                                           <?php echo ($data->product->charity->name != '')? $data->product->charity->name: $data->charity->name; ?>
                                                       </h3>
                                                        </div>
					</td>
				  </tr>
				</table>

			</td>
		  </tr>
		  <tr>
			<td align="center" valign="top">
				<table border="0" cellspacing="6" cellpadding="6" style="color:#1d1d1b; font-size:12px; width:330px;">
				  <tr>
					<td width="86" align="right" valign="top" style="margin-right:5px"><b>LOCATION: </b></td>
					<td width="202" align="left" valign="top"> <?php echo $store->address ?> <br /> 
				    <?php echo $store->location_id ?> <br /> <?php echo $store->state_id ?> <?php echo $store->zip ?></td>
				  </tr>
				  <tr>
					<td align="right" valign="top" style="margin-right:5px"><b>TEL: </b></td>
					<td align="left" valign="top"><?php echo CHtml::encode($store->phone); ?> </td>
				  </tr>
				  <tr>
					<td align="right" valign="top" style="margin-right:5px"><b>WEB: </b></td>
					<td align="left" valign="top"><?php echo CHtml::encode($store->website); ?></td>
				  </tr>
				  <tr>
					<td align="right" valign="top" style="margin-right:5px"><b>EXPIRES: </b></td>
					<td align="left" valign="top"><?php echo $chk->expiry_date?></td>
				  </tr>
				  <tr>
					<td align="right" valign="top" style="margin-right:5px"><b>FINE PRINT: </b></td>
					<td align="left" valign="top"><p style="font-size:11px; "><?php echo $data->product->fine_print?></p></td>
				  </tr>
				</table>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="top"><img src="images/dotted.png" height="14" width="100%" /><h3 style="color:#000000; font-size:16px">EMAIL CUSTOMERSERVICE@KARM.IO</h3></td>
  </tr>
</table>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
<script type="text/javascript">
 jQuery(document).ready(function(){
			   
               $("#cheading<?php echo $data->product->id ?>").boxfit({multiline: true});
 });
</script>