<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
 <?php  $cname = ($model->charity->name != '')?$model->charity->name:$cid->charity->name; ?>


<div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            
            <div id="HomePage">

        <div class="ThankyouBox" >
<div class="ThankyouPopup" style=" margin-top:145px; text-align:center; width:100%">

 <h3 class="red_bold RedH3">Thank you !</h3>
 <h3 class="RedHilight">Your unique code(s):</h3>   
 <h3 class="red_bold RedH3">  <?php echo $cid->invoice_id?></h3>
 <p class="SmTxt">you can also find this in your <a href="<?php echo CHtml::normalizeUrl(array('/user/buyersDashboard')); ?>" style="border:none">dashboard</a></p>
 <p class="red NormTxt"> As Karmio believes in transparency</p>
 <p class="RedHilight BoldTxt">$<?php echo $cid->donated;?>  for <?php echo $cname?></p>
 <p class="red NormTxt">is processed and will be delivered by networkforgood.org</p>
<p><img src="images/logo_network_for_good.png" alt="" /><br/>Network for Good will also send your tax deductible receipt via email.</p>
 
<!--<p class="red">10 sec, then redirect to main page </p>-->
</div> 

     <!--signin Box Ends Here-->     
          </div>  
                                  
</div>
</div>
</div>
</div>














 

<div class="clear"></div>

