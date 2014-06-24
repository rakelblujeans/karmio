<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg) ')});
</script>
<?php if(isset(Yii::app()->user->isAdmin))



{?><a href="<?php echo CController::createUrl('/seller/dashboard'); ?>"><img src="images/backtoad.jpg" ></a>

<?php } ?>

 <div id="MainBody" style="padding-top:220px;">

 <div class="solo-in">
 <?php 
if($status == '')

			{?>
   <p>
	CHECK IN
	</p>
	<?php }?>
     <div>

      <form name="check" action="#" method="post">
		<?php if($status == ''){?>
       <input type="text" class="check-text" name="invoice" value="DEAL CODE" onfocus="if(this.value=='DEAL CODE')this.value='';" onblur="if(this.value=='')this.value='DEAL CODE';"/>

		<?php }?>

		<?php

			if($status != '')

			{?>
				<div class="check-status">
				<?php
				switch($status)

				{

					case 'valid':

					?>

					<!--	<img class="check-img" src="images/valid.png" alt="valid"/>-->

						<p>VALID</p>

					<?php

					break;

					case 'invalid':

					?>

						<!--<img class="check-img" src="images/invalid.png" alt="valid"/>-->

						<p>**INVALID CODE**</p>

					<?php

					break;

					case 'consumed':

						echo "<p>Already Used on </p><p>".date('Y-m-d', strtotime($coupon->collection_date))."</p>";

					break;

					case 'expired':

						echo "<p>Expired on </p><p>".date('Y-m-d', strtotime($coupon->expiry_date))."</p>";

					break;

				}?>
				</div>
				<?php 

			}

		?>

		 <?php if($status == ''){?>
      			 <input type="submit" class="check-submit" value="CHECK IN" />
	   <?php }else //if($status != 'valid')
	   {?>
	   <a href="javascript:void(-1)" style="text-decoration:none;" onclick="javascript:window.location = '<?php echo CHtml::normalizeUrl(array('/seller/checkIn')); ?>'">
	   <input type="button" class="check-submit" value="CHECK IN ANOTHER" style="display:inline;" /></a>
	   <?php }?>
	   <?php if($total > 0){?>
	<span style="color: #FFFFFF;float: right;font-size: 16px;font-weight: bold;padding: 10px 20px; text-align: right; width: 90%;"> Total <?php echo $used.'/'.$total?></span>
	<?php }?>
      </form>

     </div>

    

  



 </div>

</div>