<?php

class SiteController extends Controller {

    protected $_identity;
    public $_logouturl;

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                //'class' => 'CCaptchaAction',
                'class'=>'CaptchaExtendedAction',
                //'backColor' => 0xFFFFFF,
                'mode'=>CaptchaExtendedAction::MODE_MATH,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

//            $find = User::model()->findByAttributes(array('email' => $_POST['email']));
    public function actionForgetPassword() {
        $msg = '';
        $model = new FPForm;
        if (isset($_POST['FPForm'])) {
            $model->attributes = $_POST['FPForm'];
            if ($model->validate()) {
                $user = User::model()->find('email="' . $model->email . '"');
                if (count($user)) {
                    $msg = 'success';
                    $um = new UserManagement();
                    $um->resetPassword($user);
                } else {
                    $model->addError('email', 'Email address does not exist in system. kindly check with a correct email address');
                }
            }
        }
        $this->render('forget_password', array('model' => $model, 'msg' => $msg));
    }

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
        //print $text . "\n";
    }

    public function actionNewPassword($secret_key) {
        $model = User::model()->findByAttributes(array(
            'secret_key' => $secret_key,
        ));
        if (isset($_POST['User'])) {

            /*$model->password = $_POST['User']['password'];
            $model->password_repeat = $_POST['User']['password_repeat'];
            $model->secret_key = 'Password Update';
            if ($model->save(false)) {*/
            $um = new UserManagement();
            $result = $um->updatePassword($model, $_POST['User']);
            if ($result) {
                echo Yii::app()->user->setFlash("success", "Password has been Changed");
                $this->redirect(CController::createUrl('/site/login'));
            } else {
                echo Yii::app()->user->setFlash("Error!", "Password not Changed");
                $this->render('newpassword', array('model' => $model));
            }
        }
        if (!empty($model)) {
            $model->password = '';
            $this->render('newpassword', array('model' => $model));
        } else {
            echo ' <center> <h2>You already Change Password for this Link</h2></center>';
            Yii::app()->end();
        }
    }

    public function actionNewsLetter() {
        $model = new NewsletterForm();
        $msg = '';
        if ( isset($_POST['NewsletterForm']) ) {
            $model->attributes = $_POST['NewsletterForm'];
            
            if ( $model->validate() ) {
                $api = new MCAPI(Yii::app()->params['MCAPI']);
                $merge_vars = array('MMERGE5' => $model->name);
                // TODO: this constant?
                $retval = $api->listSubscribe('7d2dd0c89d', $model->email, $merge_vars);
                if ($api->errorCode) {
                    $msg = $api->errorMessage;
                } else {
                    $this->render('newsletter-thanks');
		    return;
                }
            }
            $this->render('newsletter-form', array('model' => $model, 'errorMessage' => $msg ) );
        } else if (isset($_GET['showform'])) {
	  $this->render('newsletter-form', array('model' => $model, 'errorMessage' => $msg) );
        } else {
	  // landing
	  $this->render('newsletter-welcome', array('showForm' => true));
        }
    }

    public function actionLoginWithFB() {
        //$post_data = $_GET['data']; //(base64_decode($_GET['data']));
//          $friends = $_GET['friends'];
        $fm = new FacebookManagement();
        $user = $fm->loginWithFB($_GET['data']);

        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($user->fbId, $user->email);
            $this->_identity->authenticate(true);
            $this->_identity->setState('myName', $user->fname . " " . $user->lname);
            $error = 0;
            if ($error === UserIdentity::ERROR_NONE) {

                $duration = 3600 * 24 * 30;
                Yii::app()->user->login($this->_identity, $duration);
                Yii::app()->user->myName = $user->fname . " " . $user->lname;
                $this->redirect(Yii::app()->user->returnUrl);
            } else {
                return false;
            }
        }
    }

    public function actionFblogin() {
        if ($this->_identity === null) {
            $this->_identity = new FBIdentity($_GET['username'], $_GET['userid']);
            $this->_identity->authenticate();
            $this->_logouturl = $_GET['logout'];
            //$this->setState('email', $record->email);
            $this->_identity->setState('username', $_GET['username']);

            $error = 0;
            if ($error === FBIdentity::ERROR_NONE) {

                $duration = 3600 * 24 * 30;
                Yii::app()->user->login($this->_identity, $duration);
                $this->redirect(Yii::app()->user->returnUrl);
            } else {
                return false;
            }
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        if ( Yii::app()->user->isGuest ) {
            $this->redirect( array("site/newsletter") );
        }

        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $cm = new CentralMailing();
                $cm->contact($model);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }

        $this->render('contact', array('model' => $model));
    }

    public function actionAbout() {
        $this->render('pages/about');
    }

    public function actionTeam() {
        $this->render('pages/team');
    }

    public function actionNonprofit() {
        $this->render('pages/nonprofit');
    }

    public function actionFaq() {

        $questions = Faq::model()->findAll('status="Active"');
        $this->render('pages/faq', array('questions' => $questions));
    }

    public function actionMission() {
        $this->render('mission');
    }

    public function actionPress() {
        $this->render('press');
    }

    public function actionHow_it_works() {
        $this->render('how_it_works');
    }

    public function actionTerms() {
        $this->render('pages/terms');
    }

    public function actionFavCharities() {
        $charities = Charities::model()->findAll('type="Partner"');
        $this->render('fav_charities', array('charities' => $charities));
    }

    public function actionPrivacypolicy() {
        $this->render('pages/privacypolicy');
    }

    /**
     * Displays the login page
     */
    /*     * ************ Facebook login****************************************** */
    public function actionFacebooklogin() {
        Yii::import('ext.facebook.*');
        $ui = new FacebookUserIdentity(Yii::app()->params['FB_APP_ID'], Yii::app()->params['FB_APP_SECRET']);
        if ($ui->authenticate()) {
            $user = Yii::app()->user;
            $user->login($ui);
            $this->redirect($user->returnUrl);
        } else {
            throw new CHttpException(401, $ui->error);
        }
    }

    /*     * ****************************************************** */
    public function actionLogin() {
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            if (Yii::app()->user->getState('attempts-login') > 1) { 
                    $model->scenario = 'withCaptcha'; 
            }
            
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Yii::app()->user->setState('attempts-login', 0); //if login is successful, reset the attempts
                if (isset(Yii::app()->user->isAdmin)) {
                   // if (Yii::app()->user->returnUrl == '/beta/index.php') {
                        $this->redirect(Yii::app()->user->myDash);
                   // } else {
                   //     $this->redirect(Yii::app()->user->returnUrl);
                   // }
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            } else {
                Yii::app()->user->setState('attempts-login',
				 Yii::app()->user->getState('attempts-login', 0) + 1);
            }
        }
