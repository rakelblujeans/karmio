 <style>
 .fine-print{ margin-top:70px; margin-left:20px;}
 </style>
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
 <?php $org = $data->getOrgInfo();?>
 <?php $store = $data->getStoreInfo();
  $user = $data->getUserTax();
   $loc2 = $data->getStatename();
  $cty2 = $data->getCityname();
 ?>
 
 <style>
body{backgroundImage:url('<?php echo Yii::app()->getBaseUrl(true)."/".$data->picture?>')no-repeat;background-position: center center; background-size: cover; height: 100%; };
</style>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(<?php echo ($data->picture != '')?Yii::app()->getBaseUrl(true)."/".$data->picture:Yii::app()->getBaseUrl(true).'/images/orgLogos/GreenBank.jpg'?>) ')});
</script>
 <div id="slider" style="min-height:865px;">
 <div id="MainBody" style="position:relative;">
            <div class="CenterAlign">
            <div class="HundredPercent">
<!--<div id="CompanyLogo"><a href="< ?php echo Yii::app()->getBaseUrl(true)?>"><img src="images/CompanyLogo.png" alt="logo"/></a></div>-->
 <div id="MainBody2">
            <div class="CenterAlign">
            <div class="HundredPercent">

 <div id="HomePage">
            	
                <div class="DealBox">
                    <div class="DealBoxTop"></div>
                    <div class="DealBoxMid">
                         
                         <div class="TopBox">
                              <h1><?php echo $data->name?></h1>
                              <a href="#" class="FinePrint"  onclick="show_fineprint('location<?php echo $data->id?>', '<?php echo $data->fine_print?>')">Location</a>
                                            
                               <p> <?php echo $data->description?></p>
                                            
                               <a href="#" class="FinePrint" onclick="show_fineprint('fine-print<?php echo $data->id?>', '<?php echo $data->fine_print?>')">FinePrint</a>
                          </div>
                                 <div class="fine-print" id="fine-print<?php echo $data->id?>">
                                         <p class="close-p"><a href="#" onclick="close_fineprint('fine-print<?php echo $data->id?>')">close</a></p>                                 <p>
                                          <?php echo $data->fine_print?>
                                          </p>
                                          </div>
                                 <div class="fine-print" id="location<?php echo $data->id?>">
                                         <p class="close-p"><a href="#" onclick="close_fineprint('location<?php echo $data->id?>')">close</a></p>                                 	<p>
                                         <?php 
										 $store=array(); $store = $data->getStoreInfo();
										 $user = $data->getUserTax();
										 $loc2 = $data->getStatename();
										 $cty2 = $data->getCityname();

										  if(empty($data->address)){
											  echo CHtml::link(CHtml::encode(strtoupper($store->address)),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); ?><br /><?php echo $cty2; ?><br/>  <?php echo strtoupper($loc2); ?>, &nbsp;<?php echo $store->zip; ?><br><?php echo CHtml::encode($user->cellphone); ?><?php
											  }
											  else
											  { 
											   echo CHtml::link(CHtml::encode(strtoupper($data->address)),array('/userStore/gmapStore','pro_id' => $data->id), array('class' => 'mapBox')); 
											  ?><br /><?php echo $loc2->value; ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<br><?php echo CHtml::encode($user->cellphone); ?><?php }?>
                                         </p>
                                          </div>          
                           <div class="CouponTotalPrice">
                                $<?php  echo round($data->price);?>
                                 <span class="CouponDetailPrice">pledge included</span>
                           </div>
                                         
                           <ul class="CouponSaving">
                              <li>
                                 <p><b>savings </b><?php if ($data->price == '') {
											print "0";
											}else{
											echo round(((($data->regular_price)-($data->price))/($data->regular_price))*100);  }?>%</p>
                              </li>
                              <li>
                                 <p><b>purchased </b><?php 
											$sold_coupons = UserPurchase::model()->findAll('product_id='.$data->id);
											echo count($sold_coupons); ?></p>
                              </li>
                              <li>
                                 <p><b>remaining </b><?php echo substr($data->remainingTime(),0,3); ?> hrs</p>
                              </li>
                            </ul>   
                                         
                    </div> 
                        <!--red box started-->
                        
                     <div class="RedBoxContents">
                        <span class="CouponPriceLarge">$<?php echo round($data->amount_share); ?></span>
                        <p class="CouponDetail">from every coupon will be donated to</p>
                        <h3 class="CouponTitle"><?php echo $data->charity->name?></h3>
                     </div>    

                        <!--red box ended-->
                     
                    <div class="DealBoxMid">   
                        <h2>Donation part of coupon will be processed <br />by Networkforgood.org</h2>
                        <a class="NetworkGood" href="#"></a>
                    </div>
                    
                    <div class="DealBoxBottom"></div>
                </div>
                
                <div class="CreateDeal">
                	<div class="TopImage"></div>

                    <div class="MiddleImage" style="height:452px !important;">
                     <?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'buyNow-form',
						'enableAjaxValidation'=>false,
				   ));?>
					<?php echo $form->errorSummary($model); ?>
                    <?php echo $form->hiddenField($model,'pqty', array('value'=>"$model->pqty", 'id'=>"qtyV".$data->id)); ?>
					<?php echo $form->hiddenField($model,'pid', array('value'=>"$data->id")); ?>
                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="BuyPage">
                          <tr>
                            <td class="LeftSide" align="left" valign="top"><img src="images/verified_AN.png" align="bottom" height="90" width="89" alt="Verified" /></td>
                            <td class="RightSide" align="left" valign="top">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BuyForm">
                                  <tr>
                                    <td align="left" valign="top">
                                    	<h1>QTY <span class="RedFont" id="qty<?php echo $data->id?>"><?php echo '0'.$model->pqty; ?></span>
                                        
                                        <div class="increment" style="float:right; margin-right:5px;"><a href="javascript: updQtyTtl(<?php echo $data->id; ?>, 1, <?php  echo CHtml::encode($data->price);  ?>);"><img src="images/topinc.png" alt="" border="0" /></a>

					<a href="javascript: updQtyTtl(<?php echo $data->id; ?>, '-1', <?php echo CHtml::encode($data->price); ?>);">
                    <img src="images/botinc.png" alt="" border="0" /></a></div>
                                        
                                        </h1> <h1>TOTAL <span class="RedFont" id="total<?php echo $data->id?>">$<?php echo CHtml::encode($data->price);  ?></span></h1>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="left" valign="top">
                                   
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Sect01">
                                          <tr>
                                            <td colspan="2" align="left" valign="top"><h2>Credit or Debit Cards</h2></td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top">
                                            	<label>First Name on Card</label>
                                                <?php echo $form->textField($model,'fname', array('class'=>'Field1')); ?>
                                            </td>
                                            <td align="left" valign="top">
                                            	<label>Card Number</label>
                                               <!-- <input id="Text12" type="text" class="Field1" value="" />-->
                                                <?php echo $form->textField($model,'cnumber', array('class'=>'Field1', 'maxlength'=>'50')); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top">
                                            	<label>Last Name on Card</label>
                                                <?php echo $form->textField($model,'lname',array('class'=>'Field1')); ?>
                                            </td>
                                            <td align="left" valign="top">
                                            	<label>Expiration date</label>                    
											   <?php echo $form->dropDownList($model,'emonth', array(), array('class' => 'sel-form')); ?>
                                                <script type="text/javascript">
                                                                      var select = $("#BuyNowForm_emonth"),
                                                                          month = new Date().getMonth() + 1;
                                                                      for (var i = 1; i <= 12; i++) {
                                                                          select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
                                                                      }
                                                                  </script>
                                                                  
                                               <?php echo $form->dropDownList($model,'eyear',array(),array('class' => 'sel-form')); ?>
                                                <script type="text/javascript">
                                                                      var select = $("#BuyNowForm_eyear"),
                                                                          year = new Date().getFullYear();
                                              
                                                                      for (var i = 0; i < 12; i++) {
                                                                          select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                                                                      }
                                                                  </script>
					
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top">
                                            <label>CCV</label>
                                            	<?php echo $form->textField($model,'ccv', array('class'=>'Field2', 'size'=>'4', 'maxlength'=>'4')); ?>
                                            </td>
                                            <td align="left" valign="top">
                                            	
                                            </td>
                                          </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="left" valign="top">
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Sect01">
                                          <tr>
                                            <td colspan="2" align="left" valign="top"><h2>Billing</h2></td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top">
                                            	<label>Street Address</label>
                                                <?php echo $form->textField($model,'address', array('class'=>'Field1', 'maxlength'=>'500')); ?>
                                            </td>
                                            <td align="left" valign="top">
                                            	<label>City</label>
                                                 <?php echo $form->textField($model,'city', array('class'=>'Field1', 'maxlength'=>'500')); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top">
                                            	<div class="BuyFormSpacer"><label>State</label>
                                                <?php echo $form->textField($model,'state', array('class'=>'Field2', 'maxlength'=>'500')); ?>
                                                </div>
                                                <div><label>Zip</label>
                                                 <?php echo $form->textField($model,'zipcode', array('class'=>'Field2', 'maxlength'=>'500')); ?>
                                                 <?php echo $form->hiddenField($model,'country', array('value'=>'usa')); ?>

                                                 </div>
                                            </td>
                                          </tr>
                                        </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top">
                                    <img src="images/clearpixel.gif" height="8" width="100%" alt="" />
                                    <input type="image" src="images/purchase_btn.png" height="34" width="233" alt="" /></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                       </table>
                    <?php $this->endWidget();?>
                    </div>
                  <div class="BottomImage"></div>
                </div>
                
            </div>
         </div>
         </div>
         </div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
 
 
 
 
