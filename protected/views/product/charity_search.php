<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('body').css('backgroundImage', 'url(<?php echo ($product->picture != '')?Yii::app()->getBaseUrl(true)."/".$product->picture:Yii::app()->getBaseUrl(true).'/images/orgLogos/GreenBank.jpg'?>)');
	$("#cheading<?php echo $product->id?>").boxfit({multiline: true});
	 $("#suggestion").mouseleave(function(){if( $('#suggestion').is(':visible') ){$("#suggestion").hide();}});
				   			   
		
		 getList(0, 'Partner');
		
		});
</script>
<style>

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
 .fine-print{ margin-top:180px; z-index:600; margin-left:20px;}

</style>
<div id="MainBody">
<div class="CenterAlign">
<div class="HundredPercent">

<div id="HomePage">
<div class="CharityBox">
<div class="bg-top"></div>

<div class="bg-mid">
    
    <div class="CharitySearch">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $product->id))?>" class="SearchCross"><img src="images/SearchCross.png" /></a>
        <div class="SearchHeading">
        CHARITY SEARCH
        </div>
        <input type="text" class="SearchTextBox" value="Name or Keyword" name="charity" id="charity" onFocus="javascript:if(this.value == 'Name or Keyword')this.value=''"/>
        <?php $categories = Categories::model()->findAll(array('order' => 'cat_value'));?>
        <select class="CategorySelect" name="category" id="category">
        <option>Select a Category</option>
       <?php if(count($categories))
		foreach($categories as $cat){?>
		<option value="<?php echo $cat->cat_value ?>"><?php echo $cat->cat_value?></option>
		<?php }?>
        </select>
        <input type="text" class="CategoryTextBox" value="St" id="state" name="state" onFocus="javascript:if(this.value == 'St')this.value=''"/>
        <a onClick="getList(0, 'both')" href="javascript:void(-1)" >
        <input type="button" class="SearchButton" value="" />
        </a>
        <span class="SearchOR">
            <img src="images/SearchOR.png" />
        </span>
        <a href="javascript:void(-1)" onclick="getList(0, 'Partner')">
            <input type="button" class="SearchCheckout" value="" />
            </a>
        <span class="SearchResults">
         <img src="images/SearchResults.png" />
         </span>
    </div>
    
    <div class="SearchResult">
        <div class="ResultHeading" id="sr">
            SEARCH RESULT
        </div>
        <div id="search_result" align="center" style="display:none;">
		</div>
       
        
    </div>

    <div class="DealBox">
    <div class="DealBoxTop"></div>
    <div class="DealBoxMid">
                                         
                                         <div class="TopBox">
                                            <div class="cheading" id="cheading<?php echo $product->id?>"><?php echo $product->name?></div>
                                            
                                            <?php 
											 $store=array(); $store = $product->getStoreInfo();
											echo CHtml::link('Location','javascript:void(-1)', array('onclick' => 'showLocation("'.Yii::app()->createAbsoluteUrl('/userStore/gmapStore',array('st_id' => $store->id)).'")', 'class' => 'Locationf', 'style' => 'float: right; font-size: 10px; text-transform: uppercase')); //store address?>

                                            
                                            <p>
                                           <?php echo $product->description?>

                                            </p>
                                            
                                            <a href="#" class="FinePrint" onclick="show_fineprint('fine-print<?php echo $product->id?>')">Fine Print</a>
                                         </div>
                                         
                                         <div class="fine-print" id="fine-print<?php echo $product->id?>">
                                         <p class="close-p"><a href="#" onclick="close_fineprint('fine-print<?php echo $product->id?>')">close</a></p>                                 <p>
                                          <?php echo $product->fine_print?>
                                          </p>
                                          </div>
                                         <div class="fine-print" id="location<?php echo $product->id?>">
                                         <p class="close-p"><a href="#" onclick="close_fineprint('location<?php echo $product->id?>')">close</a></p>                                 	<p>
                                         <?php 
										 $store=array(); $store = $product->getStoreInfo();
										 $user = $product->getUserTax();
										 $loc2 = $product->getStatename();
										 $cty2 = $product->getCityname();

										  if(empty($product->address)){
											  echo CHtml::link(CHtml::encode(strtoupper($store->address)),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); ?><br /><?php echo $cty2; ?><br/>  <?php echo strtoupper($loc2); ?>, &nbsp;<?php echo $store->zip; ?><br><?php echo CHtml::encode($user->cellphone); ?><?php
											  }
											  else
											  { 
											   echo CHtml::link(CHtml::encode(strtoupper($product->address)),array('/userStore/gmapStore','pro_id' => $product->id), array('class' => 'mapBox')); 
											  ?><br /><?php echo $loc2->value; ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<br><?php echo CHtml::encode($user->cellphone); ?><?php }?>
                                         </p>
                                          </div>
                                         
                                         <div class="CouponTotalPrice">
                                            $<?php  $disc = round(($product->price*$product->regular_price)/100);
								echo round($product->regular_price-$disc);  //Deal Regual Price?>
                                            <span class="CouponDetailPrice">pledge included</span>
                                         </div>
                                         
                                         <ul class="CouponSaving">
                                            <li>
                                            <span style="font-weight:normal;" class="InputPrice"><?php if ($product->price == '') {
											print "0";
											}else{
											echo round($product->price);  }?>%</span>
                            				savings
                                            </li>
                                            <li>
                                            <span style="font-weight:normal;" class="InputPrice" id="total_coupons"><?php 
											$sold_coupons = UserPurchase::model()->findAll('product_id='.$product->id);
											echo count($sold_coupons).'/'.$product->coupons; ?></span>purchased
                                            </li>
                                            <li>
                                            <span style="font-weight:normal;" class="InputPrice" ><?php echo $product->remainingTime(); ?> </span>remaining
                                            </li>
                                         </ul>   
                                          
                                         
                                  </div>  
        <!--red box started-->
        
                 <div class="RedBoxContents">
                     <span class="CouponPrice">$<?php echo round($product->amount_share); ?></span>
                     <p class="CouponDetail">from every coupon will be donated to</p>
                    <?php
                     if($product->charity){?>
                      <h3 class="CouponTitle">
                      <?php 
                      echo $product->charity->name;
                      ?>
                      </h3>
                      <input type="hidden" name="ein" id="ein" value="<?php echo $product->id?>" />
                      <?php }
                      else{?>
                       <h3 class="CouponTitle" style="margin-top:-2px;">
                       <input id="oName" type="text" class="ShadowTextBox" value="Type in your favorite charity" onfocus="javascript:if(this.value == 'Type in your favorite charity')this.value=''"   onkeyup="searchOrg(this.value)"/>

<input type="hidden" name="ein" id="ein" />
                      </h3>
                      
                      <?php }?> <div id="suggestion"></div>
                     
                 </div>   
  
        <!--red box ended-->
     
     <div class="DealBoxMid">   
        <a href="javascript:void(-1)" onclick="buy_it('<?php echo CController::createUrl('/product/buyNow', array('pid'=>$product->id)); ?>')" class="BuyButton"><img src="images/BuyButton.png" alt="Buy" /></a>
    </div>

    <div class="DealBoxBottom"></div>
    </div>

    
