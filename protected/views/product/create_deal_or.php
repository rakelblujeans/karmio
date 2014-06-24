<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabcontent.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jcarouse.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.blockUI.js"></script>

<script type="text/javascript"> 
 
    // unblock when ajax activity stops 
    $(document).ajaxStop($.unblockUI); 
 
    
   
 
</script> 
	<script type="text/javascript">
		
		jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)');
		 $(".cheading").boxfit({multiline: true});
		
		
		});
		function check_all_filled()
		{
			if(jQuery("#redemingDateStart").val() != '' && jQuery("#redemingDateEnd").val() != '' && jQuery("#title").val() != '' && jQuery("#fine_print").val() != '' && jQuery("#regular_price").val() != '' && jQuery("#amount_share").val() != '' && jQuery("#coupons").val() != '' && jQuery("#oName").val() != '')
			{
				jQuery("#submit").css('opacity', '1');
				jQuery("#submit").css('cursor', 'pointer');
				return true;
			}
			else
				return false;
		}
		function setText(obj, id)
		{
			var val = obj.value;
			
			if(id == "name")
			{
				if(val.length > 140 )
				val = val.substr(0, 140);
			}
			if(id == 'discount')
			{
				if(val > 100 )
				{
					jQuery("#discountf").val('');
					val = '';
					alert(' Maximum discount for charity is 100%');
				}
			}
			if(id == 'charity')
			{
				if(val < 10 )
				{
					jQuery("#amount_share").val('');
					val = '';
					alert(' Minimum amount for charity is 10');
				}
				else if(parseInt(jQuery("#price").html()) < val)
				{
					jQuery("#amount_share").val('');
					val = '';
					alert(' Charity amount can not be greater than price');
				}
			}
			if(id == 'discount' || id == 'price')
			{
				if(jQuery("#regular_price").val() != '' && $("#discountf").val() != '')
				{
						
					var disc = Math.round((jQuery("#discountf").val()*jQuery("#regular_price").val())/100);
					disc = Math.round(jQuery("#regular_price").val() - disc);
					jQuery("#discountprice").val(disc);
					if(jQuery("#amount_share").val() != '' && parseInt(jQuery("#amount_share").val()) > disc)
					{
						jQuery("#amount_share").val('');
						alert(' Charity amount can not be greater than price');
					}  
					if(id == 'price')
					{
						val = disc;
						
					}
					else
					{
						jQuery("#price").html(disc);
						val = obj.value+' %';
					}
				}
			}
			jQuery("#"+id).html(val);
			check_all_filled();
		}
		
		
		function fillCoupons(count){
			jQuery("#coupons").val(count);
			jQuery("#total_coupons").text(count);
			check_all_filled();
		}
		function readURL(input) {
		  if (input.files && input.files[0]) {
			  var reader = new FileReader();
	  
			  reader.onload = function (e) {
				  $('#pimage').val(e.target.result);
			  }
	  
			  reader.readAsDataURL(input.files[0]);
		  }
	  }
	  function setCharity(ein, oName, oLogo)
	  {
		  jQuery("#ein").val(ein);
		  jQuery("#charity_name").html(oName);
		  jQuery("#charity_name").css('opacity' , '1');
		  jQuery("#charity_name").css('border-bottom' , 'none');
		  jQuery("#oName").val(oName);
		  jQuery("#charity_check").removeAttr('checked');
		  document.getElementById('mycharity').innerHTML=oName;
		  document.getElementById('mycharitylogo').innerHTML= '<img class="cover" height="100" width="100" src="'+oLogo+'" alt="'+oName+'" title="'+oName+'" style="box-shadow: 5px 5px 5px #888;" />';

		  closeBox();
		  check_all_filled();
	  }
	  function setCharity2(obj)
	  {
		  //if($(obj).is(':checked'))
		  {
		   var html ='<input type="text" disabled="disabled" class="TxtField" style="width:300px; font-size:13px;">';
		   jQuery("#ein").val('');
		   jQuery("#charity_name").html(html);
		  jQuery("#charity_name").css('opacity' , '1');
		  jQuery("#charity_name").css('border-bottom' , 'none');
		   jQuery("#oName").val('User will choose charity');
		   document.getElementById('mycharity').innerHTML='';
		   document.getElementById('mycharitylogo').innerHTML='';
		   check_all_filled();
		  }
	  }
	  function submit_form()
	  {
		  if(check_all_filled()){
		   	jQuery("#product-form").submit();
			  $.blockUI({ message: '<h1><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loader.gif" height="30" width="30" /> Please Wait ...</h1>' }); 
			  }
	  }
	  function closeErrors()
	  {
		  jQuery(".errors").hide();
	  }
	  
		function uploaded_preview(input)
		{
					if (input.files && input.files[0]) {
					  var reader = new FileReader();
			  
					  reader.onload = function (e) {
						$('#pimage').val(e.target.result);
					  }
			  
					  reader.readAsDataURL(input.files[0]);
				  }

					
					jQuery('body').css('backgroundImage', $("#pimage").val());	
					
				
			
		}
	</script>
    
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>  
    
    <script type="text/javascript" language="javascript">
	 
	var characterLimit = 140;  
		  
