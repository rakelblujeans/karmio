<?php $this->pageTitle=Yii::app()->name; ?>


<style>
.HundredPercent{ font-family:Helvetica}
#HomePage{ padding:37px 0 0;}


.videodiv
{

min-height:200px; 


}
.browseDealText
{
top:300px; right:230px; position:absolute; color:#be1027; font-size:20px; text-transform:uppercase;
font-weight:bold;
}
.nav-arrows span.nav-arrow-next {right: 136px;}
.nav-arrows span { top:280px;}
.iframestyle
{
border-radius:15px;
moz-border-radius:15px;
webkit-border-radius:15px;
width:573px; height:321px;
}
#vvideo{ display:none; width:573px; height:321px;background:url(images/video_bg.png); }
#vtext{ background:url(images/video_bg.png); width:473px; height:271px; padding:25px 50px;}
#vheading{ color:#be1027; font-size:34px; font-weight:bold; margin-top:20px; text-align:left; padding:20px}
#play_link{color:#c62f43; font-size:24px; text-align:right}
#how{ position:relative;top:-44px;}
#bbtn{width: 420px;
height: 50px;
padding-bottom:4px;
font-weight: bold;
color: rgb(255, 255, 255);
border-radius:5px;
moz-border-radius:5px;
webkit-border-radius:5px;
cursor: pointer;
margin-top: 15px;
background:#be1027;
font-size:26px;
font-family:Helvetica;
}
</style>
<script type="text/javascript">
     jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
	 function play_video()
	 {
		
		 $("#vvideo").show();
		 $("#vvideo").html('<iframe class="" src="http://player.vimeo.com/video/73595640?autoplay=1" width="573" height="321" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><!-- <p><a href="http://vimeo.com/73595640?autoplay=1">Karm.io How it works!</a> from <a href="http://vimeo.com/user3597257">sibte</a> on <a href="https://vimeo.com">Vimeo</a>.</p>-->');
		  $("#vtext").hide();
	 }
</script>
<div id="MainBody">

 <div class="CenterAlign">
 
          <div class="HundredPercent" >

            
            <div id="HomePage">
            
            <!-- browse deals -->
                    <!--nav id="nav-arrows" class="nav-arrows">
					<div class="browseDealText">Browse<br /> deals</div>
					<a href="<?php echo CController::createUrl('product/index') ?>"><span class="nav-arrow-next">Next</span></a>
				</nav--></div>
                   <!-- end browse deals -->
                   
                   
                <!-- video div -->
            <center>
            <div class="videodiv">
            <div class="iframestyle" id="vtext">
            <h1 id="vheading">FINALLY MONEY CAN <br />BUY HAPPINESS!</h1>
            <p id="play_link"><span id="how">HOW?</span> <a href="javascript:void(-1)" onclick="play_video()"><img src="images/play.png" /></a></p>
            </div>
            <div class="iframestyle" id="vvideo">
            
            </div>
            </div>
              <a href="<?php echo CController::createUrl('/user/signupAcType'); ?>" >
 <button value="" id="bbtn">Sign Up Now!</button>
 </a>
               </center>
 <!-- end video div -->
 
 
 
 
            <!--Home Page Ends Here-->
        </div>
        </div>    
     
            </div>