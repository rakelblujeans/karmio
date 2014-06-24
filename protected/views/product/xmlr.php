  <script type="text/javascript">
function showResult()
{
document.getElementById("loadingmessage").style.display="block";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;

	 document.getElementById("loadingmessage").style.display="none";
	 //altRows('alternatecolor');
    }
  }
var cat=document.frm.selectcat.value;
var sat=document.frm.selectsat.value;
var str=document.frm.name.value;
xmlhttp.open("GET","<?php echo $this->renderPartial('_fun'); ?>?q="+str+"&cat="+cat+"&sat="+sat,true);

xmlhttp.send();
}
</script><?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>
<form name="frm" id="frm" method="post">
<table width="1000" border="0" bordercolor="#FF0000" style="border-collapse: collapse;">
    <tr> 
      <td colspan="6"><div align="center" class="style2">Search Non-Profit Organizations </div><br /></td>
    </tr>
    <tr>
      <td width="100"><span class="style3">&nbsp;Charity Name</span> </td>
      <td width="202"><label>
        <input type="text" name="name" id="name" />
      </label></td>
      <td width="116"><span class="style3">Category</span></td>
      <td width="215"><label>
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
      </label></td>
      <td width="127"><span class="style3">State</span></td>
      <td width="214"> <?php 
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
      </select></td>
    </tr>
    <tr>
      <td colspan="6"><br /><div align="center"><a href="#" onclick="showResult();"><img src="images/searchButton.png"  width="77" height="27" border="0"/></a> </div></td>
    </tr>
  </table>
  </form>
  <div id="loadingmessage" style='display:none'>
  <div align="center" ><img src='ajax-loading.gif' alt="..processing"/></div>
</div>
<div id="livesearch"></div>