google.setOnLoadCallback(function(){  
      
    $('#charNum').html(characterLimit);  
      
    $('#title').bind('keyup', function(){  
        var charactersUsed = $(this).val().length;  
          
        if(charactersUsed > characterLimit){  
            charactersUsed = characterLimit;  
            $(this).val($(this).val().substr(0, characterLimit));  
            $(this).scrollTop($(this)[0].scrollHeight);  
        }  
          
        var charactersRemaining = characterLimit - charactersUsed;  
          
        $('#charNum').html(charactersRemaining);  
    });  
});  

var characterLimit1 = 500;  
		  
google.setOnLoadCallback(function(){  
      
    $('#charNum2').html(characterLimit1);  
      
    $('#fine_print').bind('keyup', function(){  
        var charactersUsed1 = $(this).val().length;  
          
        if(charactersUsed1 > characterLimit1){  
            charactersUsed1 = characterLimit1;  
            $(this).val($(this).val().substr(0, characterLimit1));  
            $(this).scrollTop($(this)[0].scrollHeight);  
        }  
          
        var charactersRemaining1 = characterLimit1 - charactersUsed1;  
          
        $('#charNum2').html(charactersRemaining1);  
    });  
});  
</script>  
	</script>
<div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            
            
            
            	  
                    <div id="MainBody2">
                      <div class="CenterAlign">
                      <div class="HundredPercent">
                      
                      <div id="HomePage">
                    
                <div class="DealBox">
                    <div class="DealBoxTop"></div>
                    <div class="DealBoxMid">
                          
                         <div class="TopBox">
                            <div class="cheading"><?php $user = User::model()->findByPk(Yii::app()->user->id);echo $user->storeName?></div>
                            <a href="#" class="FinePrint">Location</a>
                            
                           <a href="javascript:void(0)" style="color:#000000;" onclick="tabs.open('view1');"> <p class="InputPrice" id="name">
                             _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _<br />
                             _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _
                            </p></a>
                            
                            <a href="#" class="FinePrint">FinePrint</a>
                         </div>
                         
                         
                         <div class="CouponTotalPrice">
                            <a href="javascript:void(0)" style="color:#FB3F36;" onclick="tabs.open('view2'); return false;"> $ <span class="InputPrice" id="price">_ _ _</span></a>
                            <span class="CouponDetailPrice">pledge included</span>
                         </div>
                         
                        <ul class="CouponSaving">
                            <li>
                            	 <a href="javascript:void(0)" style="color:#1B1B1B;" onclick="tabs.open('view2');"><span class="InputPrice" id="discount">_ _ _</span></a>
                            	savings
                            </li>
                            <li>
                            	<a href="javascript:void(0)" style="color:#1B1B1B;" onclick="tabs.open('view4');"><span class="InputPrice" id="total_coupons">_ _ _</span></a>
                           	 	purchased
                            </li>
                            <li>
                            	<a href="javascript:void(0)" style="color:#1B1B1B;" onclick="tabs.open('view4');"><span class="InputPrice" > _ _ _</span></a>
                            	remaining
                            </li>
                       </ul>   
                         
                  </div>  
                        <!--red box started-->
                        
                                 <div class="RedBoxContents">
                                    <a href="javascript:void(0)" style="color:#ffffff;" onclick="tabs.open('view2');"> <span class="CouponPrice">$<span class="RedInputPrice" id="charity">_ _ _</span></span></a>
                                     <p class="CouponDetail">from every coupon will be donated to</p>
                                    <a href="javascript:void(0)" style="color:#1B1B1B;" onclick="tabs.open('view5');"> <h3 class="CouponTitleEntry" id="charity_name">CHARITY GOES HERE</h3></a>
                                 </div>   
            
                        <!--red box ended-->
                     
                     <div class="DealBoxMid">   
                        <a href="javascript:void(-1)" class="BuyButton" onclick="submit_form()" >
                        <img src="images/form_btn.png" alt="Submit" id="submit" style="cursor:default;opacity:0.5" />
                        </a>
                    </div>
                    
                    <div class="DealBoxBottom"></div>
                </div>
                <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'product-form',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
				));?>
               
                <div class="CreateDeal">
                <?php if($form->errorSummary($model) != '')
				{?>
                <div class="errors">
                <a class="close" href="javascript:void(-1)" onclick="closeErrors()">close</a>
                <?php $model->addError('picture' ,'Upload Image again');
			          echo $form->errorSummary($model);?>
                </div>
				<?php  }?>
					 
					 
                	<div class="TopImage"></div>

                    <div class="MiddleImage">
                        <div class="TabStyle">
                          <ul class="tabs" persist="true">
                            <li><a href="javascript:void(0)" rel="view1"><span class="Numbering">1.</span> <span class="TabsText">your offer &amp; fine print</span></a></li>
                            <li><a href="javascript:void(0)" rel="view2"><span class="Numbering">2.</span> <span class="TabsText" style="padding:6px 6px 6px 12px;">pricing </span></a></li>
                            <li><a href="javascript:void(0)" rel="view3"><span class="Numbering">3.</span> <span class="TabsText">upload image</span></a></li>
                            <li><a href="javascript:void(0)" rel="view4"><span class="Numbering">4.</span> <span class="TabsText">coupons &amp; dates</span></a></li>
                            <li><a href="javascript:void(0)" rel="view5"><span class="Numbering">5.</span> <span class="TabsText">choose a charity</span></a></li>
                          </ul>
                          <div class="tabcontents">
                            <div id="view1" class="tabcontent Tabbed_Menu_Conatiner">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="YourOffer">
                                  <tr>
                                    <td align="center" valign="top">
                                    	<h4>1. Your Offer goes here</h4>
                                        <span class="hint"> Max 140 characters (<div id="charNum">140</div>)</span>
                                		 <?php 
