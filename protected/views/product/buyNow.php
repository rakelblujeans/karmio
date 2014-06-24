<<?
 
$model->cnumber="";
$model->ccv="";
$model->emonth="";
$model->eyear="";


?>
 <style>
 .fine-print{ margin-top:180px; z-index:600; margin-left:20px;}

 #fancybox-loading div {
    background-image: url("<?php echo Yii::app()->baseUrl?>/images/ajax-loading.gif");
    height: 480px;
    left: 0;
    position: absolute;
    top: 0;
    width: 31px;
	height:31px
}
#fancybox-close {
    background: url("<?php echo Yii::app()->baseUrl?>/images/fancybox.png") repeat scroll -40px 0 transparent;
    cursor: pointer;
    display: none;
    height: 30px;
    position: absolute;
    right: -15px;
    top: -15px;
    width: 30px;
    z-index: 1103;
}
 </style>
 <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
 <script type="text/javascript">
 jQuery(document).ready(function(){
		 $(".cheading").boxfit({multiline: true});
		
		});
  function closeErrors()
	  {
		  jQuery(".errors").hide();
	  }
 </script>
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
 <div id="slider">
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
                              <div class="cheading"><?php echo $data->name?></div>
                             <?php echo CHtml::link('Location','javascript:void(-1)', array('onclick' => 'showLocation("'.Yii::app()->createAbsoluteUrl('/userStore/gmapStore',array('st_id' => $store->id)).'")', 'class' => 'Locationf', 'style' => 'float: right; font-size: 10px; text-transform: uppercase'));?>              
                               <p> <?php echo $data->description?></p>
                                            
                               <a href="#" class="FinePrint" onclick="show_fineprint('fine-print<?php echo $data->id?>')">Fine Print</a>
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
                           <div class="CouponTotalPrice" style="width:150px; text-align:left !important;">
                               <span style="margin-left:13px; margin-right:5px;"> $<?php  $disc = round(($data->price*$data->regular_price)/100);
								echo round($data->regular_price-$disc);?></span>
                                <span style="color:#979797; font-size:18px; position:relative; top:-5px; text-decoration:line-through; " ><?php echo ' ($'.round($data->regular_price).') '; ?></span>
                                 <span class="CouponDetailPrice">pledge included</span>
                           </div>
                                         
                           <ul class="CouponSaving">
                              <li>
                              	<span style="font-weight:normal;" class="InputPrice"><?php if ($data->price == '') {
											print "0";
											}else{
											echo round($data->price); }?>%</span>
                            	savings
                              </li>
                              <li>
                              
                              	<span style="font-weight:normal;" class="InputPrice" id="total_coupons"><?php 
											$sold_coupons = UserPurchase::model()->findAll('product_id='.$data->id);
											echo count($sold_coupons).'/'.$data->coupons; ?></span>purchased
                              </li>
                              <li>
                              	<span style="font-weight:normal;" class="InputPrice" ><?php echo $data->remainingTime(); ?> </span>remaining
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
					<?php if($form->errorSummary($model) != '')
					{?>
					<div class="errors">
					<a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
					<?php echo $form->errorSummary($model);?>
					</div>
					<?php  }?>
                    
                 <?php if($msg != '' && $form->errorSummary($model) == '')
				{?>
                <div class="errors">
                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
                <?php   echo '<p>'.$msg.'</p>';?>
                </div>
				<?php  }?>
                    
                    <?php echo $form->hiddenField($model,'pqty', array('value'=>"$model->pqty", 'id'=>"qtyV".$data->id)); ?>
					<?php echo $form->hiddenField($model,'pid', array('value'=>"$data->id"));
					
					$disc = round(($data->price*$data->regular_price)/100);
					$orig_price = round($data->regular_price - $disc); ?>
					<a href="<?php echo Yii::app()->getBaseUrl(true) . '/index.php?r=product/index&product_id=' . $data->id; ?>">
					  <img /*class="SearchCross"*/ src="images/SearchCross.png" /></a>
                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="BuyPage">
                          <tr>
                            <td class="LeftSide" align="left" valign="top"><img src="images/verified_AN.png" align="bottom" height="90" width="89" alt="Verified" /></td>
                            <td class="RightSide" align="left" valign="top">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BuyForm">
                                  <tr>
                                    <td align="left" valign="top">
                                    	<h1><div class="increment" style="float:right; margin-left:10px; margin-right:8px;"><a href="javascript: updQtyTtl(<?php echo $data->id; ?>, 1, <?php  echo CHtml::encode($orig_price);  ?>);"><img style="margin: 6px 0px 4px;" src="images/topinc.png" alt="" border="0" /></a>

					<a href="javascript: updQtyTtl(<?php echo $data->id; ?>, '-1', <?php echo CHtml::encode($orig_price); ?>);">
                    <img src="images/botinc.png" alt="" border="0" /></a></div>QTY <span class="RedFont" id="qty<?php echo $data->id?>"><?php echo '0'.$model->pqty; ?></span>
                                        
                                        </h1> 
                                        <h1>TOTAL <span class="RedFont" id="total<?php 
										
										 echo $data->id?>">$<?php echo CHtml::encode($orig_price);  ?></span></h1>
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
                                            	<label>Last Name on Card</label>
                                                <?php echo $form->textField($model,'lname',array('class'=>'Field1')); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top">
                                            	<label>Card Number</label>
                                               <!-- <input id="Text12" type="text" class="Field1" value="" />-->
                                                <?php echo $form->textField($model,'cnumber', array('class'=>'Field1', 'maxlength'=>'16')); ?>
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

 <?php


                                                 $user = User::model()->findByPk(Yii::app()->user->id);
                                                
               

