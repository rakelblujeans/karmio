<!--Slider Started-->
<?php
//Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $product->id)), 'og:url');
//Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true).'/'.$product->picture, 'og:image');
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $product->id)), 'og:url');
Yii::app()->clientScript->registerMetaTag($product->name, 'og:title');
Yii::app()->clientScript->registerMetaTag($product->facebook_text, 'og:description');
Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true) . '/' . $product->picture, 'og:image');
?>


<!--meta name="description" content="<?php echo $product->description ?>" /-->
<!--meta content='<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $product->id)) ?>' property='og:url'/-->
<!--meta content='<?php echo Yii::app()->getBaseUrl(true) . '/' . $product->picture ?>' property='og:image'/-->

<!--meta property="og:type" content="article"/-->
<!--meta property="og:description" content="<?php echo $product->facebook_text ?>" /-->
<!--meta property="og:title" content="title" /-->
<!--meta property="og:description" content="description" /-->
<!--meta property="og:image" content="thumbnail_image" /-->

<link rel="image_src" href="<?php echo Yii::app()->getBaseUrl(true) . '/' . $product->picture ?>"/>
<style type="text/css">

    
    #fancybox-loading div {
        background-image: url("<?php echo Yii::app()->baseUrl ?>/images/ajax-loading.gif");
        height: 480px;
        left: 0;
        position: absolute;
        top: 0;
        width: 31px;
        height:31px
    }
    #fancybox-close {
        background: url("<?php echo Yii::app()->baseUrl ?>/images/fancybox.png") repeat scroll -40px 0 transparent;
        cursor: pointer;
        display: none;
        height: 30px;
        position: absolute;
        right: -15px;
        top: -15px;
        width: 30px;
        z-index: 1103;
    }
    .qtip-cream{ top:670px !important;}
   
    
    
    <?php
    $count = 1;
    if (count($products))
    //foreach($products as $product){//Yii::app()->baseUrl.'/images/Backgrounds/bg_00'.$count.'.jpg
        if ($product->picture != '') {
            echo '           
.bg-img-' . $count . ' {
	background-image: url(' . Yii::app()->getBaseUrl(true) . '/' . $product->picture . ' );}';
        } else {
            echo '           
.bg-img-' . $count . ' {
	background-image: url(' . Yii::app()->getBaseUrl(true) . '/images/orgLogos/GreenBank.jpg' . ' );}';
        }
    $count++;
    //}
    ?>

    .fine-print{ margin-top:180px; z-index:600; margin-left:20px;}

</style>
<div id="slider" class="sl-slider-wrapper">

    <div class="sl-slider">
        <?php
        $count = 1;
        if (count($products))