echo $form->textArea($model,'description',array('maxlength'=>140, 'class'=>'TextareaStyle', 'id'=>'title', 'onchange' => 'setText(this, "name")'));
echo $form->hiddenField($model, 'name', array('value' => $user->storeName)); ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top">
                                    	<h4>2. Fine Print or Restrictions</h4>
                                        <span class="hint"> Max 500 characters (<div id="charNum2">500</div>)</span>
                                		 
                                		<?php 
echo $form->textArea($model,'fine_print',array('maxlength'=>500, 'class'=>"TextareaStyle", 'id'=>'fine_print', 'onchange' => 'setText(this, "fine_print")')); ?>
                                    </td>
                                  </tr>
                                 
                                 <tr><td align="center"><a href="javascript:void(0)" onclick="tabs.open('view2');"><span class="btn_next" style="margin-top:12px !important; margin-right:-85px !important;">Next &raquo;</span></a></td></tr>
                                  
                                </table>                
                            </div>
                            <div id="view2" class="tabcontent Tabbed_Menu_Conatiner">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Pricing">
                                  <tr>
                                    <td align="center" valign="top">
                                    	<ul class="PriceEntry">
                                        	<li>
                                                 Original Price<br />
                                                1. 
                                                <?php echo $form->textField($model,'regular_price',array('maxlength'=>10,'class'=>'TxtField','id'=>'regular_price', 'onchange' => 'setText(this, "price")')); ?>
                                            </li>
                                            <li>
                                                 Discount %<br />
                                             2. 
                                             <?php echo $form->textField($model, 'price', array('maxlength'=>10,'class'=>'TxtField','id'=>'discountf', 'onchange' => 'setText(this, "discount")'));
											 
											// echo $form->hiddenField($model,'price',array('id'=>'discountprice')); ?>
                                            </li>
                                            <li>
                                                 Charity Gets<br />
                                                3. 
                                                
                                                <?php echo $form->textField($model,'amount_share',array('maxlength'=>10,'class'=>'TxtField','id'=>'amount_share', 'onchange' => 'setText(this, "charity")')); ?>
                                                 
                                            </li>
                                        </ul>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="right" valign="top" style="padding-right:105px;">
                                    <span class="hint"> Minimum $10</span>
                                    
                                    <div style="display:block; height:152px;"></div>
                                    </td>
                                  </tr>
                                  <tr><td align="center"><a href="javascript:void(0)" onclick="tabs.open('view1');"><span class="btn_back">&laquo; Back</span></a><a href="javascript:void(0)" onclick="tabs.open('view3');"><span class="btn_next">Next &raquo;</span></a></td></tr>
                                </table>
                            </div>
                            <div id="view3" class="tabcontent Tabbed_Menu_Conatiner">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ImageUpload">
                                  <tr>
                                    <td align="center" valign="top">
                                    <?php 
