<?php
require str_replace('index.php', '', Yii::app()->request->scriptFile) . '/fb_php_sdk/facebook.php';

$facebook = new Facebook(array(
            'appId' => Yii::app()->params['FB_APP_ID'], //'508945735796470',
            'secret' => Yii::app()->params['FB_APP_SECRET'],//'4ba21f0760d6f6c67e336a0b2ae8e068',
            'cookie' => true
        ));


// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
     try {
          // Proceed knowing you have a logged in user who's authenticated.
          $user_profile = $facebook->api('/me');
          // $friends = $facebook->api('/me/friends?limit=25');
          $logoutUrl = $facebook->getLogoutUrl();
          //echo  $token = $facebook->getAccessToken(); exit;
     } catch (FacebookApiException $e) {
          //echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
          $user = null;
     }
}
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
     <body>
<?php
if ($user) {

     $this->_logouturl = $logoutUrl;
     Yii::app()->session->add('logoutUrl', $logoutUrl);
     ?>
               <script type="text/javascript">
                    $(document).ready(function()
                    {
                         window.location = '<?php echo Yii::app()->createAbsoluteUrl('site/loginWithFB') ?>&data=<?php echo base64_encode(serialize($user_profile)) ?>';
                    });
               </script>

          <?php } else { ?>
               
<!--          <fb:login-button></fb:login-button>-->
          <fb:login-button size="large" scope="email,user_birthday,user_about_me" >Connect Using Facebook</fb:login-button>
     <?php } ?>
     <div id="fb-root"></div>
     <script>
          window.fbAsyncInit = function() {
               FB.init({
                    appId: '<?php echo $facebook->getAppID() ?>',
                    cookie: true,
                    xfbml: true,
                    oauth: true
               });
               FB.Event.subscribe('auth.login', function(response) {
                    window.location.reload();
               });
               FB.Event.subscribe('auth.logout', function(response) {
                    window.location.reload();
               });
          };
          (function() {
               var e = document.createElement('script'); e.async = true;
               e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
               document.getElementById('fb-root').appendChild(e);
          }());
	  
     </script>
</body>
</html>
<?php Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/jquery.base64.js'); ?>