<div style="clear:both;"></div>
</div>
<div class="bg-bottom"></div>

</div>
    
</div>

<!--Home Page Ends Here-->

</div>
</div>
</div>
<div class="fancybox-overlay"></div>
<div id="fancybox-wrap2" style="z-index:999999;width: 360px; height: auto; top: 20%; display: none; position:absolute; margin-left:510px;"><div id="fancybox-outer"><div id="fancybox-bg-n" class="fancybox-bg"></div><div id="fancybox-bg-ne" class="fancybox-bg"></div><div id="fancybox-bg-e" class="fancybox-bg"></div><div id="fancybox-bg-se" class="fancybox-bg"></div><div id="fancybox-bg-s" class="fancybox-bg"></div><div id="fancybox-bg-sw" class="fancybox-bg"></div><div id="fancybox-bg-w" class="fancybox-bg"></div><div id="fancybox-bg-nw" class="fancybox-bg"></div><div id="fancybox-content" style="border: 10px solid #FFFFFF; background:#FFFFFF; width: 340px; height: auto;"><div style="width:auto;height:auto;overflow: auto;position:relative;">
<div id="fancybox-loading" style="display: block;"><div style="top: 200px; left:160px;"></div></div>
<iframe width="340" scrolling="no" height="480" frameborder="0" marginwidth="0" marginheight="0" id="loc">

