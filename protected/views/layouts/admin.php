<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html  xmlns="http://www.w3.org/1999/xhtml" xmlns:addthis="http://www.addthis.com/help/api-spec" xmlns:fb="http://ogp.me/ns/fb#">







<head>

<meta charset="UTF-8">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta property="og:image" content="http://www.karm.io/design/images/logo.jpg" /> 







<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylenew.css" rel="stylesheet" />



<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" rel="stylesheet" />



<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/320787f/jquery.js"></script>



<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/_script.js"></script>

<style>

#postdealrow {

    color: #000000;

    float: left;

    font-family: Bookman Old Style,sans-serif;

    font-size: 14px;

    height: auto;

    margin: 10px;

    width: 850px;

}

</style>

<title> <?php echo CHtml::encode($this->pageTitle); ?></title>



<script>

var query = location.href.split('#');

document.cookies = 'anchor=' + query[1];

</script>

<script type="text/javascript">

    $(document).ready(function() {

  $('.close').click(function(){

window.location = 'http://www.karm.io/design/index.php';

});

  $(".login-form").hide();

$(".login-form2").hide();

   $("#login-form").hide();

  $("#login").click(function()

{

	$(".login-form2").slideToggle();

	$(".login-form").slideToggle();

});

	<?php

			if(isset($this->stickyLogin) && $this->stickyLogin == 1)

				{ 

					echo "stickyLogin();";

				}

			?>

			$('#mainSearch').blur(function(){

					$('#mainSearch').addClass('search-field-text');

					if($('#mainSearch').val() == '')

					{

						$('#mainSearch').val('city, zip code');

					}

				})

				.focus(function(){

					//alert('focus');

					$('#mainSearch').removeClass('search-field-text');

					if($('#mainSearch').val() == 'city, zip code')

					{

						$('#mainSearch').val('');

					}

				});

			$('#emlog').blur(function(){

					$('#emlog').addClass('black');

					if($('#mainSearch').val() == '')

					{

						$('#mainSearch').val('EMAIL');

					}



				})



				.focus(function(){

				$('#emlog').removeClass('black');

					if($('#emlog').val() == 'EMAIL')

					{

						$('#emlog').val('');

					}

				});

			$('#user-store-form').submit(function(){

				if($('#mainSearch').val() == 'city, zip code')

				{

					return false;

				}

			});

    });

</script>

 <?php

 //header("Access-Control-Allow-Origin: *");

 /*$directory =  dirname(Yii::app()->request->scriptFile).'/images/bkgs/';

 $images = glob("" . $directory . "*.jpg");

 $imgs = array();

 $count = 0;

// create array

foreach($images as $image)

{ 

	$arr = explode('/', $image);

	$a = $arr[count($arr)-1];

	$imgs[$count++] = "$a"; 

}

$images = glob("" . $directory . "*.jpeg");

foreach($images as $image)

{ 

	$arr = explode('/', $image);

	$a = $arr[count($arr)-1];

	$imgs[$count++] = "$a"; 

}

$images = glob("" . $directory . "*.png");

foreach($images as $image)

{ 

	$arr = explode('/', $image);

	$a = $arr[count($arr)-1];

	$imgs[$count++] = "$a"; 

}

$img = $imgs[rand(0, count($imgs)-1)];

if((Yii::app()->controller->id == 'userPurchase' && isset(Yii::app()->user->isAdmin))||(Yii::app()->controller->id == 'seller' && isset(Yii::app()->user->isAdmin))|| (Yii::app()->controller->id == 'administrator' && Yii::app()->controller->action->id == 'admin')|| (Yii::app()->controller->id == 'user' && Yii::app()->controller->action->id == 'admin')|| (Yii::app()->controller->id == 'userPurchase' && Yii::app()->controller->action->id == 'admin')|| (Yii::app()->controller->id == 'user' && Yii::app()->controller->action->id == 'buyersDashboard' && isset(Yii::app()->user->isAdmin))){}

else{*/

echo '<style>body{background:url('.Yii::app()->baseUrl.'/images/bkgs/bg_004.jpg) #000000  no-repeat center center fixed;-moz-background-size: cover;

-webkit-background-size: cover;

-o-background-size: cover;

background-size: cover;}</style>';

//}

 ?>

 <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

</head>

<body>

<div id="<?php if($this->pageTitle== 'karmio - Product')

 { echo 'container'; } 

 else { echo 'container2';}?>">

<!--<div class="stretch-image"></div>-->

<div id="inner-container">

<div id="<?php if($this->pageTitle== 'karmio - Product') { echo 'main-containerindex'; } else if($this->pageTitle== 'karmio - BuyNow Product' || $this->pageTitle== 'karmio - BuyComplete Product'){ echo 'main-containerdark';} else { echo 'main-container';}?>"> 