?>
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
                                                <!--?php echo $form->textField($model,'state', array('class'=>'Field2', 'maxlength'=>'2')); ?-->
                                                    <?php echo $form->dropDownList($model,'state',Location::getStates(),
                                                        array(
                                                            'prompt'=>'---',
                                                            'ajax' => array(
                                                                'type'	=> 'POST',
                                                                'url' => array('/location/myCitys'),
                                                                'update'	=> '#User_location_id',
                                                            ),
                                                            'class' => 'Fieldset3',
                                                            'maxlength' => 5,
                                                        )
                                                    ); ?>

                                                </div>

                                              <div class="Zip">
                                                <label>Zip</label>
                                                <?php echo $form->textField($model,'zipcode', array('class'=>'Field3', 'maxlength'=>'5')); ?>
                                                <?php echo $form->hiddenField($model,'country', array('value'=>'usa')); ?>
                                              </div>
                                            </td>
                                            
                                              <td align="left" valign="top">
                                                <div class="PhoneNumber"><label>Phone Number</label>
												 <?php echo $form->textField($model,'phone_number', array('class'=>'Field1', 'maxlength'=>'10','value'=> $user->cellphone)); ?>			
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
 function showLocation(url)
 {
	jQuery("#fancybox-loading").show();
	jQuery("#loc").attr('src', url);
	jQuery("#fancybox-wrap2").show();
	jQuery("#fancybox-loading").hide();
 }
 function closeBox()
 {
	  $("#fancybox-wrap2").hide();
 }
 </script>
 <div id="fancybox-wrap2" style="width: 360px; height: auto; top: 20%; display: none; position:absolute; margin-left:510px; z-index:1000"><div id="fancybox-outer"><div id="fancybox-bg-n" class="fancybox-bg"></div><div id="fancybox-bg-ne" class="fancybox-bg"></div><div id="fancybox-bg-e" class="fancybox-bg"></div><div id="fancybox-bg-se" class="fancybox-bg"></div><div id="fancybox-bg-s" class="fancybox-bg"></div><div id="fancybox-bg-sw" class="fancybox-bg"></div><div id="fancybox-bg-w" class="fancybox-bg"></div><div id="fancybox-bg-nw" class="fancybox-bg"></div><div id="fancybox-content" style="border: 10px solid #FFFFFF; background:#FFFFFF; width: 340px; height: auto;"><div style="width:auto;height:auto;overflow: auto;position:relative;">
<div id="fancybox-loading" style="display: block;"><div style="top: 200px; left:160px;"></div></div>
<iframe width="340" scrolling="no" height="480" frameborder="0" marginwidth="0" marginheight="0" id="loc">

</iframe>
</div></div><a id="fancybox-close" style="display:block;" onclick="closeBox();"></a><div id="fancybox-title" style="display: none;"></div><a id="fancybox-left" href="javascript:;"><span id="fancybox-left-ico" class="fancy-ico"></span></a><a id="fancybox-right" href="javascript:;"><span id="fancybox-right-ico" class="fancy-ico"></span></a></div></div>