</iframe>
</div></div><a id="fancybox-close" style="display:block;" onclick="closeBox();"></a><div id="fancybox-title" style="display: none;"></div><a id="fancybox-left" href="javascript:;"><span id="fancybox-left-ico" class="fancy-ico"></span></a><a id="fancybox-right" href="javascript:;"><span id="fancybox-right-ico" class="fancy-ico"></span></a></div></div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slitslider.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.qtip.js"></script>
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
 function getList(offset, ctype)
{
	
var charity = $("#charity").val();
var state = $("#state").val();
var category = $("#category").val();

$.ajax({
  type: 'GET',
  url:'index.php?r=product/findCharity',
  data: 'charity='+charity+'&category='+category+'&state='+state+'&offset='+offset+'&type='+ctype,
  success: function(output)
  {
	  if(output != '')
	  {
	 	 $("#search_result").html(output);
		 $("#search_result").show();
		 if(ctype != 'Partner')
		 	$("#sr").html('SEARCH RESULT');
		else
			$("#sr").html('PARTNER CHARITIES');
	  }
	 
  }
});
}
function setValue(ein, name)
{
	$.ajax({
	  type: 'GET',
	  url:'index.php?r=product/setCharitySession',
	  data: 'charity='+ein,
	  success: function(output)
	  {
		  if(output == 'done')
		  {
			 jQuery("#ein").val(ein);
			 jQuery("#oName").val(name);
		  }
		 // $(obj).parents('.row').remove();
	  }
	});
	 
}
 function buy_it(url)
 {
	 if((jQuery("#oName").val() == '' || jQuery("#oName").val() == 'Type in your favorite charity') && jQuery("#ein").val() == '')
	 {
	 	alert('Select a charity before proceeding');
	 }
	 else {
		 if(jQuery("#ein").val() == ''){
		 $.ajax({
  type: 'GET',
  url:'index.php?r=product/validateCharity',
  data: 'charity='+jQuery("#oName").val(),
  success: function(output)
  {
	  if(output == 'invalid')
	  {
	 	alert('Charity name is invalid');
		jQuery("#oName").val('Type in your favorite charity');
	  }
	  else
	  {
		  jQuery("#ein").val(output);
		  window.location = url;
	  }
	
  }
});
		 }
		 else
		 {
			   window.location = url;
		 }
	 	
	 }
 }
 function validate_charity(obj)
 {
	 $.ajax({
  type: 'GET',
  url:'index.php?r=product/validateCharity',
  data: 'charity='+obj.value,
  success: function(output)
  {
	  if(output == 'invalid')
	  {
	 	alert('Charity name is invalid');
		jQuery("#oName").val('Type in your favorite charity');
	  }
	  else
	  {
		  jQuery("#ein").val(output);
	  }
	
  }
});
 }
 function searchOrg(val)
{
//alert(val);
	if(val != '')
	{
		$.ajax({
		type: 'GET',
		async: true,
		url:'index.php?r=product/searchOrg',
		data: 'key='+val,
		success: function(output)
		{
		if(output == ''){
			alert('No Organization exist with name '+val+'. Please search another term ');
		}
		else{
		  $("#suggestion").html(output);
		  $("#suggestion").show()
		  }
		}
		});
	}

}

function fill(name, ein, tag_line, stats)
{

	
	$.ajax({
	  type: 'GET',
	  url:'index.php?r=product/setCharitySession',
	  data: 'charity='+ein,
	  success: function(output)
	  {
		  if(output == 'done')
		  {
			$("#oName").val(name);
			$("#ein").val(ein);
			$("#Product_ein").val(ein);
			$("#suggestion").hide();
		  }
		 // $(obj).parents('.row').remove();
	  }
	});
}
</script>