<!--<div id="main-border">
<div class="main-center">
<div class="slagon"><?php echo $data->charity->tag_line;  ?></div>
<div class="buydetail">
<div class="leftbox">
<div class="content-center">
<div class="content-centertop">
<div class="share">
</div>
<div class="dealimage"><img src="<?php echo ($data->picture)?$data->picture:'images/orgLogos/GreenBank.jpg'; ?>" width="334" height="198" /></div>
<div class="deal-des">
<?php echo CHtml::encode($data->name); //Deal Description?>
<div class="deal-title"><?php echo CHtml::encode($store->name); //Deal Name?></div>
<div class="endline" >
<a href="#"  style=" float:right; color:#000000;  text-decoration:none; margin-top:-7px; font-family:Arial, Helvetica, sans-serif; font-size:9px;" onclick="show_fineprint('fine-print<?php echo $data->id?>')">
<b>FINE PRINT</b></a>
<hr />
</div>


<div style="clear:both;"></div>
<div class="fine-print" style="display:none;" id="fine-print<?php echo $data->id?>">
<p style="text-align:right; margin:0px; margin-bottom:5px; "><a href="#" onclick="close_fineprint('fine-print<?php echo $data->id?>')">close</a></p>
<p>
<?php echo $data->fine_print?>
</p>
</div>
</div>
<div class="pledge"> 
<div class="pledge-amount"><div class="pledge-titleprice">$<?php  echo round(CHtml::encode($data->price));   //Deal Regual Price?></div><div class="pledge-title">pledge included</div></div>
<div class="buy"></div>
</div>
</div>
<div class="nonprofit-top"></div>
<div class="non-profit">
<div style="background-color: rgb(242, 61, 52); float: left; width: 100%;">
<div style="float:left;display:table; vertical-align:middle; height:108px;">
	<div class="non-profit-pledge">$<?php echo round($data->amount_share); //Deal Regual Price?></div>