<?php

	$this->widget('application.extensions.fancybox.EFancyBox', array(

    	'target'=>'a#login-',

		'config'=>array(

							'enableEscapeButton'=> true,

							'showCloseButton'	=> true,

							'hideOnOverlayClick'=> true,

							'margin-left'			=> '800',

							'onComplete'			=> 'js:function(){

															updateWidthFancy();

														}'

						),

    	)

	);

	$this->widget('application.extensions.fancybox.EFancyBox', array(

    	'target'=>'a.fancysignup',

		'config'=>array(

							'enableEscapeButton'	=> true,

							'showCloseButton'		=> true,

							'hideOnOverlayClick'	=> false,

							'centerOnScroll'		=> true,

							'margin-top'			=> '5',

							'height'				=> '700',

							'onComplete'			=> 'js:function(){

							//$.fancybox.reposition();

															updateWidthFancy();

															//$.fancybox.reposition();

														}'

						),

    	)

	);



	$this->widget('application.extensions.fancybox.EFancyBox', array(

    	'target'=>'a#hiddenLogin',

		'config'=>array(

							'enableEscapeButton'=> false,

							'showCloseButton'	=> true,

	 						'hideOnOverlayClick'=> false,

		



							"width"=>"250",

							'onClosed'			=> 'js:function(){

														updStoreList("'.CHtml::normalizeUrl(array('/userStore/getStores')).'");

														return true;

													}',

							'onComplete'			=> 'js:function(){

														$("#fancybox-content").css({"width":"250px", "top":"50px", "height":"179px"});



														updateWidthFancy();



													}'



						),



    	)



	);

?>

<div id="header">

		<div class="header-logo"><a href="<?php echo Yii::app()->homeUrl; ?>"><img src="images/logo.png" border="0" /></a></div>

	<div class="header-nav">

	<div class="socailnetwk">

	<?php 

	if(!Yii::app()->user->isGuest){

		$products = Product::model()->findAll('user_id='.Yii::app()->user->id);

		if(count($products))

		{

			$ids_arr = array();

			$ids_str = '-1';

			foreach($products as $p)

			{

				$ids_arr[] = $p->id;

			}

			$ids_str = implode(',', $ids_arr);

			$coupons = UserPurchase::model()->findAll('product_id IN('.$ids_str.')');

		if(count($coupons)){

	?>

	<div class="fbc">

		<a href="<?php echo CHtml::normalizeUrl(array('/seller/checkIn')); ?>"><img src="images/CheckinButtonSmall.png" border="0"></a>

	</div>

	<?php }}}?>



<div class="addthis">

	<div class="addthis_toolbox addthis_default_style ">

		<a class="addthis_counter addthis_pill_style"></a>

	</div>

	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>

	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fc69c3a0c6f109a"></script>

</div> 

