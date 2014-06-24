<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html  xmlns="http://www.w3.org/1999/xhtml" xmlns:addthis="http://www.addthis.com/help/api-spec" xmlns:fb="http://ogp.me/ns/fb#">



<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />
<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylenew.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/new_layout.css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/charity.css" />
<?php Yii::app()->clientScript->registerCoreScript('jquery')?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/_script.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.79639.js"></script>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<!--<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fc69c3a0c6f109a"></script>-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form-2.4.0.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqeasy.dropdown.min.js"></script>

<title> <?php echo CHtml::encode($this->pageTitle); ?></title>
 

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<style type="text/css">

a.btnsignin, a.btnsignout {
	padding:5px 8px;
	color:#fff;
	text-decoration:none;
	font-weight:bold;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:4px;
}
a.btnsignin:hover, a.btnsignout:hover {
}
a.btnsigninon {
	outline:none;
}
#frmsignin {
	display:none;
	background-color:#ccc;
	position:absolute;
	top: 42px;
	width:215px;
	padding:12px;
	*margin-top: 5px;
	font-size:11px;
	-moz-border-radius:5px;
	-moz-border-radius-topleft:0;
	-webkit-border-radius:5px;
	-webkit-border-top-left-radius:0;
	border-radius:5px;
	border-top-left-radius:0;
	z-index:100;
}
#frmsignin input[type=text], #frmsignin input[type=text] {
	display:block;
	border:1px solid #666;
	margin:0 0 5px;
	padding:5px;
	width:203px;
}
#frmsignin p {
	margin:0;
}
#frmsignin label {
	font-weight:bold;
	font-size:13px;
	color:#000000;
}
#submitbtn {
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	background-color:#CE2A20;
	border:1px solid #861107;
	color:#fff;
	padding:5px 8px;
	margin:0 5px 0 0;
	font-weight:bold;
}
#submitbtn:hover, #submitbtn:focus {
	border:1px solid #861107;
	cursor:pointer;
}
.submit {
	padding-top:5px;
}
#msg {
	color:#F00;
}
#msg img {
	margin-bottom:-3px;
}
#msg p {
	margin:5px 0;
}
#msg p:last-child {
	margin-bottom:0px;
}
.tagline
{
float:left; margin-left:300px; margin-top:-61px; font-size:18px; color:#be1027; text-transform:uppercase;font-family:Helvetica
}
</style>


</head>

<body>
<!--Navigation Started-->
<div id="Navigation">
    
<div class="NavNewsletter">
    <ul class="Menu">
    	<li class="GetNewsLetter2">
		<!-- 
        <div id="signbtn">
        	<!a href="" class="btnsignin">Get Our Newsletter</a>
    </div>
    <div id="frmsignin">
     <p id="msg"></p>
     <p></p>
        <form method="post" id="signin" action="<?php echo CController::createUrl('/site/newsletter'); ?>">
        <p id="puser">
        <label for="username">Name</label><br />
        <input id="name1" name="name" value="" title="name1" tabindex="1" type="text" />
        </p>
        <p>
        <label for="password">Email</label><br />
        <input id="email1" name="email" value="" title="email1" tabindex="2" type="text" />
        </p>
        <p class="submit">
        <input id="submitbtn" value="SUBMIT" tabindex="3" type="button" onclick="submit_newsletter()" />
        
        </p>
        </form>
       
    </div>-->
       <!-- a href="<?php echo CController::createUrl('/site/newsLetter'); ?>">Get Our Newsletter</a -->
       </li>
    </ul>
</div>

