<?php 
/*$this->widget('application.extensions.fancybox.EFancyBox', array(
    	'target'=>'a.Locationf',
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
	);*/
	?>
<!--Slider Started-->
<style>
<?php $count=1; if(count($products))
	foreach($products as $product){//Yii::app()->baseUrl.'/images/Backgrounds/bg_00'.$count.'.jpg
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
	$count++;}

?>

 .fine-print{ margin-top:180px; margin-left:20px;}

</style>
     <div id="slider" class="sl-slider-wrapper">

				<div class="sl-slider">
				<?php $count=1; if(count($products))
					foreach($products as $product){?>
                    
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
                                <ul>
                                <?php $image=urlencode(Yii::app()->getBaseUrl(true).'/'.$product->picture);
								   $url = Yii::app()->getBaseUrl(true);
									$title = str_replace("'", "",$product->name);
									$summary = str_replace("'", "",$product->fine_print);
							  	  ?>
									  <script type="text/javascript">
									  function fbs_click(){
										  
											  u='<?php echo $url ?>';
											  t='<?php echo $title?>';
											  window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t)+"&picture=<?php echo $image?>","sharer","toolbar=0,status=0,width=626,height=436");return false;
											  }
									  </script>
                                    <li><a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" target="_blank"  onclick="return fbs_click()">
                                    <img src="images/IconFacebook.png" alt="Icon" /></a></li>
                                    <li><a href="https://twitter.com/share" data-text="<?php echo $product->twitter_text?>" class="twitter-share-button" target="_blank" data-count="none" ><img src="<?php Yii::app()->getBaseUrl(true)?>/images/IconTwitter.png" alt="Icon" /></a></li>
                                </ul>
                            </div>
                                    <div class="DealBoxTop"></div>
                                    <div class="DealBoxMid">
                                         
                                         <div class="TopBox">
                                            <h1><?php echo $product->name?></h1>
                                            
                                            <?php 
											 $store=array(); $store = $product->getStoreInfo();
											echo CHtml::link('Location',array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'Locationf', 'style' => 'float: right; font-size: 10px; text-transform: uppercase')); //store address?>

                                            
                                            <p>
                                           <?php echo $product->description?>

                                            </p>
                                            
                                            <a href="#" class="FinePrint" onclick="show_fineprint('fine-print<?php echo $product->id?>', '<?php echo str_replace("'", "\'", $product->fine_print)?>')">Fine Print</a>
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
											echo count($sold_coupons); ?></span>purchased
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
                                                     <h3 class="CouponTitle"><?php echo $product->charity->name?></h3>
                                                     
                                                 </div>   
                            
                                        <!--red box ended-->
                                     
                                     <div class="DealBoxMid">   
                                        <a href="<?php echo CController::createUrl('/product/buyNow', array('pid'=>$product->id)); ?>" class="BuyButton"><img src="images/BuyButton.png" alt="Buy" /></a>
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
					
                    <?php }?>
					
				</div><!-- /sl-slider -->

				<nav id="nav-arrows" class="nav-arrows">
					<span class="nav-arrow-prev">Previous</span>
					<span class="nav-arrow-next">Next</span>
				</nav>
                
				<nav id="nav-dots" class="nav-dots">
                <span class="nav-dot-current"></span>
                <?php for($i=1; $i<count($products); $i++){?>
					
					<span></span>
					
				<?php }?>
				</nav>

			</div>   
        
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slitslider.js"></script>
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
$navArrows.children( ':last' ).on( 'click', function() {

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
								
							} );
						return { init : init };

				})();

				Page.init();
			
			});

		</script>
  <script type="text/javascript">
 function show_fineprint(id, text)
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
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