echo $form->fileField($model,'picture',array('class'=>"file",'id'=>"picture", 'name' => 'picture', 'onchange' => 'readURL(this);')); ?>

<div style="height:186px; display:block;"></div>
                                    </td>
                                  </tr>
                                  <tr><td align="center"><a href="javascript:void(0)" onclick="tabs.open('view2');"><span class="btn_back">&laquo; Back</span></a><a href="javascript:void(0)" onclick="tabs.open('view4');"><span class="btn_next">Next &raquo;</span></a></td></tr>
                                </table>
                            </div>
                            <div id="view4" class="tabcontent Tabbed_Menu_Conatiner">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="CouponsDates">
                                  <tr>
                                    <td align="center" valign="top">
                                    	<ul class="PriceEntry">
                                        	<li style="display:block; margin-bottom:10px;">
                                                 Number<br /> of Coupons<br />
                                                <!--<input type="text" value="" class="TxtField" id="coupons" onchange="setText(this, 'total_coupons')">-->
                                                <?php echo $form->textField($model,'coupons',array('maxlength'=>10,'class'=>'TxtField','id'=>'coupons')); ?>
                                            </li>
                                            <li>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(10)">10</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(50)">50</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(100)">100</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(500)">500</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(1000)">1000</a>
                                            </li>
                                            <li>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(1500)">1500</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(2000)">2000</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(2500)">2500</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(3000)">3000</a>
                                                 <a href="javascript:void(-1)" onclick="fillCoupons(5000)">5000</a>
                                            </li>
                                        </ul>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top">
                                    	<ul class="PriceEntry">
                                        	<li>
                                                 <span class="SubTitle">Redeeming Dates</span>
                                               <!-- <input type="text" value="mm/dd/yy" class="TxtFieldSmall" id="Text12">-->
                                                <?php
													$this->widget('zii.widgets.jui.CJuiDatePicker', array(
														'id'=>'redemingDateStart',
													'attribute'=>'redeming_date_start',
														'model'=>$model,
													'options'=>array(
															'showAnim'=>'fold',
															'dateFormat'=>'mm/dd/yy',
															 'minDate'=>'new Date("y:m:d")',
														),
														'htmlOptions'=>array(
															'onchange'=>'javascript:updateProductDate("frm", "redemingDateStart" ,this.value, "redemingDateEnd");',
															'class'=>"TxtFieldSmall",
															'onfocus'=>'if(this.value=="mm/dd/yy")this.value="";',
															'onblur'=>'if(this.value=="")this.value="mm/dd/yy";',
														),
													));
													?>
													
                                                to
                                               <!-- <input type="text" value="mm/dd/yy" class="TxtFieldSmall" id="Text12">-->
                                                <?php
												$this->widget('zii.widgets.jui.CJuiDatePicker', array(
													'id'=>'redemingDateEnd',
												'attribute'=>'redeming_date_end',
													'model'=>$model,
													'options'=>array(
														'showAnim'=>'fold',
														'dateFormat'=>'mm/dd/yy',
														 'minDate'=>'new Date("y:m:d", strtotime("+1 days"))',
													),
													'htmlOptions'=>array(
														'onchange'=>'javascript:updateProductDate("to", "redemingDateEnd", this.value, "redemingDateStart");',
														'class'=>"TxtFieldSmall",
														'onfocus'=>'if(this.value=="mm/dd/yy")this.value="";',
														'onblur'=>'if(this.value=="")this.value="mm/dd/yy";',
													),
												));
												?>
												
                                            </li>
                                        </ul>
                                    </td>
                                  </tr>
                                  <tr><td align="center"><a href="javascript:void(0)" onclick="tabs.open('view3');"><span class="btn_back" >&laquo; Back</span></a><a href="javascript:void(0)" onclick="tabs.open('view5');"><span class="btn_next" >Next &raquo;</span></a></td></tr>
                                </table>
                            </div>
                            <div id="view5" class="tabcontent Tabbed_Menu_Conatiner">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ChooseCharity">
                                 
                                  <tr>
                                    <td align="center" valign="top">
                                    	<!--<div class="main">
                                            <div class="CaraBG">
                                                <div class="gallery" style="overflow:scroll !important; o">
                                                    <ul>
                                                    <?php /* $charities = Charities::model()->findAll('type="Partner" ');
													if(count($charities))foreach($charities as $charity){ ?>
                                                        <li style="height:115px">
                                                        <a href="#" onclick="setCharity(<?php echo $charity->ein?>, '<?php echo $charity->name?>')">
                                                        <img src="<?php echo $charity->logo?>" style="height:100px; width:100px; cursor:pointer;" alt="<?php echo $charity->name?>" title="<?php echo $charity->name?>" />
                                                        </a>
                                                        </li>
                                                        <?php } */?>
                                                       
                                                    </ul>
                                                </div>
                                              </div>
                                          
                                        </div>-->
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="TopSpacer" align="center" valign="middle">
                                    <!--<img src="images/slider/Divider_Left.png" alt="" height="2" width="213" /> <h3>OR</h3> <img src="images/slider/Divider_Right.png" alt="" height="2" width="213" />-->
                                    <div class="main">
                                    <a href="javascript:void(0)" onclick="showSearch();"><span class="btn_back" style="margin-left:120px; margin-top:100px" > PARTNER <br /> CHARITIES</span></a>
                                    <span class="btn_or"> or </span>
                                    
                                    <a href="javascript:void(0)" onclick="setCharity2(this);"><span class="btn_next" style="margin-right:120px; margin-top:100px;" > LET THE BUYER<br />CHOOSE THEIR OWN</span></a>
                                    </div>
                                    </td>
                                  </tr>
                                  <tr>
                                  <!--onclick="showSearch()"-->
                                    <td align="left" valign="top" height="146px"  >
                                   <div id="mycharitylogo"   style=" margin-left:119px; text-align:center; width:100px; height:100px;"></div>
									    <h3 id="mycharity" style="margin-top:20px; width:340px; text-align:center;" ></h3>
                                    </td>
                                  </tr>
                                  <tr><td align="center"><a href="javascript:void(0)" onclick="tabs.open('view4');"><span class="btn_back" >&laquo; Back</span></a></td></tr>                                   
                                </table>
                                 
                            </div>
                          </div>
                          
                           
                        </div>  
                    </div>
                    <div class="BottomImage"></div>
                </div>
                 <input name="ein" id="ein" type="hidden" value="<?php if($_POST){echo $_POST['ein'];} else {echo $model->ein;}?>" />
                 <input type="hidden" value="1" id="Product_agree" name="Product[agree]">
                  <input type="hidden" value="<?php if($_POST){echo $_POST['ein'];} else {echo $model->ein;}?>" id="oName" name="Product[oName]">
                <?php $this->endWidget(); ?>
                
            </div>
            <!--Home Page Ends Here-->
             </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            <input type="hidden" name="pimage" id="pimage" />
            <script type="text/javascript">
			function showSearch()
			{
				
				$("#fancybox-wrap2").show();
				
			}
			function closeBox()
			{
				
				$("#fancybox-wrap2").hide();
				
			}
			function setValue(ein, name)
			{
				$("#orgName").val(name);
				 jQuery("#charity_name").html(name);
				$("#ein").val(ein);
				closeBox();
			} 
			
			</script>
            <div id="fancybox-wrap2" style="height: auto; top: 195px; display: none; position:absolute; margin-left:172px; z-index:100">
             <div class="CreateDeal">
                	<div class="TopImage"></div>

                    <div class="MiddleImage">
                    <div style="float:left; margin-left:10px; margin-top:-7px"><a href="javascript:void(-1)" onclick="closeBox()"><img src="<?php echo Yii::app()->baseUrl?>/images/fancy_close.png" /></a></div>
            
<?php echo $this->renderPartial('charities_popup');?>
</div> <div class="BottomImage"></div>
</div>


</div>