//foreach($products as $product){
            
            ?>

        <div class="sl-slide">
            <div class="sl-slide-inner">
                <div class="bg-img bg-img-<?php echo $count++ ?>"></div>
                <!--Main Body Started-->
                <div id="MainBody" class="CouponMainPage">
                    <div class="CenterAlign">
                        <div class="HundredPercent">

                            <div id="HomePage">

                                <div class="DealBox">
                                    <div class="RightSocialIcon">
                                        <div>
                                            <?php
                                            $image = urlencode(Yii::app()->getBaseUrl(true) . '/' . $product->picture);
                                            $url = Yii::app()->getBaseUrl(true) . '/index.php?r=product/index&product_id=' . $product->id;
                                            $title = str_replace("'", "", $product->name);
                                            $summary = str_replace("'", "", $product->fine_print);
                                            ?>


                                            <div id="fb-root"></div>
                                            <script>(function(d, s, id) {
                                                    var js, fjs = d.getElementsByTagName(s)[0];
                                                    if (d.getElementById(id))
                                                        return;
                                                    js = d.createElement(s);
                                                    js.id = id;
                                                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=" + <?php echo Yii::app()->params['FB_APP_ID']; ?>;
                                                    fjs.parentNode.insertBefore(js, fjs);
                                                }(document, 'script', 'facebook-jssdk'));</script>

                                            <script type="text/javascript">
                                                function fbs_click() {

                                                    u = '<?php echo $url ?>';
                                                    t = '<?php echo $title ?>';
                                                    window.open("http://www.facebook.com/sharer.php?u=" + encodeURIComponent(u) + "&t=" + encodeURIComponent(t) + "&picture=<?php echo $image ?>&content=<?php echo $product->facebook_text ?>", "sharer", "toolbar=0,status=0,width=626,height=436");
                                                    return false;
                                                }
												
                                            </script></div>
                                        <ul>

                                            <li>

                                            <fb:share-button href="http://beta.karm.io/index.php?r=product/index&product_id=<?php echo $product->id; ?>" type="button"></fb:share-button>
                                            </li>
                                            <li><a href="https://twitter.com/share" data-text="<?php echo $product->twitter_text ?>" class="twitter-share-button" target="_blank" data-count="none" ><img src="<?php Yii::app()->getBaseUrl(true) ?>/images/IconTwitter.png" alt="Icon" /></a></li>
                                        </ul>
                                    </div>
                                    <div class="DealBoxTop"></div>
                                    <div class="DealBoxMid">

                                        <div class="TopBox">
                                            <div class="cheading" id="cheading<?php echo $product->id ?>"><?php echo $product->name ?></div>

                                            <?php
                                            $store = array();
                                            $store = $product->getStoreInfo();
                                            echo CHtml::link('Location', 'javascript:void(-1)', array('onclick' => 'showLocation("' . Yii::app()->createAbsoluteUrl('/userStore/gmapStore', array('st_id' => $store->id)) . '")', 'class' => 'Locationf', 'style' => 'float: right; font-size: 10px; text-transform: uppercase')); //store address
                                            ?>


                                            <p>
                                                <?php echo $product->description ?>

                                            </p>

                                            <a href="#" class="FinePrint" onclick="show_fineprint('fine-print<?php echo $product->id ?>')">Fine Print</a>
                                        </div>

                                        <div class="fine-print" id="fine-print<?php echo $product->id ?>">
                                            <p class="close-p"><a href="#" onclick="close_fineprint('fine-print<?php echo $product->id ?>')">close</a></p>                                 <p>
                                                <?php echo $product->fine_print ?>
                                            </p>
                                        </div>
                                        <div class="fine-print" id="location<?php echo $product->id ?>">
                                            <p class="close-p"><a href="#" onclick="close_fineprint('location<?php echo $product->id ?>')">close</a></p>                                 	<p>
                                                <?php
                                                $store = array();
                                                $store = $product->getStoreInfo();
                                                $user = $product->getUserTax();
                                                $loc2 = $product->getStatename();
                                                $cty2 = $product->getCityname();

                                                if (empty($product->address)) {
                                                    echo CHtml::link(CHtml::encode(strtoupper($store->address)), array('/userStore/gmapStore', 'st_id' => $store->id), array('class' => 'mapBox'));
                                                    ?><br /><?php echo $cty2; ?><br/>  <?php echo strtoupper($loc2); ?>, &nbsp;<?php echo $store->zip; ?><br><?php echo CHtml::encode($user->cellphone); ?><?php
                                                } else {
                                                    echo CHtml::link(CHtml::encode(strtoupper($product->address)), array('/userStore/gmapStore', 'pro_id' => $product->id), array('class' => 'mapBox'));
                                                    ?><br /><?php echo $loc2->value; ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<br><?php echo CHtml::encode($user->cellphone); ?><?php } ?>
                                            </p>
                                        </div>

                                        <div class="CouponTotalPrice" style="width:150px; text-align:left !important;">
                                            <span style="margin-left:13px; margin-right:5px;">$<?php
						  $disc = ($product->price * $product->regular_price) / 100;