<div class="NavMenu">
    <div class="CenterAlign">
        <div class="HundredPercent">
            <ul class="Menu">
				<?php
                $seller = 0;
                if(!Yii::app()->user->isGuest)
                {
                    $store = UserStore::model()->findAll('user_id='.Yii::app()->user->id.' AND is_verified=1');
                    if(count($store) > 0)
                    $seller = 1;
                }

                if(Yii::app()->user->isGuest && !$seller) {?>
                    <li><a href="<?php echo CController::createUrl('user/signupBuyer&fbox=1'); ?>">+Sign Up</a></li>
                <?php }

                if(Yii::app()->user->isGuest || !$seller) {?>
                    <li><a href="<?php echo CController::createUrl('/userStore/launch'); ?>">+Business Sign Up</a></li>
                <?php }?>

				<?php
				if(!Yii::app()->user->isGuest)
                {
					$store = UserStore::model()->findAll('user_id='.Yii::app()->user->id.' AND is_verified=1');
					if(count($store) > 0)
					{
				 ?>
                <li><a href="<?php echo CController::createUrl('/product/create'); ?>">Create a Deal</a></li>
				<?php 
					}
				}
				 ?>
                <?php //}?>
		<li><a href="<?php echo CController::createUrl('/charities/create'); ?>">+Charity Sign Up</a></li>
                <li><a href="/">How It Works</a></li>
                <!--            <li><a href="< ?php echo CController::createUrl('/site/mission'); ?>">Our Mission</a></li>
                -->             <li><a href="<?php echo CController::createUrl('/site/press'); ?>">Press</a></li>
                <!--li><a href="http://blog.karm.io" target="_blank">Blog</a></li-->
                <!--li><a href="<?php echo CController::createUrl('/site/favCharities'); ?>">Partner Charities</a></li-->
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
                
                
                <div class=" <?php if(Yii::app()->user->getState('isAdmin') || Yii::app()->user->isGuest)echo 'login-form'; else echo 'login-form2';?>">
                
                
                <?php if(!Yii::app()->user->isGuest) {
                if(!isset(Yii::app()->user->isAdmin)){	
                ?>
                <div class="rowlogin2">
                <div class="regis"><a href="<?php echo CHtml::normalizeUrl(array('/user/buyersDashboard')); ?>" style="border:none">Buyer Dashboard</a></div>
                </div>
                <div class="rowlogin2">
                <div class="regis"><a href="<?php echo CHtml::normalizeUrl(array('/seller')); ?>" style="border:none">Seller Dashboard</a></div>
                </div>
                <?php }else{?>
                <div class="rowlogin2">
                <div class="regis"><a href="<?php echo Yii::app()->user->myDash; ?>" style="border:none">My Dashboard</a></div>
                </div>
                <?php }
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
                
            </ul>
        </div>
    </div>
</div>

<div class="NavAboutUs">
    <ul class="Menu">
    	<!--li class="AboutUs2"><a href="<?php echo CController::createUrl('/site/about'); ?>">About Us</a></li-->
    </ul>
</div>
        
</div>
      
   

<!--Navigation Ends Here-->
<!--Header Started-->
<div id="Header" style="width:70%">
<div class="CenterAlign">
<div class="HundredPercent">

<div id="CompanyLogo">
<a href="<?php echo Yii::app()->getBaseUrl(true)?>"><img src="images/CompanyLogo.png" alt="logo"/></a>
</div>
 <div class="tagline">
        Connecting local commerce to global causes
        </div>

</div>
</div>
</div>
<!--Header Ends Here-->
 <?php echo $content; ?>

<!--Footer Started-->
<div id="Footer">

<!--   <div class="BtmNavMenu">-->
      <div class="CenterAlign">
        <div class="HundredPercent">


            <ul class="BtmMenu">
            <li><a href="<?php echo CController::createUrl('/site/privacypolicy'); ?>">Privacy Policy</a></li>
            <li><a href="<?php echo CController::createUrl('/site/privacypolicy'); ?>">Refund Policy</a></li>
            <li><a href="<?php echo CController::createUrl('/site/terms'); ?>">Terms of service</a></li>
            <!--li><a href="<?php echo CController::createUrl('/site/faq'); ?>">FAaQ</a></li-->
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
		 
     /* jQuery('#login').click(function() {
	  		jQuery(".login-form2").slideToggle();
			jQuery(".login-form").slideToggle();
            
      });*/
	 jQuery('#login, .login-form2, .login-form').hover(function() {
		jQuery('.login-form2').show();
		jQuery('.login-form').show();
		},
	function() {
		jQuery('.login-form2').hide();
		jQuery('.login-form').hide();
		});
	 
		
	});
	function submit_newsletter()
	{
		
		var name = $("#name1").val();
		var email = $("#email1").val();
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    
		if(name != '' && email != '' && testEmail.test(email))
		{
			//$("#signin").hide();
		 $.ajax({
            type: 'POST',
            url: 'index.php?r=site/newsLetter',
            data: 'name=' + name+'&email='+email,
            success: function(output)
            {
                $("#msg").html(output);
                   
            }
        });
		}
		else
		{
			$("#msg").html('Please fill missing fields with correct values');
		}
	}
</script>
