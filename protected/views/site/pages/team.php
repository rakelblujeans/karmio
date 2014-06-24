<?php

$this->pageTitle=Yii::app()->name . ' - Team';

$this->breadcrumbs=array(

	'Team',

);

?>
<script type="text/javascript">
jQuery(document).ready(function(){jQuery('body').css('backgroundImage', 'url(images/Backgrounds/bg_004.jpg)')});
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabcontent.js"></script>
<div id="MainBody">
            <div class="CenterAlign">
            <div class="HundredPercent">
            
            
            
            	   
                    <div class="BgBox"> 
                  <!--About Inside Starts Here-->
                
                  <div class="OurTeamBox">
                  <!--About Inside Starts Here-->
                 
                    <h1 >THE TEAM</h1>
                     <ul class="tabs" persist="true">
						<li><a href="#" rel="team1"><img src="images/pic1.png" alt="" width="101" height="101" /></a></li>
                        <li><a href="#" rel="team2"><img src="images/pic2.jpg" alt="" width="101" height="101" /></a></li>
                        <li><a href="#" rel="team3"><img src="images/pic3.jpg" alt="" width="101" height="101" /></a></li>
                        <li><a href="#" rel="team4"><img src="images/pic4.jpg" alt="" width="101" height="101" /></a></li>
					    <li><a href="#" rel="team5"><img src="images/pic5.jpg" alt="" width="101" height="101" /></a></li>
                   </ul>
                   <div class="tabcontents">
                      <div id="team1" class="tabcontent TeamContainer">
                        <h3>Libby Garrett </h3>
                        <p>Libby Garrett is a regular contributor to PSFK.com. She is a trends specialist and strategist who teaches trends investigation and innovation design at Istituto di Design, Barcelona. She enjoys the company of soothsayers, entrepreneurs and people who make things. Her favorite possession is her passport. </p>
						<ul>
                    		<li><a href="#">RSS </a></li>
                    		<li><a href="#">Website </a></li>
                    		<li>@libby_garrett </li>
                   		</ul>
                     </div>
                     <div id="team2" class="tabcontent TeamContainer">
                        <h3>Maggie Thorn</h3>
                        <p>Maggie Thorn is a regular contributor to PSFK.com. She is a trends specialist and strategist who teaches trends investigation and innovation design at Istituto di Design, Barcelona. She enjoys the company of soothsayers, entrepreneurs and people who make things. Her favorite possession is her passport. </p>
						<ul>
                    		<li><a href="#">RSS </a></li>
                    		<li><a href="#">Website </a></li>
                    		<li>@maggie_thorn </li>
                   		</ul>
                     </div>
                     <div id="team3" class="tabcontent TeamContainer">
                        <h3>Stephanie Frost</h3>
                        <p>Stephanie Frost is a regular contributor to PSFK.com. She is a trends specialist and strategist who teaches trends investigation and innovation design at Istituto di Design, Barcelona. She enjoys the company of soothsayers, entrepreneurs and people who make things. Her favorite possession is her passport. </p>
						<ul>
                    		<li><a href="#">RSS </a></li>
                    		<li><a href="#">Website </a></li>
                    		<li> @stephanie_frost</li>
                   		</ul>
                     </div>
                     <div id="team4" class="tabcontent TeamContainer">
                        <h3>Julia Crow</h3>
                        <p>Julia Crow is a regular contributor to PSFK.com. She is a trends specialist and strategist who teaches trends investigation and innovation design at Istituto di Design, Barcelona. She enjoys the company of soothsayers, entrepreneurs and people who make things. Her favorite possession is her passport. </p>
						<ul>
                    		<li><a href="#">RSS </a></li>
                    		<li><a href="#">Website </a></li>
                    		<li> @julia_crow</li>
                   		</ul>
                     </div>
                     <div id="team5" class="tabcontent TeamContainer">
                        <h3>Max Stone</h3>
                        <p>Max Stone is a regular contributor to PSFK.com. She is a trends specialist and strategist who teaches trends investigation and innovation design at Istituto di Design, Barcelona. She enjoys the company of soothsayers, entrepreneurs and people who make things. Her favorite possession is her passport. </p>
						<ul>
                    		<li><a href="#">RSS </a></li>
                    		<li><a href="#">Website </a></li>
                    		<li> @max_stone</li>
                   		</ul>
                     </div>
                   
                  </div>
                    <div class="TeamBox"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/about')?>" class="TeamTxt"> About Us  </a> </div>
                  </div>
</div>
</div>
</div>
</div>
</div>