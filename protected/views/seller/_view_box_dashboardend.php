<script type="text/javascript">







 $(document).ready(function() {







	// $("#fm").submit(function() {







	$("#pubz<?php echo $data->id;?>").attr("disabled", "disabled").css('opacity',0.5);







	 $('#admin_share<?php echo $data->id;?>').keyup(function(){







            if($(this).val != '' && $(this).val != 'Admin share'){







              $("#pubz<?php echo $data->id;?>").removeAttr("disabled").css('opacity',100);







            }







     });















       







});



















</script>







 <?php $org = $data->getOrgInfo();?>







 <?php $store = $data->getStoreInfo();







 $tax = $data->getUserTax();







 ?>











 <?php 







	$x = '';







	$x = array();



$chk = array();







	$x = $data->overAllSale();



	$chk = $data->overAllSaleCheckin();











	$today = date('Y-m-d');







?>







<?php if($data->status == 'published' && $data->expiry_date < $today)







			{







					// if published, we can only suspend it







			?>







<div class="b-line" style="height:7px; clear:both; margin-top:33px; margin-bottom:33px;"></div>

  <div class="co-left">

   <div class="co-number"><?php echo $data->couponcode;?></div>

   <div class="c-date">



     <?php echo $data->expiry_date;?><br /><span class="gray">ex</span><br /><br />



     <?php echo $x->paid_price+$x->donated;?>/<?php echo $x->paid_price;?>/<span class="orange"><?php echo $x->donated;?></span><br /><span class="gray">g/n/p</span><br /><br />



     <?php echo $x->quantity; ?>/<?php echo $chk->consumption_status; ?><br /><span class="gray">sold/check-in</span><br /><br />

<a href="#"><img src="images/plus_gray.png" alt="" border="0"  /></a>

   </div></div>



 <div class="co-right">



  <div class="co-right-left">



   <div class="co-title"><span><?php echo CHtml::encode($store->name);//Store Name?></span><br /><?php echo CHtml::encode($data->name); //Deal Name?></div>







<div class="co-image"><span><?php echo CHtml::encode($data->price); //Deal Regual Price?> <span class="orange">[<?php if(!empty($data->amount_share)){?>$<?php echo round($data->amount_share); } else{ echo round($data->percentage_share); ?>%<?php } ?>]</span></span><img src="images/image.png" alt="" /></div><br />


 <div class="co-prices"><span>$<?php echo CHtml::encode($data->regular_price); //Deal Regual Price?></span><span><?php echo round($data->price); //Deal Sale Price?>%</span><span>$<?php $disc = $data->regular_price*$data->price/100; echo CHtml::encode($data->regular_price - $disc); //Deal Regual Price?></span><span><?php echo $x->quantity; ?></span></div>


  <div class="co-prices-caption"><span>regular price</span><span>you save</span><span>discounted price</span><span>sold</span></div>


     <div class="hide-show">



    <div class="plus-minus" id="plus-minus"><a id="imageDivLink-<?php echo $data->id;?>" href="javascript:toggle('show-text-<?php echo $data->id;?>', 'imageDivLink-<?php echo $data->id;?>');"><img src="images/plus.png" alt="" border="0" /></a></div>



    <div class="show-text" id="show-text-<?php echo $data->id;?>">



       <p><b>Description:</b>&nbsp;<?php echo CHtml::encode($data->description); //Deal Description?></p>

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



   </div>

  </div><div class="result-right">

   <div class="pro-image"><br /><br /><?php $xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app->params["CHARITY_MAGIC"] ."&ein=".$data->ein."");



$xml = new SimpleXMLElement($xmlstr);



  foreach($xml->charity as $charity)



	{



	echo $charity->charity_name;



	}   ?></div>



  </div><br />



   <?php } ?>









  <br style="clear:both" />







 <hr style="clear:both; color:#40b0e5;" />

 



