<style>#fancybox-wrap2{	display: none;       outline: medium none;    padding: 20px;    position: absolute;    top: 10%;    z-index: 1101;}</style><?php set_time_limit(0);?><script type="text/javascript">  $(document).ready(function() {//document.getElementById('title').style.color="#00bff3";//document.getElementById('fine-print').style.color='#ffffff'; if( $("#publishDate").val() == "" ) {	 $("#publishDate").val('mm/dd/yy'); } if( $("#name").val() == "" ) {	 $("#name").val('TITLE OF YOUR POST'); } if( $("#fine_print").val() == "" ) {	 $("#fine_print").val('FINE PRINT OF YOUR POST'); } if( $("#endDate").val() == "" ) {	 $("#endDate").val('mm/dd/yy'); }  if( $("#expiryDate").val() == "" ) {	 $("#expiryDate").val('mm/dd/yy'); }  if( $("#redemingDateStart").val() == "" ) {	 $("#redemingDateStart").val('mm/dd/yy'); }  if( $("#redemingDateEnd").val() == "" ) {	 $("#redemingDateEnd").val('mm/dd/yy'); }  $(".titlebluediv").hide(); $("#discount").hide();if ($('#yes').is(':checked')){	$("#discount").show();}/*$('#title').click (function (){	document.getElementById('title').style.color="#00bff3";	document.getElementById('fine-print').style.color="#ffffff";	}); $('#fine-print').click (function (){	document.getElementById('fine-print').style.color="#00bff3";	document.getElementById('title').style.color="#ffffff";	});*/ $('#yes').click (function (){var thisCheck = $(this);if ($('#yes').is(':checked')){$("#discount").show();}else{$("#discount").hide();}});$(".titleblue").click(function(){$(".titlebluediv").show();$(".titlemaindiv").hide();});$(".titlemain").click(function(){$(".titlemaindiv").show();$(".titlebluediv").hide();});$('#1w').click (function (){if($("#endDate").val() == "" || $("#endDate").val() == 'mm/dd/yy'){	var date = new Date();}else{	var date = new Date( $("#endDate").val());}//var date=;date.setDate(date.getDate() + 7);var futDate=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();$("#expiryDate").val(futDate);});/*------------------*/$('#2w').click (function (){if($("#endDate").val() == "" || $("#endDate").val() == 'mm/dd/yy'){var date = new Date();}else{var date = new Date( $("#endDate").val());}date.setDate(date.getDate() + 14);var futDate=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear(); $("#expiryDate").val(futDate);});<!------------------------------------>$('#1m').click (function (){if($("#endDate").val() == "" || $("#endDate").val() == 'mm/dd/yy'){var date = new Date();}else{var date = new Date( $("#endDate").val());}date.setMonth(date.getMonth() + 1);var futDate=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear(); $("#expiryDate").val(futDate);});<!-------------------------->$('#2m').click (function (){if($("#endDate").val() == "" || $("#endDate").val() == 'mm/dd/yy'){var date = new Date();}else{var date = new Date( $("#endDate").val());}date.setMonth(date.getMonth() + 2);var futDate=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear(); $("#expiryDate").val(futDate);});/*------------------------*/ $('#6m').click (function (){if($("#endDate").val() == "" || $("#endDate").val() == 'mm/dd/yy'){var date = new Date();}else{var date = new Date( $("#endDate").val());}date.setMonth(date.getMonth() + 6);var futDate=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear(); $("#expiryDate").val(futDate);});/*-------------------------*/$('#1y').click (function (){if($("#endDate").val() == "" || $("#endDate").val() == 'mm/dd/yy'){var date = new Date();}else{var date = new Date( $("#endDate").val());}date.setFullYear(date.getFullYear()+1);var futDate=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear(); $("#expiryDate").val(futDate);});/*-----------------------*/$('#c100').click (function (){ $("#coupons").val(100);}); $('#c500').click (function (){ $("#coupons").val(500);}); $('#c1000').click (function (){ $("#coupons").val(1000);});   $('#c2000').click (function (){ $("#coupons").val(2000);}); $('#c3000').click (function (){ $("#coupons").val(3000);}); $('#c5000').click (function (){ $("#coupons").val(5000);});<!---------------------------->$(".chloc").click(function(){$("#show-addtext").show();});<!-----------------------> $('#close-button').click(function(){   var addr = $("#address").val();    var zip = $("#zip").val();	 var cityy = $("#Product_location_id").val();	  var statee = $("#Product_state_id").val();	  var stvalue=$("[name='Product[state_id]'] option:selected").text();	   var locvalue=$("[name='Product[location_id]'] option:selected").text();  $(".addr").text(addr);   $(".addr2").text(locvalue.toUpperCase() + ' ' + stvalue.toUpperCase() + ' ,' + zip.toUpperCase());  $.fancybox.close();	});<!-----------------------> $('#cancel-button').click(function(){  $.fancybox.close();	});	/*------------------------------*/	$('input[type="text"], textarea').click(function() {          $(this).addClass("black");  		 if (this.value == this.defaultValue){              this.value = ''; 			$(this).removeClass("black");          }          if(this.value != this.defaultValue){              this.select();  			$(this).addClass("black");         }  		});				$('input[type="text"], textarea').blur(function() {/*          $(this).addClass("black");  		 if (this.value == this.defaultValue){              this.value = ''; 			$(this).removeClass("black");          }          if(this.value != this.defaultValue){              this.select();  			$(this).addClass("black");         }  		*/}); }); function setVal(obj, val) {  	if(obj.value==val)obj.value="";	obj.style.color='#000000';	//obj.addClass('black');	 }</script><script type="text/javascript">    $(document).ready(function() {		//updateProductDate("exp","<?php echo $model->expiry_date; ?>");		//updateProductDate("frm","<?php echo $model->publish_date; ?>");		//updateProductDate("to","<?php echo $model->end_date; ?>");		//updateProductDate("exp","<?php echo $model->expiry_date; ?>");		//updateProductDate("exp","<?php echo $model->expiry_date; ?>");		$(".textfldsml").click(function(){this.style.color='#000000'; });    });    			 	 $(document).ready(function() {	 	 $(".publish").attr("disabled", "true");	 $(".publish").css('opacity',0.5);	 $('#Product_agree').click (function(){if ($('#Product_agree').is(':checked')){$(".publish").removeAttr("disabled", "disabled");	$(".publish").css('opacity',100);}else{ $(".publish").attr("disabled", "true");	 $(".publish").css('opacity',0.5);}});	 	// $("#fm").submit(function() {		<?php if(!isset($_GET['ad'])){?>      if ($("#orgName").val() != "" && $("#orgName").val() != "TYPE IN NAME OF THE CHARITY") {			//alert('aa');			//$("#orgName").attr("readonly", "true");			$("#search-buttom").attr("id", "button-dis");			$("#ein").attr("readonly", "true");			$("#name").removeAttr("readonly");			$("#fine_print").removeAttr("readonly");			$("#coupons").removeAttr("readonly");			$("#regular_price").removeAttr("readonly");			$("#price").removeAttr("readonly");				        } else {			//$("#amount_share").attr("readonly", "true");			//$("#name").attr("readonly", "true");			//$("#fine_print").attr("readonly", "true");			//$("#coupons").attr("readonly", "true");			//$("#regular_price").attr("readonly", "true");			//$("#price").attr("readonly", "true");			        }        <?php  } ?>   // });         });</script> <?php Yii::app()->getClientScript()->registerScript("ss","$('#Product_state_id').change(function (){   $.post('index.php?r=product/provalue', {p_stateid: $('#Product_state_id').val()}, function(data) {});});") ;?><?php $form=$this->beginWidget('CActiveForm', array(	'id'=>'product-form',	'enableAjaxValidation'=>false,	'htmlOptions' => array('enctype' => 'multipart/form-data'),	));	/*$this->widget('application.extensions.fancybox.EFancyBox', array(    	'target'=>'#search-buttom',		'config'=>array(							'enableEscapeButton'=> true,							'showCloseButton'	=> true,							'easingEnabled' =>true,							'hideOnOverlayClick'=> true,							'mouseEnabled' => true,							'href'				=> 'http://www.karm.io/design/cn/tt.php',							//'href'				=> 'http://localhost/design/CN/tt.php',							//'href'				=> 'http://dev.brilliantprogrammers.com/~asmashen/karmio/design/CN/tt.php',														'onClosed'			=> 'js:function(){														//$("#name").focus();														return true;													}',													),    	)	);*/	$this->widget('application.extensions.fancybox.EFancyBox', array(    	'target'=>'a.chloc',		'config'=>array(							'enableEscapeButton'	=> true,							'showCloseButton'		=> true,							'hideOnOverlayClick'	=> false,							'centerOnScroll'		=> true,							'margin-top'			=> '5',							'onClosed'			=> 'js:function(){														$("#show-addtext").hide();														return true;													}',							'onComplete'			=> 'js:function(){							$("#fancybox-content").css({"border-color":"#404040"});															updateWidthFancy();																													}'						),    	)	);?><div class="CenterContents" style="width:820px;"><div class="MyProfile" style="width:780px;"><div id="postdealrow"><div class="rowleft"><div class="heading">STEP 1.</div><div class="headingdetail">Choose from over <br />5000 Charities</div></div><!--rowleft--><div class="rowcenter"> <?php $nm='TYPE IN NAME OF THE CHARITY'; $nmm='';if(!empty($_GET['id']) || !empty($model->ein)){   	$nm= $model->charity->name;} if(isset($_POST['nm'])){ $nm= $_POST['nm']; } //else {$nm = '';}?><?php echo $form->textField($model,'oName',array('maxlength'=>90, 'autocomplete' => 'off', 'value'=>($nm)?$nm:'TYPE IN NAME OF THE CHARITY', 'class'=>"searchnpo", 'id'=>"orgName", 'onkeyUp' => 'searchOrg(this.value)')); ?>	         <input type="button" name="" id="" class="searchnpobutn" value="" onclick="showSearch()"/>	    <div id="suggestion"></div>	   <input name="ein" id="ein" type="hidden" value="<?php if($_POST){echo $_POST['ein'];} else {echo $model->ein;}?>" />    	<?php echo $form->hiddenField($model,'ein',array('maxlength'=>90)); ?>		<?php echo $form->error($model,'ein'); ?>		<div class="errein" style="color:#FF0000; font-size:12px"></div><br /><div class="dottedline"></div></div><!--rowcenter--><div class="rowright" style="text-align:left; margin-top:10px;"><a href="javascript:void(-1)" onclick="showSearch()" style="color:#00BFF3; font-size:16px; text-decoration:none;">Advance Search</a></div><!--rowright--></div><!--postdealrow--><div id="postdealrow"><div class="rowleft"><div class="heading">STEP 2.</div><div class="headingdetail">Think twitter, <br />Short and sweet!</div></div><!--rowleft--><div class="rowcenter"><div class="titlemain" id="title" style="color:#00BFF3">TITLE</div><div class="titlemaindiv"><?php echo $form->textArea($model,'name',array('maxlength'=>500, 'class'=>"textarea", 'id'=>'name','onClick'=>'setVal(this, "TITLE OF YOUR POST")')); ?><br /><?php echo $form->error($model,'name'); ?><div class="errname" style="color:#FF0000; font-size:10px"></div></div><div class="text">500 Char Max</div><div class="titlemain" id="fine-print" style="color:#00BFF3">FINE PRINT</div><div class=""><?phpecho $form->textArea($model,'fine_print',array('class'=>"textarea",'maxlength'=>500,'id'=>"fine_print","onclick"=>'setVal(this, "FINE PRINT OF YOUR POST")')); ?><br /><?php echo $form->error($model,'fine_print'); ?><div class="errname" style="color:#FF0000; font-size:10px"></div></div><div class="text">500 Char Max</div><br /><div class="dottedline"></div></div><!--rowcenter--><div class="rowright"></div><!--rowright--></div><!--postdealrow--><div id="postdealrow"><div class="rowleft"><div class="heading">STEP 3.</div><div class="headingdetail">Add Picture<br />(334x198)</div></div><!--rowleft--><div class="rowcenter"><?php echo $form->fileField($model,'picture',array('class'=>"file",'id'=>"picture", 'name' => 'picture', 'onchange' => 'readURL(this);')); ?><?php //echo $form->error($model,'fine_print'); ?><div class="dottedline"></div></div><!--rowcenter--><div class="rowright"></div><!--rowright--></div><!--postdealrow--><div id="postdealrow"><div class="rowleft"><div class="heading">STEP 4.</div><div class="headingdetail">All about money, <br />See if you can<br /> give some<br /> discount, just<br />to attract<br />more people</div></div><!--rowleft--><div class="rowcenter"><div class="rowcenter-row"><div class="rowcenter-rowleftreg">REGULAR PRICE</div><div class="rowcenter-rowrite"><?php echo $form->textField($model,'regular_price',array('maxlength'=>10,'class'=>'textfldsml','id'=>'regular_price')); ?><?php echo $form->error($model,'regular_price'); ?><div class="errrg" style="color:#FF0000; font-size:10px"></div></div></div><div class="rowcenter-row"><div class="rowcenter-rowleft">ANY DISCOUNT</div><div class="rowcenter-rowriteyes"><div class="yes">Y <input name="" type="checkbox" value="" id="yes" /></div><!--<div class="no"> N <input name="" type="checkbox" value="" /></div>--></div></div><div class="rowcenter-row" id="discount"><div class="rowcenter-rowleft">DISCOUNTED PRICE</div><div class="rowcenter-rowrite"><?php echo $form->textField($model,'price',array('maxlength'=>10,'class'=>'textfldsml','id'=>'price', 'onchange' => 'checkforg1(this)')); ?><?php echo $form->error($model,'price'); ?><div class="errp" style="color:#FF0000; font-size:10px;margin-top:20px;"></div></div></div><div class="rowcenter-rowred"><div class="rowcenter-rowleftwhite">$$ AMOUNT GOING TOWARDS CHARITY<br />(out of the final price)Min. $1.00</div><div class="rowcenter-rowrite"><?php echo $form->textField($model,'amount_share',array('maxlength'=>10, 'class'=>"textfldsml",'id'=>'amount_share')); ?></div></div><?php echo $form->error($model,'amount_share'); ?><div class="errpval" style="color:#FF0000; font-size:10px"></div><div class="dottedline"></div></div><!--rowcenter--><div class="rowright"></div><!--rowright--></div><!--postdealrow--><div id="postdealrow"><div class="rowleft"><div class="heading">STEP 5.</div><div class="headingdetail">Tentative dates<br />When does it <br />start, end<br /> and Expire</div><div class="headingdetail" style="margin-top:35px;">Redeming  date<br /></div></div><!--rowleft--><div class="rowcenter"><div class="rowcenter-rowdate"><div class="dateleft"><div class="lbl">START DATE</div> <?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(		'id'=>'publishDate',	'attribute'=>'publish_date',		'model'=>$model,	'options'=>array(		    'showAnim'=>'fold',			'dateFormat'=>'mm/dd/yy',		),		'htmlOptions'=>array(			'onchange'=>'javascript:updateProductDate("frm", "publishDate", this.value, "endDate");',			'class'=>"textfldsml",			'onfocus'=>'if(this.value=="mm/dd/yy")this.value="";',			'onblur'=>'if(this.value=="")this.value="mm/dd/yy";',		),	));	?>	<?php echo $form->error($model,'publish_date'); ?></div><div class="datecnt">TO</div><div class="dateleft"><div class="lbl">END DATE</div> <?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(		'id'=>'endDate',	'attribute'=>'end_date',		'model'=>$model,		'options'=>array(		    'showAnim'=>'fold',			'dateFormat'=>'mm/dd/yy',		),		'htmlOptions'=>array(			'onchange'=>'javascript:updateProductDate("to", "endDate", this.value, "publishDate");',			'class'=>"textfldsml",			'onfocus'=>'if(this.value=="mm/dd/yy")this.value="";',			'onblur'=>'if(this.value=="")this.value="mm/dd/yy";',		),	));	?>	<?php echo $form->error($model,'end_date'); ?></div></div><div class="rowcenter-rowdate" style=" background:none;"><div class="dateleft"><div class="lbl">START DATE</div> <?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(		'id'=>'redemingDateStart',	'attribute'=>'redeming_date_start',		'model'=>$model,	'options'=>array(		    'showAnim'=>'fold',			'dateFormat'=>'mm/dd/yy',		),		'htmlOptions'=>array(			'onchange'=>'javascript:updateProductDate("frm", "redemingDateStart" ,this.value, "redemingDateEnd");',			'class'=>"textfldsml",			'onfocus'=>'if(this.value=="mm/dd/yy")this.value="";',			'onblur'=>'if(this.value=="")this.value="mm/dd/yy";',		),	));	?>	<?php echo $form->error($model,'redeming_date_start'); ?></div><div class="datecnt">TO</div><div class="dateleft"><div class="lbl">END DATE</div> <?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(		'id'=>'redemingDateEnd',	'attribute'=>'redeming_date_end',		'model'=>$model,		'options'=>array(		    'showAnim'=>'fold',			'dateFormat'=>'mm/dd/yy',		),		'htmlOptions'=>array(			'onchange'=>'javascript:updateProductDate("to", "redemingDateEnd", this.value, "redemingDateStart");',			'class'=>"textfldsml",			'onfocus'=>'if(this.value=="mm/dd/yy")this.value="";',			'onblur'=>'if(this.value=="")this.value="mm/dd/yy";',		),	));	?>	<?php echo $form->error($model,'redeming_date_end'); ?></div></div><!--<div class="rowcenter"><div class="rowcenter-row"><div class="rowcenter-rowleftexp">EXPIRATION DATE<div class="smalldiv" id="1w">1Wk</div><div class="smalldiv" id="2w">2Wks</div><div class="smalldiv" id="1m">1Mo</div><div class="smalldiv" id="2m">2Mo</div><div class="smalldiv" id="6m">6Mo</div><div class="smalldiv" id="1y">1Yr</div></div><div class="rowcenter-rowrite"><?php echo $form->textField($model,'expiry_date',array('maxlength'=>90, 'class'=>"textfldsml",'id'=>'expiryDate')); ?> <?php echo $form->error($model,'expiry_date'); ?></div></div></div>--><div class="dottedline"></div></div><!--rowcenter--><div class="rowright"></div><!--rowright--></div><!--postdealrow--><div id="postdealrow"><div class="rowleft"><div class="heading">STEP 6.</div><div class="headingdetail"></div></div><!--rowleft--><div class="rowcenter"><div class="rowcenter-row"><div class="rowcenter-rowleft2">No. OF COUPONS<div class="smalldivv" id="c100">100</div><div class="smalldivv" id="c500">500</div><div class="smalldivv" id="c1000">1000</div><div class="smalldivv" id="c2000">2000</div><div class="smalldivv" id="c3000">3000</div><div class="smalldivv" id="c5000">5000</div></div><div class="rowcenter-rowrite"><?php echo $form->textField($model,'coupons',array('maxlength'=>10,'class'=>'textfldsml','id'=>'coupons')); ?><?php echo $form->error($model,'coupons'); ?></div></div><div class="dottedline"></div></div><!--rowcenter--><div class="rowright"></div><!--rowright--></div><!--postdealrow--><?php if(isset(Yii::app()->user->isAdmin)){?>	<div id="postdealrow">	<div class="rowleft">	<div class="heading">Twitter Text</div>	<div class="headingdetail">Text posted in tweet<br />	</div>	</div><!--rowleft-->	<div class="rowcenter">	<?php 	echo $form->textField($model,'twitter_text',array('class'=>"check-text",'id'=>"twitter_text", 'style' => 'color:#000;')); ?>	<?php echo $form->error($model,'twitter_text'); ?>	<div class="dottedline"></div>	</div><!--rowcenter-->	<div class="rowright"></div><!--rowright-->	</div><!--postdealrow-->		<div id="postdealrow">	<div class="rowleft">	<div class="heading">FaceBook Text</div>	<div class="headingdetail">Text posted on facebook<br />	</div>	</div><!--rowleft-->	<div class="rowcenter">	<?php 	echo $form->textField($model,'facebook_text',array('class'=>"check-text",'id'=>"facebook_text", 'style' => 'color:#000;')); ?>	<?php echo $form->error($model,'facebook_text'); ?>	<div class="dottedline"></div>	</div><!--rowcenter-->	<div class="rowright"></div><!--rowright-->	</div><!--postdealrow--><?php }?><div id="postdealrow"> <?php if(!isset($_GET['id'])){ ?><div class="rowleft"><div class="heading"></div><div class="heading">Verification Code</div></div><!--rowleft--><div class="rowcenter"><div class="rowcenter-row"> <?php if(CCaptcha::checkRequirements()): ?><div class="rowcenter-rowleftwhite"><?php $this->widget('CCaptcha'); ?></div><div class="rowcenter-rowrite" style="padding-left:20px;"><?php echo $form->textField($model,'verifyCode',array('class'=>'textfldsml','maxlength'=>10)); ?><?php echo $form->error($model,'verifyCode'); ?></div><?php endif; ?></div></div><!--rowcenter--><?php } ?><div class="rowright" <?php if(isset($_GET['id'])){echo 'style="margin-top:12px"';}?> ><div class="termslft" style=" margin-right:65px; float:right"><a class="preview" href="javascript:void(-1)" onclick="preview_deal()" style="color: #00BFF3; font-size: 14px; text-decoration: none;">Preview</a></div><br /> <?php if(isset($_GET['id'])){ ?>	<div  id='cancling'><a href="<?php echo Yii::app()->request->urlReferrer; ?>">Cancel</a></div>	<input type="button" name="Submit" value="Update" onclick='submitform();' class='signupbun'/>		<?php } else {?>	<?php echo CHtml::submitButton('SAVE!', array('name'=>'holding', 'class'=>'save','value'=>"")); ?>&nbsp;&nbsp;	<?php echo CHtml::submitButton($model->isNewRecord ? 'Publish' : 'Update', array('name'=>'publish',  'class'=>'publish', 'value'=>"")); ?><?php } ?>	<br /><div class="terms"><input type="hidden" name="pimage" id="pimage" /> <?php if(!isset($_GET['id'])){ ?><div class="termslft"><?php echo $form->checkbox($model,'agree'); ?></div><div class="termsrite">I AGREE TO TERMS AND CONDITIONS</div><?php echo $form->error($model,'agree'); ?><?php }?></div></div><!--rowright--></div><!--postdealrow--></div></div><?php $this->endWidget(); ?><script type="text/javascript">function showSearch(){		//$("#fancybox-overlay").show();	$("#fancybox-wrap2").show();	}function closeBox(){		//$("#fancybox-overlay").hide();	$("#fancybox-wrap2").hide();	}function closeBox3(){	$("#fancybox-wrap3").hide();	}function setValue(ein, name){	$("#orgName").val(name);	$("#ein").val(ein);	closeBox();}</script><div id="fancybox-wrap2" style="width: 620px; height: auto; top: 20%; display: none; position:absolute; margin-left:100px;"><div id="fancybox-outer"><div id="fancybox-bg-n" class="fancybox-bg"></div><div id="fancybox-bg-ne" class="fancybox-bg"></div><div id="fancybox-bg-e" class="fancybox-bg"></div><div id="fancybox-bg-se" class="fancybox-bg"></div><div id="fancybox-bg-s" class="fancybox-bg"></div><div id="fancybox-bg-sw" class="fancybox-bg"></div><div id="fancybox-bg-w" class="fancybox-bg"></div><div id="fancybox-bg-nw" class="fancybox-bg"></div><div id="fancybox-content" style="width: 550px; border-width: 10px; height: auto;"><div style="width:auto;height:auto;overflow: auto;position:relative;" ><?php echo $this->renderPartial('charities_popup');?></div></div><a id="fancybox-close" style="display:block;" onclick="closeBox();"></a><div id="fancybox-title" style="display: none;"></div><a id="fancybox-left" href="javascript:;"><span id="fancybox-left-ico" class="fancy-ico"></span></a><a id="fancybox-right" href="javascript:;"><span id="fancybox-right-ico" class="fancy-ico"></span></a></div></div><div id="fancybox-wrap3" style="width: 430px; height: auto; display: none; position:fixed; top:5%;  margin-left:150px;"><div id="fancybox-outer"><div id="fancybox-bg-n" class="fancybox-bg"></div><div id="fancybox-bg-ne" class="fancybox-bg"></div><div id="fancybox-bg-e" class="fancybox-bg"></div><div id="fancybox-bg-se" class="fancybox-bg"></div><div id="fancybox-bg-s" class="fancybox-bg"></div><div id="fancybox-bg-sw" class="fancybox-bg"></div><div id="fancybox-bg-w" class="fancybox-bg"></div><div id="fancybox-bg-nw" class="fancybox-bg"></div><div id="fancybox-content" style="width: 550px; border-width: 10px; height: auto;"><div style="width:auto;height:auto;overflow: auto;position:relative;" id="mid-content"></div></div><a id="fancybox-close" style="display:block;" onclick="closeBox3();"></a><div id="fancybox-title" style="display: none;"></div><a id="fancybox-left" href="javascript:;"><span id="fancybox-left-ico" class="fancy-ico"></span></a><a id="fancybox-right" href="javascript:;"><span id="fancybox-right-ico" class="fancy-ico"></span></a></div></div><script type="text/javascript">function submitform(){var ein = $("#ein").val();var errein = "";var name = $("#name").val();var errname = "";var coupons = $("#coupons").val();var errcp = "";var regular = $("#regular_price").val();var errrg = "";var price = $("#price").val();var errp = "";var pVal = $("#amount_share").val();var errpval = "";var error= false;if(ein == ''){error=true;$("#ein").addClass('error');errein += "Npo is required";}if(pVal == ''  || pVal=='PLEDGE'){error=true;$("#amount_share").addClass('error');errpval += "Pledge amount is required";}else if(pVal<10){error=true;$("#amount_share").addClass('error');errpval += "Pledge amount should be greater than 1";}if(name == '' || name == 'TITLE OF YOUR POST'){error=true;$("#name").addClass('error');errname += "Title can not be blank";}if(coupons == ''){error=true;$("#coupons").addClass('error');errcp += "Enter no of coupons";}if(regular == ''){error=true;$("#regular_price").addClass('error');errrg+= "Enter regular price";}if(price != ''){ if(parseFloat(price) > parseFloat(regular)){	error=true;$("#price").addClass('error');errp += "This price should be less than regualar price";}}if(error == false){		$("#product-form").submit();	}else{		$(".errein").html(errein);		$(".errname").html(errname);		$(".errcp").html(errcp);		$(".errrg").html(errrg);		$(".errp").html(errp);		$(".errpval").html(errpval);}}function searchOrg(val){//alert(val);	if(val != '')	{		$.ajax({		type: 'GET',		async: true,		url:'index.php?r=product/searchOrg',		data: 'key='+val,		success: function(output)		{		if(output == ''){			alert('No Organization exist with name '+val+'. Please search another term ');		}		else{		  $("#suggestion").html(output);		  $("#suggestion").show()		  }		}		});	}}function fill(name, ein, tag_line, stats){	$("#orgName").val(name);	$("#ein").val(ein);	$("#Product_ein").val(ein);	$("#suggestion").hide();}function load_business(action){		 var url = '';	 if(action == 'add')	 	url = '<?php echo $this->createAbsoluteUrl('userStore/create', array('fbox' => '1'))?>';	else		url = '<?php echo $this->createAbsoluteUrl('userStore/update', array('id' => $business_id, 'fbox' => '1'))?>';		 stickyStore(url);}function checkforg1(obj){  if($(obj).val() < 10)  {  	$(obj).val('');	alert('Please add a value greater than or equal to 1');  }}function preview_deal(){	$.ajax({		type: 'POST',		url:'index.php?r=product/previewDeal',		data: $("#product-form").serialize(),//'key='+val,		success: function(output)		{		//$("#fancybox-wrap2").show();			if($("#picture").val() != '')			{				if($.browser.msie)				{															output = output.replace("my_deal_image", 'images/orgLogos/GreenBank.jpg');				}				else				{							output = output.replace("my_deal_image", $("#pimage").val());				}			}			else			{				output = output.replace("my_deal_image", 'images/orgLogos/GreenBank.jpg');			}		  $("#mid-content").html(output);		  $("#fancybox-wrap3").show()		}		});}function readURL(input) {	if (input.files && input.files[0]) {		var reader = new FileReader();		reader.onload = function (e) {			$('#pimage').val(e.target.result);		}		reader.readAsDataURL(input.files[0]);	}}</script><script type="text/javascript"> function show_fineprint(id) { 	//if($("#fine-print2").attr('display') == 'none')if(document.getElementById(id).style.display=='block')document.getElementById(id).style.display='none';elsedocument.getElementById(id).style.display='block'; } function close_fineprint(id) { 	//if($("#fine-print2").attr('display') == 'none')		$("#"+id).hide();	//else		//$("#fine-print2").hide(); } </script>