</div>
<div style="float:left;display:table; vertical-align:middle; height:108px;">
	<div class="non-profit-main">from every coupon will be donated to</div>
</div>
<div style="float:left;display:table; vertical-align:middle; height:108px;">
<div class="non-profit-title"> 
<?php 
	 $cname = $data->charity->name;
	echo substr($cname, 0, 46);
	if(strlen($cname) > 46 ) echo '...';
	
 ?></div>
 </div>
 </div>
</div>
<div class="nonprofit-bottom"></div>
<div class="location"><div class="lhead">Location: </div>
<div class="rdes"><?php if(empty($data->address)){
    echo CHtml::link(CHtml::encode(strtoupper($store->address)),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address?><br /><?php echo strtoupper($loc2); ?>, &nbsp;<?php echo $cty2; ?> &nbsp;<?php echo $store->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php
	}
	else
	{
	 echo CHtml::link(CHtml::encode(strtoupper($data->address)),array('/userStore/gmapStore','pro_id' => $data->id), array('class' => 'mapBox')); 
	?><br /><?php echo $loc2->value; ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<?php //echo $data->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php }?></div></div>
</div>
<div class="paymentimage"><br /><img src="images/payment.png" /></div>
</div>
  <?php $form=$this->beginWidget('CActiveForm', array(
   		'id'=>'buyNow-form',
		'enableAjaxValidation'=>false,
   ));?>
	<?php //echo $form->errorSummary($model); ?>
<div class="rightbox">
<div class="pricedetail">
<div class="pricebox">
<span>price</span>
<div class="price">$<?php  echo round($data->price);//Deal Regual Price?></div><br />
<label> pledge included</label>
</div>
<div class="pricebox">
<span>qty</span><br />
<div class="price2" id="qty<?php echo $data->id; ?>"><?php
				if($model->pqty <= '9')
					echo '0'; 

				echo $model->pqty; 

			?>



</div>

<div class="increment"><a href="javascript: updQtyTtl(<?php echo $data->id; ?>, 1, <?php  echo CHtml::encode($data->price);  ?>);"><img src="images/topinc.png" alt="" border="0" /></a>

					<a href="javascript: updQtyTtl(<?php echo $data->id; ?>, '-1', <?php echo CHtml::encode($data->price); ?>);"><img src="images/botinc.png" alt="" border="0" /></a></div>

</div>

<div class="pricebox">

<span>total</span>

<div class="price"><div class="val" id="total<?php echo $data->id; ?>"><?php  echo CHtml::encode($data->price);  ?></div></div>

</div>



</div>

<?php 



echo $form->hiddenField($model,'pqty', array('value'=>"$model->pqty", 'id'=>"qtyV".$data->id)); ?>

	 <?php echo $form->hiddenField($model,'pid', array('value'=>"$data->id")); ?>

<div class="buypledge">

<div class="total"><span>Total</span><label id="total2<?php echo $data->id; ?>"><?php echo CHtml::encode($data->price);  ?></label></div>

</div>

<div class="underblue"></div>

<div class="buyform">



<div class="titlebuy">CREDIT CARDS OR DEBIT CARDS</div>

<div class="row">

<label>Cardholder's first name:</label>

 <?php echo $form->textField($model,'fname', array('class'=>'textfield', 'maxlength'=>'225')); ?>

 <?php echo $form->error($model,'fname'); ?>


</div>

<div class="space">&nbsp;</div>

<div class="row">

<label>Cardholder's last name:</label>

<?php echo $form->textField($model,'lname', array('class'=>'textfield', 'maxlength'=>'225')); ?>

<?php echo $form->error($model,'lname'); ?>

</div><br />

<div class="rowlong">

<div class="rownumber">

<label>Card number</label>

 <?php echo $form->textField($model,'cnumber', array('class'=>'textfieldnm', 'maxlength'=>'50')); ?>

<?php echo $form->error($model,'cnumber'); ?>

</div>

<div class="rowcvc">

<label>CCV</label>

  <?php echo $form->textField($model,'ccv', array('class'=>'textfield1', 'size'=>'4', 'maxlength'=>'4')); ?>

  <?php echo $form->error($model,'ccv'); ?>

</div>

</div>

<div class="rowlongright">

<label>Expiration date</label>                    

 <?php echo $form->dropDownList($model,'emonth',array()); ?>

  <script type="text/javascript">

                        var select = $("#BuyNowForm_emonth"),

                            month = new Date().getMonth() + 1;

                        for (var i = 1; i <= 12; i++) {

                            select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))

                        }

                    </script>

					

 <?php echo $form->dropDownList($model,'eyear',array()); ?>

  <script type="text/javascript">

                        var select = $("#BuyNowForm_eyear"),

                            year = new Date().getFullYear();



                        for (var i = 0; i < 12; i++) {

                            select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))

                        }

                    </script>

					<?php echo $form->error($model,'edate'); ?>

