<script type="text/javascript">
 $(document).ready(function() {
$("#preview").hide();
$(".preview").click(function()
{
$("#preview").show();
});
	// $("#fm").submit(function() {
	$("#pubz<?php echo $data->id;?>").attr("disabled", "disabled").css('opacity',0.5);
	$('#admin_share<?php echo $data->id;?>').keyup(function(){
           if($(this).val == ""){
              $("#pubz<?php echo $data->id;?>").attr("disabled", "disabled").css('opacity',0.5);
            }
			else if($(this).val == "Admin_share")
			{
			  $("#pubz<?php echo $data->id;?>").attr("disabled", "disabled").css('opacity',0.5);
			}
			else if($(this).val != "" && $(this).val != "Admin_share")
			{
			$("#pubz<?php echo $data->id;?>").removeAttr("disabled").css('opacity',100);
			}
    });
});
function submitformz(id){ 
          /* if($("#admin_share"+id).val() == ""){
              $("#pubz"+id).attr("disabled", "disabled").css('opacity',0.5);
            }
			else if($("#admin_share"+id).val() == "Admin_share")
			{
			  $("#pubz"+id).attr("disabled", "disabled").css('opacity',0.5);
			}
			if($("#twitter_text"+id).val() == ""){
              $("#pubz"+id).attr("disabled", "disabled").css('opacity',0.5);
            }
			else if($("#twitter_text"+id).val() == "Twitter Text")
			{
			  $("#pubz"+id).attr("disabled", "disabled").css('opacity',0.5);
			}
			else*/ if($("#admin_share"+id).val() != "" && $("#admin_share"+id).val() != "Admin_share" && $("#twitter_text"+id).val() != "" && $("#twitter_text"+id).val() != "Twitter Text")
			{
				
				$("#pubz"+id).removeAttr("disabled").css('opacity',100);
			}
			else
			{
				 $("#pubz"+id).attr("disabled", "disabled");
				 $("#pubz"+id).css('opacity',0.5);
			}
  }
function submitform()
{
var adm = $("#admin_share<?php echo $data->id;?>").val();
var errad = "";
error=false;
if(adm == '' || adm == 'Admin Share')
{
error=true;
$(".errad").addClass('error');
errad += "Enter Share";
}
if(error == false){
		$("#dashboard-status-update-form").submit();
	}else{
		$(".errad").html(errad);
	}
}
function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('#img_prev')
    .attr('src', e.target.result)
    .width(334)
    .height(198);
    };
    reader.readAsDataURL(input.files[0]);
    }
    }
</script>

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
															updateWidthFancy();
										

														}'

					),

    	)
	);
$org = $data->getOrgInfo();?>
 <?php $store = $data->getStoreInfo();
 $tax = $data->getUserTax();?>
 <?php 
$x = '';
$x = array();
$chk = array();
	$x = $data->overAllSale();
	$chk = $data->overAllSaleCheckin();
	$today = date('Y-m-d');
