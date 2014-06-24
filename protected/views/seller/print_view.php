<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Karmio PDF</title>
<style type="text/css">
hr { border-width: 1px 0 0 0; 
margin-bottom:10px;}
</style>
</head>

<body>
<?php $store=array(); $store = $data->getStoreInfo();

 $user = $data->getUserTax();

    $loc2 = $data->getStatename();

  $cty2 = $data->getCityname();

?>

 <?php

$description="";

 $description=$data->fine_print; ?>

<table width="660" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#999999">
  <tr>
    <td align="left" valign="top">
		<table width="330" border="0" cellspacing="1px" cellpadding="1px">
		  <tr>
			<td align="center" valign="top"><img src="images/pdf_images/logo.png" width="150" height="197" style="margin:2px 0px 25px 0px" /></td>
		  </tr>
		  <tr>
			<td align="left" valign="top"><b>Notes/Appointments</b><p style="margin:5px 5px 5px 5px; padding:0px ">
<hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/><hr/> </p>			</td>
		  </tr>
		  <tr>
			<td align="center" valign="top"><img src="images/pdf_images/clearpixel.gif" width="100%" height="55" /></td>
		  </tr>
		  <tr>
			<td align="center" valign="top" style="background-color:#1d1d1b; color:#9d9d9c; font-size:24px; font-weight:bold">KODE <b style="color:#FFFFFF"><?php echo $data->couponcode;?></b></td>
		  </tr>
		  <tr>
			<td align="center" valign="top"><img src="images/pdf_images/clearpixel.gif" width="100%" height="55"/></td>
		  </tr>
		</table>
	</td>
    <td align="left" valign="top">
		<table width="330" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td align="right" valign="top">
				<table width="265" border="0" cellspacing="3" cellpadding="2" style="color:#000">
				  <tr>
					<td align="center" valign="top"><img src="<?php echo ($data->picture)?$data->picture:'images/orgLogos/GreenBank.jpg'; ?>" height="140" width="235"/></td>
				  </tr>
				  <tr>
					<td align="left" valign="top"><p style="margin:5px 20px 5px 20px;">    <?php echo strtoupper($data->name); //Deal Name?></p></td>
				  </tr>
				  <tr>
					<td width="235px" style="padding:5px 20px 5px 20px; border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:2px;" align="left" valign="top" height="25px"><b>WILLIAMSBURD SMILE DESIGN</b></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" style="color:#FF0000; padding:0px 20px 0px 20px"><h1> 
                       $<?php if(!empty($data->price)) { echo round($data->price); } else { echo round($data->regular_price);  } //Deal Regual Price?></h1><p>pledge included</p></td>
				  </tr>
				  <tr>
					<td align="center" valign="top">
						<table background="images/pdf_images/coupon_red.jpg" width="265" height="79" border="0" cellspacing="0" cellpadding="0" style="color:#FFFFFF">
						  <tr>
							<td width="36" align="center" valign="middle"><h2>$
							<?php echo round($data->amount_share); //Deal Regual Price?></h2></td>
							<td width="78" align="left" valign="middle"><p>from every<br /> coupon will<br /> be donated to</p></td>
							<td width="151" align="left" valign="middle"><b>American Cancer Society</b></td>
						  </tr>
						</table>
					</td>
				  </tr>
				</table>
 <?php 
	echo $cname= $data->charity->name;

	
//$cname = $data->charity->name;
 ?>

			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top">
				<table width="330" border="0" cellspacing="6" cellpadding="6" style="color:#1d1d1b; font-size:14px;">
				  <tr>
					<td width="86" align="right" valign="top"><b>LOCATION</b></td>
					<td width="202" align="left" valign="top">  <?php //print_r($store->attributes);
if(empty($data->address)){


   echo strtoupper($store->address); //store address?><br /><?php echo strtoupper($loc2->value); ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<?php echo $store->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php

	}

	else

	{

	strtoupper($data->address);
	?><br /><?php echo $loc2->value; ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<?php //echo $data->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php }?></td>
				  </tr>
				  <tr>
					<td align="right" valign="top"><b>TEL</b></td>
					<td align="left" valign="top">not available </td>
				  </tr>
				  <tr>
					<td align="right" valign="top"><b>WEB</b></td>
					<td align="left" valign="top">not available</td>
				  </tr>
				  <tr>
					<td align="right" valign="top"><b>EXPIRES</b></td>
					<td align="left" valign="top"><b><?php echo $data->expiry_date?></b></td>
				  </tr>
				  <tr>
					<td align="right" valign="top"><b>FINE PRINT</b></td>
					<td align="left" valign="top"><p style="font-size:11px; "><?php echo $data->fine_print;?></p></td>
				  </tr>
				</table>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="top"><img src="images/pdf_images/dotted.png" height="14" width="100%" /><h3 style="color:#000000; font-size:16px">EMAIL CUSTOMERSERVICE@KARM.IO</h3></td>
  </tr>
</table>

</body>
</html>