//
//          if (!isset($_GET['provider'])) {
//               $this->redirect('/site/index');
//               return;
//          }
//
//          try {
//               Yii::import('ext.components.HybridAuthIdentity');
//               $haComp = new HybridAuthIdentity();
//               if (!$haComp->validateProviderName($_GET['provider']))
//                    throw new CHttpException('500', 'Invalid Action. Please try again.');
//
//               $haComp->adapter = $haComp->hybridAuth->authenticate($_GET['provider']);
//               $haComp->userProfile = $haComp->adapter->getUserProfile();
//
//               $haComp->processLogin();  //further action based on successful login or re-direct user to the required url
//          } catch (Exception $e) {
//               //process error message as required or as mentioned in the HybridAuth 'Simple Sign-in script' documentation
//               $this->redirect('/site/index');
//               return;
//          }
        // collect user input data
        if (isset($_POST['mainLogin'])) {
            $model->username = $_POST['uname'];
            $model->password = $_POST['upass'];
        // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                if (isset(Yii::app()->user->isSeller)) {

                    if (Yii::app()->user->returnUrl == '/beta/index.php') {
                        $this->redirect(Yii::app()->user->myDash);
                    } else {
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
        }
  
        if (Yii::app()->user->getState('attempts-login') > 1) { 
                $model->scenario = 'withCaptcha';
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
      /                         window.location = '<?php //echo Yii::app()->createAbsoluteUrl('site/loginWithFB') ?>&data=<?php// echo base64_encode(serialize($user_profile)) ?>&friends=<?php echo base64_encode(serialize($friends)) ?>';
     */
    public function actionLogout() {
        require str_replace('index.php', '', Yii::app()->request->scriptFile) . '/fb_php_sdk/facebook.php';
        //         Yii::import('ext.fb_php_sdk.Facebook');
        // $params is optional.
        $fblogout = Yii::app()->session->get('logoutUrl');
        if ($fblogout != '') {
            $facebook = new Facebook(array(
                'appId' => Yii::app()->params['FB_APP_ID'],
                'secret' => Yii::app()->params['FB_APP_SECRET'],
            ));
            $params = array('next' => 'http://beta.karm.io/');
            $logoutURL = $facebook->getLogoutUrl($params);
            Yii::app()->user->logout();

            if (isset(Yii::app()->user->isAdmin))
                UserIdentity::clearState('isAdmin');

            if (isset(Yii::app()->user->isSeller))
                UserIdentity::clearState('isSeller');

            if (isset(Yii::app()->user->isBuyer))
                UserIdentity::clearState('isBuyer');

            echo "<script>window.location='" . $logoutURL . "'</script>";
//            header("Location:".$logoutURL);
        }
        Yii::app()->user->logout();

        if (isset(Yii::app()->user->isAdmin))
            UserIdentity::clearState('isAdmin');

        if (isset(Yii::app()->user->isSeller))
            UserIdentity::clearState('isSeller');

        if (isset(Yii::app()->user->isBuyer))
            UserIdentity::clearState('isBuyer');
//echo $fblogout; exit;
//$this->redirect(Yii::app()->session->get('logoutUrl'));
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Add deals to session/cart
     */
    public function actionAddToCart() {
        if (!isset($_POST['addCart'])) {
            Yii::app()->end();
        }

        if (!isset(Yii::app()->session['cart'])) {
            Yii::app()->session['cart'] = array();
        }

        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $temp = array();
        $temp = Yii::app()->session['cart'];
        $temp[$id] = array();
        $temp[$id]['id'] = $id;
        $temp[$id]['qty'] = $qty;

        $model = Product::model()->findByPk($id);

        Yii::app()->session['cart'] = $temp;
        $this->renderPartial('_cartAdded', array('data' => $model));
    }

    /**
     * remove deals to session/cart
     */
    public function actionRemFromCart() {
        if (!isset($_POST['remCart'])) {
            Yii::app()->end();
        }

        $id = $_POST['id'];
        $temp = array();
        $data = array();
        $temp = Yii::app()->session['cart'];
        unset($temp[$id]);

        $model = Product::model()->findByPk($id);

        Yii::app()->session['cart'] = $temp;
        $this->renderPartial('_cartRemoved', array('data' => $model));
    }

    /**
     * View Cart
     */
    public function actionViewCart() {
        $cart = Yii::app()->session['cart'];
        $data = array();
        $temp = array();
        foreach ($cart as $deal) {
            $model = Product::model()->findByPk($deal['id']);
            $temp['name'] = $model->name;
            $temp['price'] = $model->price;
            $temp['qty'] = $deal['qty'];
            $temp['cost'] = (float) ($temp['price'] * $temp['qty']);
            array_push($data, $temp);
        }

        $this->render('displayCart', array('data' => $data));
    }

    /**
     * Update Status of expired deals
     */
    public function actionExpireStatus() {
        $today = date('Y-m-d');
        $criteria = new CDbCriteria();
        $criteria->condition = "status = 'published' AND expiry_date < '$today'";
        $products = Product::model()->findAll($criteria);
        foreach ($products as $product) {
            $product->status = 'ended';
            $product->save(false);
        }
    }

}