</div>

<div class="titlebuy">Billing address</div>

<div class="rowlong">

<label>Street Address</label>

 <?php echo $form->textField($model,'address', array('class'=>'textfieldlong', 'maxlength'=>'500')); ?>

 <?php echo $form->error($model,'address'); ?>

</div>

<div class="row">

<label>City</label>

 <?php echo $form->textField($model,'city', array('class'=>'textfield', 'maxlength'=>'225')); ?>

 <?php echo $form->error($model,'city'); ?>

</div><div class="space">&nbsp;&nbsp;</div><div class="space">&nbsp;&nbsp;</div>

<div class="rowsmall">

<label>State</label>

 <?php echo $form->textField($model,'state', array('class'=>'textfield1', 'size'=>"5", 'maxlength'=>'90')); ?>

  <?php echo $form->error($model,'state'); ?>

</div>

<div class="rowsmall">

<label>Zip Code</label>

<?php echo $form->textField($model,'zipcode', array('class'=>'textfield1', 'size'=>"10", 'maxlength'=>'225')); ?>

 <?php echo $form->error($model,'zipcode'); ?>

<?php echo $form->hiddenField($model,'country', array('value'=>'usa')); ?>

</div>
<br/> 

<div class="rowbutton"><div class="AuthorizeNetSeal"  >  <script type="text/javascript" language="javascript">var ANS_customer_id="97b8b81a-de28-4963-bc9a-259b0bdf1f19";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Credit Card Processing</a> </div>  

</div>
<div class="rowbutton_auth"><input name="" type="image" src="images/Karmio_PayPage__19.png" /></div>
</form>



<div style=" float: left;

    height: auto;

    margin-top: 10px;

    text-align: center;

  padding-left:110px; width: 180px;"><br />

 

</div>

<div class="termscond"><br />By purchasing you agree to the Karmio terms and conditions</div>

</div>



</div>

  <?php $this->endWidget();?>

</div>



</div>

</div>-->
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
