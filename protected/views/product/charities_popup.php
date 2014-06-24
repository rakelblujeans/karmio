<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/temp.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tip-transparency.css" />
<div class="main" style="width:860px">
<h1 class="ARegTxt" style="color:#BE1027; padding:15px;">Partner Charities</h1>
<span style="padding:0 0 15px 15px; ">Click on logo to select Partner Charity for your Deal<br /><br /></span>
					            <ul class="PartnerCharities">
                                                    <?php  $charities = Charities::model()->findAll('type="Partner" ');
													//echo 'ccount='.count($charities);
													if(count($charities))foreach($charities as $charity){ ?>
                                                    <li class="tip"><a href="#" onclick="setCharity(<?php echo $charity->ein?>, '<?php echo $charity->name?>', '<?php echo $charity->logo; ?>')"> 
                                                    <img class="cover" height="100" width="100" src="<?php echo $charity->logo?>" alt="<?php echo $charity->name?>" title="<?php echo $charity->name?>" /></a><strong class="tooltipB">
                                                    <h3><?php echo $charity->name ?></h3> <p><?php echo $charity->tag_line ?><br/>
                                                    <a href="#" onclick="setCharity(<?php echo $charity->ein?>, '<?php echo $charity->name?>')">Select Charity&raquo;</a></p></strong></li>
                                                    
                                                        
                                                        <?php } ?>
                                                       
                                                    </ul>
                                               
                                          
                                        </div>