<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html  xmlns="http://www.w3.org/1999/xhtml" xmlns:addthis="http://www.addthis.com/help/api-spec" xmlns:fb="http://ogp.me/ns/fb#">



<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta property="og:image" content="http://www.karm.io/design/images/logo.jpg" /> 


 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />
<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylenew.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/new_layout.css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
<?php Yii::app()->clientScript->registerCoreScript('jquery')?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/_script.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.79639.js"></script>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<!--<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fc69c3a0c6f109a"></script>-->


<title> <?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
</head>

<body>
<!--Navigation Started-->
<div id="Navigation">
    <div class="NavMenu">
      <div class="CenterAlign">
        <div class="HundredPercent">
        
          <ul class="Menu">
            <li class="GetNewsLetter2"><a href="#">Get Our Newsletter</a></li>
            <span class="MiddleNavSec">
            <span class="MiddleNavRight">
            <?php //if(Yii::app()->user->isGuest){?>
            <li><a href="<?php echo CController::createUrl('/userStore/launch'); ?>">+Business Sign Up</a></li>
            <?php //}else{?>
           <li><a href="<?php echo CController::createUrl('/product/create'); ?>">Create a Deal</a></li>
            <?php //}?>
             <li><a href="<?php echo CController::createUrl('/site/how_it_works'); ?>">How It Works</a></li>
            <li><a href="<?php echo CController::createUrl('/site/mission'); ?>">Our Mission</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="<?php echo CController::createUrl('/site/favCharities'); ?>">Partner Charities</a></li>
            <?php if(Yii::app()->user->isGuest){?>
            <li><a href="<?php echo CController::createUrl('/site/login'); ?>">Login</a></li>
            <?php }else{?>
            <li><?php 
			if(!isset(Yii::app()->user->isAdmin))
				{ 
				echo "<a id='login'><div class='headname'>".ucwords(Yii::app()->user->myName)."</div></a>";
			    }
			  else
			  {echo "<a id='login'>Administrator</a>";}
		  ?></li>
            <!-- <li><a href="<?php //echo CController::createUrl('/site/logout'); ?>">Logout</a></li>-->
             <?php }?>
             </span>
             </span>
             <li class="AboutUs2"><a href="<?php echo CController::createUrl('/site/about'); ?>">About Us</a></li>
            </ul>
        
       
				<div class=" <?php if(Yii::app()->user->getState('isAdmin') || Yii::app()->user->isGuest)echo 'login-form'; else echo 'login-form2';?>">
				

		<?php if(!Yii::app()->user->isGuest) {?>
		<div class="rowlogin2"><div class="regis">
		<a href="<?php echo Yii::app()->user->myDash; ?>" style="border:none">My Dashboard</a></div></div>
		<?php
				if(!isset(Yii::app()->user->isAdmin))
				{ ?>
				<div class="rowlogin2"><div class="regis">
		<?php echo CHtml::link('My Profile', Yii::app()->controller->createAbsoluteUrl('user/view', array('id' =>Yii::app()->user->id),'http')); ?>
		</div></div>
		
		<div class="rowlogin2">
        <div class="regis">

				<?php echo CHtml::link('Update Password', Yii::app()->controller->createAbsoluteUrl('user/updatePassword', array('id' =>Yii::app()->user->id),'http')); ?>

		</div></div>
       
		<?php }?>
         
		<?php
		if(isset(Yii::app()->user->isSeller))
		{ ?>
		<div class="rowlogin2"><div class="regis"><a href="<?php echo CHtml::normalizeUrl(array('/seller/checkIn')); ?>" style="border:none">Check IN</a></div></div><br>
		<?php }?>
        <div class="rowlogin2"><div class="regis">
		<a href="<?php echo CHtml::normalizeUrl(array('/site/logout')); ?>" style="border:none">Logout</a></div></div>
		<?php } ?>

	</div>
    
        
       </div>
      </div>
    </div>
</div>
<!--Navigation Ends Here-->

 <?php echo $content; ?>

<!--Footer Started-->
<div id="Footer">
<!--   <div class="BtmNavMenu">-->
      <div class="CenterAlign">
        <div class="HundredPercent">
        
            <ul class="BtmMenu">
            <li><a href="<?php echo CController::createUrl('/site/privacypolicy'); ?>">Privacy</a></li>
            <li><a href="<?php echo CController::createUrl('/site/privacypolicy'); ?>">Refund Policy</a></li>
            <li><a href="<?php echo CController::createUrl('/site/terms'); ?>">Terms of service</a></li>
            <!--li><a href="<?php echo CController::createUrl('/site/faq'); ?>">FAQ</a></li-->
            <li><a href="<?php echo CController::createUrl('/site/contact'); ?>">Contact us</a></li>
            </ul>
       </div>
      </div> 
<!--    </div>-->
</div>
<!--Footer Ends Here-->





</body>
</html>
<script type="text/javascript">
    jQuery(document).ready(function() {
		jQuery(".login-form").hide();
		jQuery(".login-form2").hide();
		jQuery("#login-form").hide();
		jQuery("#login").click(function()
		{
			jQuery(".login-form2").slideToggle();
			jQuery(".login-form").slideToggle();
		});
	});
</script>
