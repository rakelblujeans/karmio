<!--Slider Started-->
<?php 

//Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $product->id)), 'og:url');
//Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true).'/'.$product->picture, 'og:image');
Yii::app()->clientScript->registerMetaTag($product->name, 'og:title');
?>
<meta content='<?php echo Yii::app()->getBaseUrl(true).'/images/deal.jpg'/*$product->picture*/?>' property='og:image'/>
<meta content='<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $product->id))?>' property='og:url'/>
<link rel="image_src" href="<?php echo Yii::app()->getBaseUrl(true).'/'.$product->picture?>"/ >
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
.qtip-cream{ top:720px !important;}
<?php $count=1; if(count($products))
	//foreach($products as $product){//Yii::app()->baseUrl.'/images/Backgrounds/bg_00'.$count.'.jpg
	if($product->picture!= '')
	{
		echo  '           
.bg-img-'.$count.' {
	background-image: url('.Yii::app()->getBaseUrl(true).'/'.$product->picture.' );}';
	
	}
	else
	{
    echo  '           
.bg-img-'.$count.' {
	background-image: url('.Yii::app()->getBaseUrl(true).'/images/orgLogos/GreenBank.jpg'.' );}';
	}
	$count++;
	//}

?>

 .fine-print{ margin-top:180px; z-index:600; margin-left:20px;}