?>
<?php if($data->status == 'published' && $data->expiry_date >= $today)
{
// if published, we can only suspend it
?>
  <div class="co-left">
   <div class="co-number"><?php echo $data->couponcode;?></div>
   <div class="c-date">
    <?php echo $data->expiry_date;?><br /><span class="gray">ex</span><br /><br />
     <?php echo $x->paid_price+$x->donated;?>/<?php echo $x->paid_price;?>/<span class="orange"><?php echo $x->donated;?></span><br /><span class="gray">g/n/p</span><br /><br />
     <?php echo $x->quantity; ?>/<?php echo $chk->consumption_status; ?><br /><span class="gray">sold/check-in</span><br /><br />
 <?php if(!empty($x->quantity) && $x->quantity != 0){ ?><a href="<?php echo CController::createUrl('/seller/checkIn'); ?>" style="text-decoration:none;"><div class="co-number" style="padding:15px 0px 15px 0px;" >Check-in</div></a><?php } ?>
   </div></div>
 <div class="co-right">
  <div class="co-right-left">
   <div class="co-title"><span><?php echo CHtml::encode($store->name);//Store Name?></span><br /><?php echo CHtml::encode($data->name); //Deal Name?></div>

<div class="co-image"><?php echo CHtml::encode($data->price); //Deal Regual Price?><span class="orange">[<?php if(!empty($data->amount_share)){?>$<?php echo round($data->amount_share); } else{ echo round($data->percentage_share); ?>%<?php } ?>]</span></div><br />

  <div class="co-prices"><span>$<?php echo CHtml::encode($data->regular_price); //Deal Regual Price?></span><span><?php echo round(((($data->regular_price)-($data->price))/($data->regular_price))*100); //Deal Sale Price?>%</span><span><?php echo $x->quantity; ?></span><span><?php echo substr($data->remainingTime(),0,3); ?></span></div>


  <div class="co-prices-caption"><span>regular price</span><span>you save</span><span>sold</span><span>expire in</span></div>
    <div class="hide-show">
    <div class="plus-minus" id="plus-minus"><a id="imageDivLink-<?php echo $data->id;?>" href="javascript:toggle('show-text-<?php echo $data->id;?>', 'imageDivLink-<?php echo $data->id;?>');"><img src="images/plus.png" alt="" border="0" /></a></div>
<br>

    <div class="show-text" id="show-text-<?php echo $data->id;?>">
    <p><b>Fine Print:</b>&nbsp;<?php echo CHtml::encode($data->fine_print); //Deal Description?></p>
    </div>
   </div>
   <div class="d-location">LOCATION: <span><?php if(empty($data->address)){
    echo CHtml::link(CHtml::encode($store->address),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address
	}
	else
	{
	 echo CHtml::link(CHtml::encode($data->address),array('/userStore/gmapStore','pro_id' => $data->id), array('class' => 'mapBox')); 
	}
	?></span></div>
<div class="d-location">
<a href="<?php echo Yii::app()->createAbsoluteUrl('product/update' , array('id' => $data->id))?>" style="color:#FFFFFF;">
		EDIT
</a>
</div>
   </div>

  </div><div class="result-right">

   <div class="pro-image"><br /><br /><?php /*$xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app->params["CHARITY_MAGIC"] ."&ein=".$data->ein."");



$xml = new SimpleXMLElement($xmlstr);



  foreach($xml->charity as $charity)



	{



	echo $charity->charity_name;



	} */  ?></div>



  </div><br />



   <?php }

   

   else {?>



   



   <?php if($data->status == 'unpublished' || $data->status == 'holding')



   { ?>



   <a href="<?php echo CController::createUrl('product/delete',array('id'=>$data->id)); ?>" onclick="return confirm('Are you sure you want to delete this deal');"><img src="images/delete.png" /></a><?php  } ?>



    <?php if($data->status == 'unpublished')



   { ?>



   <a href="<?php echo CController::createUrl('product/update',array('id'=>$data->id,'ad'=>1)); ?>"><img src="images/edit.png" /></a>



<?php  } ?>



<div class="l-deal">

  <div class="deal-title"><?php if($data->status == 'unpublished' || $data->status == 'holding' ) { ?><span class="left-small">Posted by:&nbsp;<?php echo CHtml::encode($tax->fname);//Store Name?>&nbsp;<?php echo CHtml::encode($tax->lname);//Store Name?></span><?php } ?><br /><?php echo CHtml::encode($data->name); //Deal Name?></div>



  <div class="deal-regular-price">

   <div class="regular-price-r">$<?php echo CHtml::encode($data->regular_price); //Deal Regual Price?><br /><span>regular price</span></div>







   <div class="regular-price-r">$<?php echo CHtml::encode(round(($data->price/$data->regular_price)*100)); //Deal Sale Price?><br /><span>deal price</span></div>



    <?php if($data->status == 'unpublished')



   { ?>



    <div class="regular-price-r"><?php echo $data->coupons; ?><br /><span class="checked">coupons</span></div>







   <div class="s-pledged">[<?php if(!empty($data->amount_share)){?>$<?php echo round($data->amount_share); } else{ echo round($data->percentage_share); ?>%<?php } ?>]<br /><span class="checked">pledged</span></div>



   <?php } ?>







  </div>







  <div class="sold-price">



 <?php if($data->status != 'unpublished')



   { ?>

   <div class="sold"><?php echo $x->quantity; ?>/<?php echo $chk->consumption_status; ?><br /><span class="checked">sold/checked-in</span></div>

   <div class="s-gross">$<?php echo $x->paid_price+$x->donated;?><br /><span class="checked">gross income</span></div>

   <div class="net-incom">$<?php echo $x->paid_price;?><br /><span class="checked">net income</span></div>

   <div class="s-pledged">[$<?php echo $x->donated;?>]<br /><span class="checked">pledged</span></div>

   <?php if($data->status == 'suspended' || $data->status == 'ended' )

   { ?>

   <div class="time-remaining"><?php echo $data->remainingTime(); ?><br /><span class="checked">remaining time</span></div>

   <?php } ?>



<?php } ?>



  </div>

  <div class="deal-suspend">

   <div class="plus-minus" id="plus-minus"><a id="imageDivLink-<?php echo $data->id; ?>" href="javascript:toggle('show-text-<?php echo $data->id; ?>', 'imageDivLink-<?php echo $data->id; ?>');"><img src="images/plus.png" alt="" border="0" /></a></div>



	<?php } ?>

	<div class="status-update">

		<form action="<?php echo CController::createUrl('/seller/dashboard'); ?>" id="dashboard-status-update-form" method="post" enctype="multipart/form-data">

			<input type="hidden" name="id" value="<?php echo $data->id;?>" />

			<input type="hidden" name="status" value="<?php echo $status; ?>" />





			<?php if($data->status == 'published' && $data->expiry_date >= $today)

			{

			?>



				<input type="hidden" name="status_update" value="suspended" />



				<input type="image" src="images/status_update_suspend.png" />

			

				



			<?php

			}

			else if($data->status == 'suspended')

		{ ?>

				<input type="hidden" name="status_update" value="published" />



				<input type="image" src="images/status_update_publish.png" />

				<?php } 

			else if ($data->status == 'unpublished')
			{?>

				<input type="hidden" name="status_update" value="published" />

			<div style="margin-top:10px; float:left;margin-right:5px;">%<input name="admin_share" id="admin_share<?php echo $data->id;?>" type="text" style="width:100px; height:25px;" onfocus="if(this.value=='Admin_share')this.value='';" value="Admin_share"   onblur="submitformz(<?php echo $data->id;?>)" />
			
			<input name="twitter_text" id="twitter_text<?php echo $data->id;?>" type="text" style="width:100px; height:25px;" onfocus="if(this.value=='Twitter Text')this.value='';" value="Twitter Text"  onblur="submitformz(<?php echo $data->id;?>)" maxlength="140"/>
			<input name="facebook_text" id="facebook_text<?php echo $data->id;?>" type="text" style="width:100px; height:25px;" onfocus="if(this.value=='Facebook Text')this.value='';" value="Facebook Text"  onblur="submitformz(<?php echo $data->id;?>)" maxlength="140"/>
			
			</div><br />

				<input name="picture" type="file" onchange="readURL(this);" id="picture<?php echo $data->id;?>" />
				<a href="#preview" class="preview" >Preview</a>
				<input type="image" value="Publish" src="images/status_update_publish.png" id="pubz<?php echo $data->id;?>" />
			<?php } ?>
		</form>
	</div>
<?php  if($data->status != 'published')
			{ ?>
   <div class="show-text" id="show-text-<?php echo $data->id;?>">
    <p><b>Fine Print:</b>&nbsp;<?php echo CHtml::encode($data->fine_print); //Deal Description?></p>
    </div>
    <br style="clear:both" />
    <div class="d-location">LOCATION: 
    <span><?php if(empty($data->address)){
    echo CHtml::link(CHtml::encode($store->address),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address
	}
	else
	{
	 echo CHtml::link(CHtml::encode($data->address),array('/userStore/gmapStore','pro_id' => $data->id), array('class' => 'mapBox')); 

	} //store address?></span></div>

  </div>







 </div>







 <div class="result-right">







   <div class="pro-image"><br /><br /><?php /*$xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app->params["CHARITY_MAGIC"]. "&ein=".$data->ein."");







$xml = new SimpleXMLElement($xmlstr);







  foreach($xml->charity as $charity)







	{







	echo $charity->charity_name;







	} */  ?></div>







  </div>







<?php } ?>
 <br style="clear:both" />
 <hr style="clear:both; color:#40b0e5;" />
<div id="preview" style="width:390px; height:595px; z-index:1; background-color:#404040; display:none; ">
 <?php $store=array(); $store = $data->getStoreInfo();
 $user = $data->getUserTax();
 ?>
<div class="content-centerindex" style="height:595px;">
<div class="content-centertop">
<div class="share"><!-- AddThis Button BEGIN -->
<div class="sharebutton">
<!-- AddThis Button BEGIN -->

</div>
</div>
<div class="dealimage"> <img id="img_prev" src="<?php echo ($data->picture)?$data->picture:'images/orgLogos/GreenBank.jpg'; ?>" alt="your image"  width="334" height="198" /></div>
<div class="deal-des">

<?php 
$short = substr($data->fine_print, 0, 100);
$short = explode(' ', $short);
array_pop($short);
$short = implode(' ', $short);
?>
<?php echo $data->name; ?>
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

<div class="pledge-amount"><div class="pledge-titleprice">$<?php if(!empty($data->price)) { echo round($data->price); } else { echo round($data->regular_price);  } //Deal Regual Price?></div><div class="pledge-title">pledge included</div></div>

</div>
</div>
</div><!--pledge-->

<div class="nonprofit-top"></div>

<div class="non-profit">
<div style="background-color: rgb(242, 61, 52); float: left; width: 100%;">
<div style="float:left;display:table; vertical-align:middle; height:108px;">
<div class="non-profit-pledge">$<?php echo round($data->amount_share); //Deal Regual Price?></div>

<div class="non-profit-main">from every coupon will be donated to</div>

<div class="non-profit-title"> <?php 

	$cname = $data->charity->name;
	echo substr($cname, 0, 46);
	if(strlen($cname) > 46 ) echo '...';

	 ?></div>
</div>
</div>
</div>

<div class="nonprofit-bottom"></div>

<div class="location"><div class="lhead">Location: </div>

<div class="rdes">
<?php $store=array(); $store = $data->getStoreInfo();
$user = $data->getUserTax();
$loc2 = $data->getStatename();
$cty2 = $data->getCityname();
if(empty($data->address)){

    echo CHtml::link(CHtml::encode($store->address),array('/userStore/gmapStore','st_id' => $store->id), array('class' => 'mapBox')); //store address

	}

	else

	{ 
	$myCriteria = new CDbCriteria();
		//$myCriteria->select = 'SUM(quantity) AS quantity';
		$myCriteria->condition = "user_id = $data->user_id";
		$store = UserStore::model()->find($myCriteria);
	 echo CHtml::link(CHtml::encode(strtoupper($store->address)),array('/userStore/gmapStore','pro_id' => $store->id), array('class' => 'mapBox')); 
	?><br /><?php echo $store->state_id; ?>, &nbsp;<?php echo $store->location_id; ?> &nbsp;<?php //echo $data->zip; ?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?><?php }?><br><?php echo CHtml::encode($user->cellphone); //Deal Regual Price?></div></div>

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
 }
 function close_fineprint(id)
 {

 	//if($("#fine-print2").attr('display') == 'none')
		$("#"+id).hide();
	//else
		//$("#fine-print2").hide();
 }
 </script>