echo round($product->regular_price - $disc, 2);  //Deal Regual Price
                                                ?></span>
						<span style="color:#979797; font-size:18px; position:relative; top:-5px; text-decoration:line-through; " ><?php echo ' ($' . round($product->regular_price, 2) . ') '; ?></span>
                                            <span class="CouponDetailPrice">pledge included</span>
                                        </div>

                                        <ul class="CouponSaving">
                                            <li>

                                                <span style="font-weight:normal;" class="InputPrice"><?php
                                                    if ($product->price == '') {
                                                        print "0";
                                                    } else {
                                                        echo round($product->price);
                                                    }
                                                    ?>%</span>
                                                savings
                                            </li>
                                            <li>
                                                <span style="font-weight:normal;" class="InputPrice" id="total_coupons"><?php
                                                    $sold_coupons = UserPurchase::model()->findAll('product_id=' . $product->id);
                                                    echo count($sold_coupons) . '/' . $product->coupons;
                                                    ?></span>purchased
                                            </li>
                                            <li>
                                            <?php 
						    if($product->remainingTime() && $product->remainingTime() != 'Expired'){?>
                                            <div id="defaultCountdown" style="width:40px;color: #1b1b1b; font-size: 18px; font-weight:normal" ></div>
                                            <?php }else{?>
                                            <span style="font-weight:normal;" class="InputPrice" ><?php echo $product->remainingTime(); ?> 
                                            
                                            </span><?php if($product->remainingTime() != 'Expired'){?>remaining<?php }?>
                                            <?php }?>
                                            </li>
                                        </ul>   


                                    </div>  
                                    <!--red box started-->

                                    <div class="RedBoxContents">
                                        <span class="CouponPrice">$<?php echo round($product->amount_share); ?></span>
                                        <p class="CouponDetail">from every coupon will be donated to</p>
                                        <?php if ($product->charity) { ?>
                                            <h3 class="CouponTitle">
                                                <?php
                                                echo $product->charity->name;
                                                ?>
                                            </h3>
                                            <input type="hidden" name="ein" id="ein" value="<?php echo $product->ein ?>"/>

                                        <?php } else {
                                            ?>
                                            <h3 class="CouponTitle" style="margin-top:-2px;">
                                                <input id="oName" type="text" class="ShadowTextBox" value="Type in your favorite charity" onfocus="javascript:if (this.value == 'Type in your favorite charity')
                                                            this.value = ''" onkeyup="searchOrg(this.value)" />
                                                <!--<input type="hidden" name="ein" id="ein" />-->
                                            </h3>
                                            <div id="suggestion"></div>
                                            <a href="<?php echo Yii::app()->createAbsoluteUrl('product/charitySearch', array('product_id' => $product->id)) ?>" id="advanced">Advanced Search</a>
                                        <?php } ?></h3>


                                    </div>   

                                    <!--red box ended-->

                                    <div class="DealBoxMid">   
                                        <a href="javascript:void(-1)" onclick="buy_it('<?php echo CController::createUrl('/product/buyNow', array('pid' => $product->id)); ?>')" class="BuyButton"><img src="images/BuyButton.png" alt="Buy" /></a>
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

		<?php

		if($product->remainingTime()  && $product->remainingTime() != 'Expired'){
			$exp=$product->expiry_date;
		$newdate = strtotime ( '+1 day' , strtotime ( $exp ) ) ;
		$newdate = date ( 'Y-m-d' , $newdate );
		$ndate = strtotime($newdate)
		?>

			//alert('<?php echo $exp?>');					
		       var end = new Date('<?php echo $exp?>');
			
													var _second = 1000;
													var _minute = _second * 60;
													var _hour = _minute * 60;
													var _day = _hour *24
													
			var timer = setInterval(showRemaining, 1000);
			
													function showRemaining()
													{
														var now = new Date();
														var distance = end - now;//parseInt(parseInt(<?php echo $ndate?>) - now.getTime());
														
														var countdownElement = document.getElementById('defaultCountdown');

														if (distance < 0 ) {
														   // handle expiry here..
														   clearInterval( timer ); // stop the timer from continuing ..
														   countdownElement.innerHTML = '';
														   //alert('Expired'); // alert a message that the timer has expired..
														}
														else
														{
														var days = Math.floor(distance / _day);
														var hours = Math.floor( (distance % _day ) / _hour );
														var minutes = Math.floor( (distance % _hour) / _minute );
														var seconds = Math.floor( (distance % _minute) / _second );
														
														
														countdownElement.innerHTML = '';
		
														if(days > 0)
														  countdownElement.innerHTML += '<span style="white-space: nowrap;">'+ days+ ' days</span>';
														else {
														  if(hours < 10)
														    countdownElement.innerHTML += '0'+hours+ ':';
														  else
														    countdownElement.innerHTML += hours+ ':';
														  if(minutes < 10)
														    countdownElement.innerHTML += '0'+minutes+ ':';
														  else 
														    countdownElement.innerHTML += minutes+ ':';
														  if(seconds < 10)
														    countdownElement.innerHTML += '0'+seconds;
														  else
														    countdownElement.innerHTML += seconds;
														}
														countdownElement.innerHTML += ' <span style="color:#979797; font-weight:bold;font-size:12px;">remaining</span>';
														}

													}
													
			
													
											
												<?php }?>
                                                jQuery(document).ready(function() {

                                                    $("#cheading<?php echo $product->id ?>").boxfit({multiline: true});
                                                    $("#suggestion").mouseleave(function() {
                                                        if ($('#suggestion').is(':visible')) {
                                                            $("#suggestion").hide();
                                                        }
                                                    });
                                                    $('.nav-dots a[title]').qtip({style: {name: 'cream', tip: true, padding: 5,
                                                            background: '#f7f2ef',
                                                            color: 'black', textAlign: 'center',
                                                            border: {
                                                                width: 7,
                                                                radius: 5,
                                                                color: '#f7f2ef'
                                                            }}, position: {
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

        <?php //}  ?>

    </div><!-- /sl-slider -->

    <nav id="nav-arrows" class="nav-arrows">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $prev)) ?>"><span class="nav-arrow-prev">Previous</span></a>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $next)) ?>"><span class="nav-arrow-next">Next</span></a>
    </nav>

    <nav id="nav-dots" class="nav-dots" >
<!-- <span class="nav-dot-current"></span>-->
        <?php foreach ($products as $prod) { ?>

            <a href="<?php echo Yii::app()->createAbsoluteUrl('product/index', array('product_id' => $prod->id)) ?>" title="<?php echo $prod->description ?>" >
                <span <?php if ($product->id == $prod->id) { ?>class="nav-dot-current"<?php } ?>></span>
            </a>

        <?php } ?>
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

            var $navArrows = $('#nav-arrows'),
                    $nav = $('#nav-dots > span'),
                    slitslider = $('#slider').slitslider({
                onBeforeChange: function(slide, pos) {

                    $nav.removeClass('nav-dot-current');
                    $nav.eq(pos).addClass('nav-dot-current');

                }
            }),
            init = function() {

                initEvents();

            },
                    initEvents = function() {

                $nav.each(function(i) {

                    $(this).on('click', function(event) {

                        var $dot = $(this);

                        if (!slitslider.isActive()) {

                            $nav.removeClass('nav-dot-current');
                            $dot.addClass('nav-dot-current');

                        }

                        slitslider.jump(i + 1);
                        return false;

                    });

                });

            };
             
            return {init: init};

        })();

        Page.init();

    });