</style>
     <div id="slider" class="sl-slider-wrapper">

				<div class="sl-slider">
				<?php $count=1; if(count($products))
					//foreach($products as $product){?>
                    
					<div class="sl-slide">
						<div class="sl-slide-inner">
							<div class="bg-img bg-img-<?php echo $count++?>"></div>
							<!--Main Body Started-->
                            <div id="MainBody" class="CouponMainPage">
                            <div class="CenterAlign">
                            <div class="HundredPercent">
                            
                            <div id="HomePage">
                            
                                <div class="DealBox">
                                <div class="RightSocialIcon">
                                <div><?php $image=urlencode(Yii::app()->getBaseUrl(true).'/'.$product->picture);
								   $url = Yii::app()->getBaseUrl(true).'/index.php?r=product/index&producr_id='.$product->id;
									$title = str_replace("'", "",$product->name);
									$summary = str_replace("'", "",$product->fine_print);
							  	  ?>
									  <script type="text/javascript">
									  function fbs_click(){
										  
											  u='<?php echo $url ?>';
											  t='<?php echo $title?>';
											  window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t)+"&picture=<?php echo $image?>","sharer","toolbar=0,status=0,width=626,height=436");return false;
											  }
									  </script></div>
                                <ul>
                                
                                    <li>
                                    <a rel="nofollow" href="javascript:void(-1)" target="_blank"  onclick="return fbs_click()">
                                    <img src="images/IconFacebook.png" alt="Icon" /></a></li>
                                    <li><a href="https://twitter.com/share" data-text="<?php echo $product->twitter_text?>" class="twitter-share-button" target="_blank" data-count="none" ><img src="<?php Yii::app()->getBaseUrl(true)?>/images/IconTwitter.png" alt="Icon" /></a></li>
                                </ul>
                            </div>
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
                                <span style="color:#868686; font-size:18px; text-decoration:line-through; " ><?php echo ' $'.round($product->regular_price).' '; ?></span>
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
                                            <span style="font-weight:normal;" class="InputPrice" ><?php echo substr($product->remainingTime(),0,3); ?> hrs</span>remaining
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
                                                      <input type="hidden" name="ein" id="ein" value="<?php echo $product->ein?>"/>
                                                      
                                                      <?php }
													  else{?>
                                                       <h3 class="CouponTitle" style="margin-top:-2px;">
                                                      <input id="oName" type="text" class="ShadowTextBox" value="Type in your favourite charity" onfocus="javascript:if(this.value == 'Type in your favourite charity')this.value=''" onkeyup="searchOrg(this.value)" />
                                                      <!--<input type="hidden" name="ein" id="ein" />-->
                                                      </h3>
                                                       <div id="suggestion"></div>
                                                      <a href="<?php echo Yii::app()->createAbsoluteUrl('product/charitySearch', array('product_id' => $product->id))?>" id="advanced">advaned search</a>
                                                      <?php }?></h3>
                                                     
                                                     
                                                 </div>   
                            
                                        <!--red box ended-->
                                     
                                     <div class="DealBoxMid">   
                                        <a href="javascript:void(-1)" onclick="buy_it('<?php echo CController::createUrl('/product/buyNow', array('pid'=>$product->id)); ?>')" class="BuyButton"><img src="images/BuyButton.png" alt="Buy" /></a>
                                    </div>
                                    
                                    <div class="DealBoxBottom"></div>
                                </div>
                            </div>
                            <!--Home Page Ends Here-->
                            
                            </div>
                            </div>
                            </div>
                            <!--Main Body Ends Here-->
						</div>
					</div>
					
                    <script type="text/javascript">
		   jQuery(document).ready(function(){
			   
				   $("#cheading<?php echo $product->id?>").boxfit({multiline: true});
				   $('.nav-dots a[title]').qtip({ style: { name: 'cream', tip: true, padding: 5,
      background: '#f7f2ef',
      color: 'black', textAlign: 'center',
      border: {
         width: 7,
         radius: 5,
         color: '#f7f2ef'
      }},  position: {
		  my: 'top center',
		 at: 'top center',
      corner: {
         target: 'bottomMiddle',
         tooltip: 'bottomMiddle'
      }
   }
    })
				  
				  });
		  </script>
                    
                    <?php //}?>
					
				</div><!-- /sl-slider -->

				<nav id="nav-arrows" class="nav-arrows">
					<a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $prev))?>"><span class="nav-arrow-prev">Previous</span></a>
					<a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $next))?>"><span class="nav-arrow-next">Next</span></a>
				</nav>
                
				<nav id="nav-dots" class="nav-dots" >
               <!-- <span class="nav-dot-current"></span>-->
                <?php foreach($products as $prod){?>
					
					<a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $prod->id))?>" title="<?php echo $prod->name?>" >
                    <span <?php if($product->id == $prod->id){ ?>class="nav-dot-current"<?php } ?>></span>
                    </a>
					
				<?php }?>
				</nav>

			</div>   
        
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slitslider.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.qtip.js"></script>
           
		<script type="text/javascript">	
			$(function() {
			
				var Page = (function() {

					var $navArrows = $( '#nav-arrows' ), 
					    $nav = $( '#nav-dots > span' ),
						slitslider = $( '#slider' ).slitslider( {
							onBeforeChange : function( slide, pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),

						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slitslider.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slitslider.jump( i + 1 );
									return false;
								
								} );
								
							} );

						};
/*$navArrows.children( ':last' ).on( 'click', function() {

								slitslider.next();
								
								return false;

							} );

							$navArrows.children( ':first' ).on( 'click', function() {
								
								slitslider.previous();
								return false;

							} );

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slitslider.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slitslider.jump( i + 1 );
									return false;
								
								} );
								
							} );*/
						return { init : init };

				})();

				Page.init();
			
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
 function buy_it(url)
 {
	
	 if((jQuery("#oName").val() == '' || jQuery("#oName").val() == 'Type in your favourite charity') && jQuery("#ein").val() == '')
	 {
	 	alert('Select a charity before proceeding');
	 }
	 else {
		  if(jQuery("#ein").val() == '')
	 {
		 $.ajax({
  type: 'GET',
  url:'index.php?r=product/validateCharity',
  data: 'charity='+jQuery("#oName").val(),
  success: function(output)
  {
	  if(output == 'invalid')
	  {
	 	alert('Charity name is invalid');
		jQuery("#oName").val('Type in your favourite charity');
	  }
	  else
	  {
		  jQuery("#ein").val(output);
		  window.location = url;
	  }
	
  }
});
	 }else
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
		jQuery("#oName").val('Type in your favourite charity');
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
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<div id="fancybox-wrap2" style="width: 360px; height: auto; top: 20%; display: none; position:absolute; margin-left:510px;"><div id="fancybox-outer"><div id="fancybox-bg-n" class="fancybox-bg"></div><div id="fancybox-bg-ne" class="fancybox-bg"></div><div id="fancybox-bg-e" class="fancybox-bg"></div><div id="fancybox-bg-se" class="fancybox-bg"></div><div id="fancybox-bg-s" class="fancybox-bg"></div><div id="fancybox-bg-sw" class="fancybox-bg"></div><div id="fancybox-bg-w" class="fancybox-bg"></div><div id="fancybox-bg-nw" class="fancybox-bg"></div><div id="fancybox-content" style="border: 10px solid #FFFFFF; background:#FFFFFF; width: 340px; height: auto;"><div style="width:auto;height:auto;overflow: auto;position:relative;">
<div id="fancybox-loading" style="display: block;"><div style="top: 200px; left:160px;"></div></div>
<iframe width="340" scrolling="no" height="480" frameborder="0" marginwidth="0" marginheight="0" id="loc">

</iframe>
</div></div><a id="fancybox-close" style="display:block;" onclick="closeBox();"></a><div id="fancybox-title" style="display: none;"></div><a id="fancybox-left" href="javascript:;"><span id="fancybox-left-ico" class="fancy-ico"></span></a><a id="fancybox-right" href="javascript:;"><span id="fancybox-right-ico" class="fancy-ico"></span></a></div></div>
