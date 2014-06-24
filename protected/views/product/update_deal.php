<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabcontent.js"></script>
 
 	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jcarouse.js"></script>
       <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.boxfit.js"></script>
	<script type="text/javascript">
		jQuery(function(){
			jQuery(".gallery").jCarouselLite({
			btnNext: ".next",
			btnPrev: ".prev"
			});
		});
		jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)');
		
		 $(".cheading").boxfit({multiline: true});
		
		});
		
		function setText(obj, id)
		{
			
			var val = obj.value;
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
				if(jQuery("#amount_share").val() != '' && parseInt(jQuery("#amount_share").val()) > disc)
				{
					jQuery("#amount_share").val('');
					alert(' Charity amount can not be greater than price');
				}  
				if(id == 'price')
					val = disc;
				else
				{
					jQuery("#price").html(disc);
					val = obj.value+' %';
				}
				}
			}
			jQuery("#"+id).html(val);
			
		}
		
		
		function fillCoupons(count){
			jQuery("#coupons").val(count);
			jQuery("#total_coupons").text(count);
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
	  function setCharity(ein, oName)
	  {
		  jQuery("#ein").val(ein);
		  jQuery("#charity_name").html(oName);
		  jQuery("#oName").val(oName);
		  
	  }
	  function submit_form()
	  {
		   jQuery("#product-form").submit();
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
                            <div class="cheading"><?php $store = $model->getStoreInfo(); echo $store->name?></div>
                            <a href="#" class="FinePrint">Location</a>
                            
                            <p class="InputPrice" id="name">
                            <?php echo $model->name?>
                            
                            <a href="#" class="FinePrint">FinePrint</a>
                         </div>
                         
                         
                         <div class="CouponTotalPrice">
                            $ <span class="InputPrice" id="price"><?php $disc = round(($model->price*$model->regular_price)/100);
								echo round($model->regular_price-$disc);?></span>
                            <span class="CouponDetailPrice">pledge included</span>
                         </div>
                         
                        <ul class="CouponSaving">
                            <li>
                            	<span class="InputPrice" id="discount"> <?php echo round($model->price)?>%</span>
                            	savings
                            </li>
                            <li>
                            	<span class="InputPrice" id="total_coupons"> <?php 
											$sold_coupons = UserPurchase::model()->findAll('product_id='.$model->id);
											echo count($sold_coupons); ?></span>
                           	 	purchased
                            </li>
                            <li>
                            	<span class="InputPrice" >  <?php echo substr($model->remainingTime(),0,3); ?></span>
                            	remaining
                            </li>
                       </ul>   
                         
                  </div>  
                        <!--red box started-->
                        
                                 <div class="RedBoxContents">
                                     <span class="CouponPrice">$ <span class="RedInputPrice" id="charity"><?php echo round($model->amount_share)?></span></span>
                                     <p class="CouponDetail">from every coupon will be donated to</p>
                                     <h3 class="CouponTitleEntry" id="charity_name"> <?php echo $model->charity->name?></h3>
                                 </div>   
            
                        <!--red box ended-->
                     
                     <div class="DealBoxMid">   
                        <a href="#" class="BuyButton" onclick="submit_form()"><img src="images/form_btn.png" alt="Submit" /></a>
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
                <?php //$model->addError('picture' ,'Upload Image again');
			          echo $form->errorSummary($model);?>
                </div>
				<?php  }?>
					 
                	<div class="TopImage"></div>

                    <div class="MiddleImage">
                        <div class="TabStyle">
                          <ul class="tabs" persist="true">
                            <li><a href="#" rel="view1"><span class="Numbering">1.</span> <span class="TabsText">your offer fine print</span></a></li>
                            <li style="margin-top:10px;"><a href="#" rel="view2"><span>2.</span> <span>pricing</span></a></li>
                            <li><a href="#" rel="view3"><span class="Numbering">3.</span> <span class="TabsText">upload image</span></a></li>
                            <li><a href="#" rel="view4"><span class="Numbering">4.</span> <span class="TabsText">coupons &amp; dates</span></a></li>
                            <li><a href="#" rel="view5"><span class="Numbering">5.</span> <span class="TabsText">choose a charity</span></a></li>
                          </ul>
                          <div class="tabcontents">
                            <div id="view1" class="tabcontent Tabbed_Menu_Conatiner">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="YourOffer">
                                  <tr>
                                    <td align="center" valign="top">
                                    	<h4>1. Your Offer goes here</h4>
                                        <span class="hint"> Max 140 characters</span>
                                		 <?php 
echo $form->textArea($model,'description',array('maxlength'=>140, 'class'=>'TextareaStyle', 'id'=>'title', 'onchange' => 'setText(this, "name")'));
echo $form->hiddenField($model, 'name', array('value' => $user->storeName)); ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top">
                                    	<h4>2. Fine Print or Restrictions</h4>
                                        <span class="hint"> Max 500 characters</span>
                                		 
                                		<?php 
echo $form->textArea($model,'fine_print',array('maxlength'=>500, 'class'=>"TextareaStyle", 'id'=>'fine_print', 'onchange' => 'setText(this, "fine_print")')); ?>
                                    </td>
                                  </tr>
                                  
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
                                             <?php echo $form->textField($model,'price',array('maxlength'=>10,'class'=>'TxtField','id'=>'discountf', 'onchange' => 'setText(this, "discount")')); ?>
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
                                    <p></p>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                            <div id="view3" class="tabcontent Tabbed_Menu_Conatiner">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ImageUpload">
                                  <tr>
                                    <td align="center" valign="top">
                                    <?php 
echo $form->fileField($model,'picture',array('class'=>"file",'id'=>"picture", 'name' => 'picture', 'onchange' => 'readURL(this);')); ?>
                                    </td>
                                  </tr>
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
                                </table>
                            </div>
                            <div id="view5" class="tabcontent Tabbed_Menu_Conatiner">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ChooseCharity">
                                  <tr>
                                    <td align="center" valign="top"><h3>Choose one of our partner charities or let the buyer choose their own</h3></td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top">
                                    	<div class="main">
                                            <button class="prev"></button>
                                              <div class="CaraBG">
                                                <div class="gallery">
                                                    <ul>
                                                    <?php $charities = Charities::model()->findAll('type="Partner" ');
													//echo count($charities);
													if(count($charities))foreach($charities as $charity){ ?>
                                                        <li>
                                                        <img onclick="setCharity(<?php echo $charity->ein?>, '<?php echo $charity->name?>')" style=" cursor:pointer;" src="<?php echo $charity->logo?>" height="126" width="144" alt="<?php echo $charity->name?>"  />
                                                        </li>
                                                        <?php }?>
                                                       
                                                    </ul>
                                                </div>
                                              </div>
                                            <button class="next"></button>
                                        </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="TopSpacer" align="center" valign="top"><img src="images/slider/Divider_Left.png" alt="" height="2" width="213" /> <h3>OR</h3> <img src="images/slider/Divider_Right.png" alt="" height="2" width="213" /></td>
                                  </tr>
                                  <tr>
                                  <!--onclick="showSearch()"-->
                                    <td align="center" valign="top"><a class="RedButton TopSpacer" href="#" onclick="setCharity('', 'Buyer will choose charity')">Let the buyer choose their own</a></td>
                                  </tr>
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
            