<?php $store=array(); $store = $data->getStoreInfo();
$user = $data->getUserTax();
$loc2 = $data->getStatename();
$cty2 = $data->getCityname();
?>
<?php
$description="";
$description=$data->fine_print; ?>
<link rel="image_src" href="http://www.karm.io/design/images/logo.jpg" />

<div id="<?php echo $data->id;?>bookmark">

<div id="contentdeals">

<?php $bid=$data->id;?>

<div class="deals-top" >

<div class="deals-topleft">

&nbsp;

</div>

<div class="deals-topcenter">

<div class="deals-topcenterdiv">

<div class="share"><!-- AddThis Button BEGIN -->

<div class="sharebutton" style=" padding-left:200px;">

<!-- AddThis Button BEGIN -->

<?php $image=urlencode('http://karm.io/design/'.$data->picture);
	 // $url=urlencode('http://www.karm.io/design#'.$bid.'bookmark');
	   $url = Yii::app()->getBaseUrl(true);
      $title = str_replace("'", "",$data->name);
      $summary = str_replace("'", "",$data->fine_print);


?>
<script type="text/javascript">
function fbs_click(){
	
		u='<?php echo $url ?>';
		t='<?php echo $title?>';
		window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t)+"&picture=<?php echo $image?>","sharer","toolbar=0,status=0,width=626,height=436");return false;
		}
		</script>
<div class="fb">

<a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" target="_blank"  onclick="return fbs_click()">
<img src="images/fbshare.png" alt="Facebook" class="facebook-icon" style="border:none;" /></a>

<!--<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]=<?php //echo $data->facebook_text?>&p[url]=<?php //echo $url; ?>&p[images][0]=<?php //echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><img src="images/fbshare.png" border="0"></a>-->

</div>

<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fc69c3a0c6f109a"></script>

<!-- AddThis Button END -->

<div style="float:left; width:90px;">
<a href="https://twitter.com/share" data-text="<?php
echo $data->twitter_text?>" class="twitter-share-button" target="_blank" data-count="none" >Tweet</a>



</div>
</div>

<div class="dealimage"><img src="<?php echo ($data->picture)?$data->picture:'images/orgLogos/GreenBank.jpg'; ?>" width="334" height="198" /></div>

</div>

<div class="deal-des">

<?php 

$short = substr($data->fine_print, 0, 100);

$short = explode(' ', $short);

array_pop($short);

$short = implode(' ', $short);

//echo $short  //Deal Description?>
<?php echo $data->name; //Deal Name?>


<div class="deal-title">
<?php echo strtoupper($store->name); ?>

</div>


<div class="endline" >
<a href="#"  style=" float:right; color:#000000;  text-decoration:none; margin-top:-7px; font-family:Arial, Helvetica, sans-serif; font-size:9px;" onclick="show_fineprint('fine-print<?php echo $data->id?>')">
<b>FINE PRINT</b></a>
<hr />
</div>




<?php //echo $short?>

<div style="clear:both;"></div>
<div class="fine-print" style="display:none;" id="fine-print<?php echo $data->id?>">
<p style="text-align:right; margin:0px; margin-bottom:5px; "><a href="#" onclick="close_fineprint('fine-print<?php echo $data->id?>')">close</a></p>
<p>
<?php echo $data->fine_print?>
</p>
</div>



<div class="pledge"> 

<div class="pledge-amount"><div class="pledge-titleprice">$<?php  echo round($data->price);   //Deal Regual Price?></div><div class="pledge-title">pledge included</div></div>

<div class="buy"><a href="<?php echo CController::createUrl('/product/buyNow', array('pid'=>$data->id)); ?>"><img src="images/buy.jpg" border="0" /></a></div>

</div>

</div><!--pledge-->

</div>

<div class="deals-topright">

&nbsp;

</div>

</div><!--deals-top-->



<div class="deals-top">

<div class="deals-topleft">

<div class="pledgecent">

<?php if ($data->price == '') {
print "0";
}else{
echo round(((($data->regular_price)-($data->price))/($data->regular_price))*100);  }

?>%<span>savings</span></div>

<div class="pledgecent">

$<?php //if(!empty($data->price)) { echo round($data->price); } else { echo '0';  }
echo $data->regular_price  ?><span> regular price</span></div>

<div class="pledgecent">

<?php 
$sold_coupons = UserPurchase::model()->findAll('product_id='.$data->id);
echo $data->coupons- count($sold_coupons); ?><span>remaining </span></div>



</div>

<div class="deals-bottomcenter">
<div class="nonprofit-top"></div>

<div class="no-prfitbg">  <!--new div added-->
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
	echo  $cname = $data->charity->name;
	//echo substr($cname, 0, 46);
	//if(strlen($cname) > 46 ) echo '...';
	
 ?></div>
 </div>
 </div>
</div>
</div><!--/new div added-->

<div class="nonprofit-bottom"></div>
<div class="locationback">
<div class="location"><div class="lhead">Location: </div>
<div class="rdes"><?php 
if(empty($data->address)){
    echo CHtml::link(CHtml::encode(strtoupper($store->address)),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address?><br /><?php echo $cty2; ?><br/>  <?php echo strtoupper($loc2); ?>, &nbsp;<?php echo $store->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php
	}
	else
	{ 
	 echo CHtml::link(CHtml::encode(strtoupper($data->address)),array('/userStore/gmapStore','pro_id' => $data->id), array('class' => 'mapBox')); 
	?><br /><?php echo $loc2->value; ?>, &nbsp;<?php echo $cty2->value; ?> &nbsp;<?php //echo $data->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php }?></div>
</div>
</div>
</div>
<div class="deals-topright" style=" height:115px; display:table;">
<div style="display:table-cell; vertical-align:middle;">
<?php 

	echo $tagline= $data->charity->tag_line;

	
	?>


</div>


</div>

</div><!--deals-bottom-->



</div><!--contentdeals-->

 

 </div>

 </div>

 <script type="text/javascript">

 function show_fineprint(id)
 {
 	//if($("#fine-print2").attr('display') == 'none')
		

if(document.getElementById(id).style.display=='block')
document.getElementById(id).style.display='none';
else
document.getElementById(id).style.display='block';

	//else
		//$("#fine-print2").hide();
 }
 function close_fineprint(id)
 {

 	//if($("#fine-print2").attr('display') == 'none')
		$("#"+id).hide();
	//else
		//$("#fine-print2").hide();
 }
 </script>

 