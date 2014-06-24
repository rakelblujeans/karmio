<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabcontent.js"></script>

 

 	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jcarouse.js"></script>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/temp.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tip-transparency.css" />


	
        
        <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Horizontal Sliding
				jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)');
				
				
				
			});
		</script>

<div id="MainBody">

            <div class="CenterAlign">

            <div class="HundredPercent">

             <div id="HomePage">

             <div class="CreateDeal">

 <div class="bg-top" ></div>

                       <div class="bg-mid" >

		<h1 class="ARegTxt" style="color:#BE1027; padding:15px;">Partner Charities</h1>

		  <!--  <div class="CharityPartners"  style="width:888px; float:right">-->
            
            <ul class="PartnerCharities">

            <?php if(count($charities))

			foreach($charities as $charity){?>

		        
                    
					<li class="tip"><a href="http://<?php echo $charity->url ?>" target="_blank"> <img class="cover" height="100" width="100" src="<?php echo $charity->logo?>" /></a><strong class="tooltipB"><h3><?php echo $charity->name ?></h3> <p><?php echo $charity->tag_line ?><br/><a href="http://<?php echo $charity->url ?>" target="_BLANK">View Charity&raquo;</a></p></strong></li>
                    
                   
		      

                <?php }?>
  </ul>
		      

             

		        

		   <!-- </div>-->

		 </div>

                     <div class="bg-bottom" ></div>

                    </div>

		</div>

        <div class="clear"></di>

        </div>

        </div>

        </div>

        </div>