</div>



	<div class="topnav">



	<ul>



		<li>



		<span><?php



			if(Yii::app()->user->isGuest)

			{







				}



			else{



			if(!isset(Yii::app()->user->isAdmin))



				{ 



				echo "<a id='login'><div class='headname'>".'Hi ' .ucwords(Yii::app()->user->myName)."</div></a>";



			    }



			  else



			  {echo "Welcome, <a id='login'>Administrator</a>";}



		  }



		?></span>

	<div class="<?php if(Yii::app()->user->getState('isAdmin') || Yii::app()->user->isGuest){echo 'login-form'; } else{echo 'login-form2';}?>">

				



		<?php if(!Yii::app()->user->isGuest) {?>

		<div class="rowlogin2"><div class="regis">



		<a href="<?php echo Yii::app()->user->myDash; ?>" style="border:none">My Dashboard</a></div></div>

		<?php



				if(!isset(Yii::app()->user->isAdmin))



				{ ?>

				<div class="rowlogin2"><div class="regis">



				<?php echo CHtml::link('My Profile', Yii::app()->controller->createAbsoluteUrl('user/view', array('id' =>Yii::app()->user->id),'http')); ?>



		</div></div>

		<div class="rowlogin2"><div class="regis">



				<?php 

				if(!isset(Yii::app()->user->isAdmin))

					

				echo CHtml::link('Update Profile', Yii::app()->controller->createAbsoluteUrl('user/update', array('id' =>Yii::app()->user->id),'http'));

				else

				echo CHtml::link('Update Profile', Yii::app()->controller->createAbsoluteUrl('user/updateSeller', array('id' =>Yii::app()->user->id),'http')); ?>



		</div></div>

		<div class="rowlogin2"><div class="regis">



				<?php echo CHtml::link('Update Password', Yii::app()->controller->createAbsoluteUrl('user/updatePassword', array('id' =>Yii::app()->user->id),'http')); ?>



		</div></div>



			<?php 



				}?>



				



				<?php



				if(isset(Yii::app()->user->isSeller))



				{ //http://<?php echo $_SERVER['SERVER_NAME']; /beta/index.php?r=seller/checkIn?>



					<div class="rowlogin2"><div class="regis"><a href="<?php echo CHtml::normalizeUrl(array('/seller/checkIn')); ?>" style="border:none">Check IN</a></div></div><br>

				<?php 



				}?>



		



		<div class="rowlogin2"><div class="regis">



		<a href="<?php echo CHtml::normalizeUrl(array('/site/logout')); ?>" style="border:none">Logout</a></div></div>



		<?php } ?>







		</div>



		



		</li>


		<li><label><a href="<?php echo CController::createUrl('/userStore/signupSeller'); ?>"><span>+</span>SIGN UP BUSINESS</a></label></li>
		<!--li><label><a href="<?php echo CController::createUrl('/product/create'); ?>"><span>+</span>CREATE A DEAL</a></label></li-->

		<?php

			 $url = CController::createUrl('/userStore/create');

			 $store_id = '';

			 if(!Yii::app()->user->isGuest)

			 {

			 	$store_id  = $this->getStoreId(Yii::app()->user->id);

			  }

			?>

			

	



	</ul>



	<div class="footerlinks" style="margin:0px; margin-top:<?php echo (Yii::app()->user->isGuest)?'30px':'8px'?>; margin-left:20px; width:auto;">



		<div class="footersmall" style="width:auto; margin-right:10px"><a href="<?php echo CController::createUrl('/site/index'); ?>" style=" font-size:14px;"> HOW IT WORKS </a></div>

		<div class="footersmall" style="width:auto; margin-right:10px"><a href="<?php echo CController::createUrl('/site/about'); ?>" style=" font-size:14px;"> ABOUT US</a></div>

		<div class="footersmall" style="width:auto; margin-right:10px"><a href="<?php echo CController::createUrl('/site/favCharities'); ?>" style=" font-size:14px;"> FAVOURITE CHARITIES</a></div>

		<div class="footersmall" style="width:auto; margin-right:10px"><a href="<?php echo CController::createUrl('/site/mission'); ?>" style=" font-size:14px;"> OUR MISSION</a></div>

        <?php if(Yii::app()->user->isGuest){?>

       <div class="footersmall" style="width:auto; margin-right:10px"><a href="<?php echo CController::createUrl('/user/signupAcType'); ?>" style=" font-size:14px;" class="fancysignup"> SIGN UP</a></div>

       <div class="footersmall" style="width:auto; margin-right:10px"><a href="<?php echo CController::createUrl('/site/login'); ?>" style=" font-size:14px;"> LOGIN</a></div>

       <?php }?>

		



	</div>

	</div>



	<div class="bottomnav">



	

	</div>



	

	</div>



	



</div><!--header-->







 <br style="clear:both;" />



<div id="main-content">



 <?php echo $content; ?>



 



</div>



<?php if($this->pageTitle != 'karmio - BuyNow Product' ){ ?>



</div>



<?php }?>





<div id="<?php if($this->pageTitle== 'karmio - BuyNow Product'){ echo 'footerpay';} else {echo 'footer';} ?>" <?php if($this->action->id == 'favCharities'){echo 'style="margin-left:0px;"'; }?> >

<div class="footerlinks" style="width:685px;">

<div class="footersmall"><a href="<?php echo CController::createUrl('/site/about'); ?>">ABOUT US</a></div>

<div class="footersmall"><a href="<?php echo CController::createUrl('/site/mission'); ?>">OUR MISSION</a></div>

<div class="largesm"><a href="<?php echo CController::createUrl('/site/nonprofit'); ?>">ADD YOUR NON-PROFIT</a></div>

</div>





<div class="footerlinksrite" style="margin-right:146px;">

<div class="footersmall"><a href="<?php echo CController::createUrl('/site/faq'); ?>">FAQ</a></div>

<div class="large"><a href="<?php echo CController::createUrl('/site/terms'); ?>">TERMS AND CONDITIONS</a></div>

<div class="footersmall"><a href="<?php echo CController::createUrl('/site/privacypolicy'); ?>">PRIVACY POLICY</a></div>

<div class="footersmall"><a href="<?php echo CController::createUrl('/site/contact'); ?>">CONTACT US</a></div>

<!--<div class="footersmall"><a href="<?php echo CController::createUrl('/site/favCharities'); ?>">FAV CHARITIES</a></div>

--></div>

</div>

<?php //} ?>

<?php if($this->pageTitle == 'karmio - BuyNow Product'){ ?>

</div><!--main containerz-->

<?php }?>

</div>

</div>

</body>

</html>