</script>
<script type="text/javascript">
    function show_fineprint(id)
    {
        if (document.getElementById(id).style.display == 'block')
            document.getElementById(id).style.display = 'none';
        else
            document.getElementById(id).style.display = 'block';
    }
    function close_fineprint(id)
    {
        $("#" + id).hide();
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
      if ( (typeof jQuery("#oName").val() == 'undefined' || jQuery("#oName").val() == '' || jQuery("#oName").val() == 'Type in your favorite charity') 
	   && typeof jQuery("#ein").val() == 'undefined')
        {
            alert('Select a charity before proceeding');
        }
        else {
	  if (typeof jQuery("#ein").val() == 'undefined')
            {
                $.ajax({
                    type: 'GET',
                    url: 'index.php?r=product/validateCharity',
                    data: 'charity=' + jQuery("#oName").val(),
                    success: function(output)
                    {
                        if (output == 'invalid')
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
            } else
            {
                window.location = url;
            }

        }

    }
    function validate_charity(obj)
    {

        $.ajax({
            type: 'GET',
            url: 'index.php?r=product/validateCharity',
            data: 'charity=' + obj.value,
            success: function(output)
            {
                if (output == 'invalid')
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
        if (val != '')
        {
            $.ajax({
                type: 'GET',
                async: true,
                url: 'index.php?r=product/searchOrg',
                data: 'key=' + val,
                success: function(output)
                {
                    if (output == '') {
                        alert('No Organization exist with name ' + val + '. Please search another term ');
                    }
                    else {
                        $("#suggestion").html(output);
                        $("#suggestion").show()
                    }
                }
            });
        }

    }
    function hideSuggestion()
    {
        $("#suggestion").hide();
    }
    function fill(name, ein, tag_line, stats)
    {


        $.ajax({
            type: 'GET',
            url: 'index.php?r=product/setCharitySession',
            data: 'charity=' + ein,
            success: function(output)
            {
                if (output == 'done')
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
<script>!function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = "//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, "script", "twitter-wjs");</script>

<div id="fancybox-wrap2" style="width: 360px; height: auto; top: 20%; display: none; position:absolute; margin-left:510px;"><div id="fancybox-outer"><div id="fancybox-bg-n" class="fancybox-bg"></div><div id="fancybox-bg-ne" class="fancybox-bg"></div><div id="fancybox-bg-e" class="fancybox-bg"></div><div id="fancybox-bg-se" class="fancybox-bg"></div><div id="fancybox-bg-s" class="fancybox-bg"></div><div id="fancybox-bg-sw" class="fancybox-bg"></div><div id="fancybox-bg-w" class="fancybox-bg"></div><div id="fancybox-bg-nw" class="fancybox-bg"></div><div id="fancybox-content" style="border: 10px solid #FFFFFF; background:#FFFFFF; width: 340px; height: auto;"><div style="width:auto;height:auto;overflow: auto;position:relative;">
                <div id="fancybox-loading" style="display: block;"><div style="top: 200px; left:160px;"></div></div>
                <iframe width="340" scrolling="no" height="480" frameborder="0" marginwidth="0" marginheight="0" id="loc">

                </iframe>
            </div></div><a id="fancybox-close" style="display:block;" onclick="closeBox();"></a><div id="fancybox-title" style="display: none;"></div><a id="fancybox-left" href="javascript:;"><span id="fancybox-left-ico" class="fancy-ico"></span></a><a id="fancybox-right" href="javascript:;"><span id="fancybox-right-ico" class="fancy-ico"></span></a></div></div>
