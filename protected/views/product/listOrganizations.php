<br style="clear:both" />

<div class="non-profit">
 <div class="non-profit-top"></div>
  <div class="non-profit-area">
   <div class="profit-searchnew">
   <form id="frm" name="frm" method="post" action="">
   <input type="text" name="name" id="name" />
    <?php 
 $xmlcat =file_get_contents("http://www.charitynavigator.org/feeds/categories/");
 $cat = new SimpleXMLElement($xmlcat);
?>
        <select name="selectcat" id="selectcat">
		<option value="0">Select Category</option>
		 <?php
 		 foreach($cat->category as $category)
		{
		?>
		<option value="<?php echo $category->categoryid; ?>"><?php echo $category->category; ?></option>
		<?php } ?>
		<option value="4star">4 Star Charities</option>
        </select>
		<?php 
 $xmlstate =file_get_contents("http://www.charitynavigator.org/feeds/states/");
 $sat = new SimpleXMLElement($xmlstate);
?>
        <select name="selectsat" id="selectsat">
		<option value="0">Select State</option>
		 <?php
  foreach($sat->state as $state)
{
?>
		<option value="<?php echo $state->stateid; ?>"><?php echo $state->statename; ?></option>
		<?php } ?>
      </select>
   </form>
    </div>
   </div>
  </div>
 <div class="non-profit-bottom"></div>
</div>
