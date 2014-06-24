<?php

class UserController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                //'class'=>'CCaptchaAction',
                'class' => 'CaptchaExtendedAction',
                //'backColor'=>0xFFFFFF,
                'mode' => CaptchaExtendedAction::MODE_MATH,
            ),
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('create', 'index', 'signupAcType', 'signupBuyer', 'signupSeller', 'activation', 'giftthis', 'captcha'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'welcomeMail', 'buyersDashboard', 'view', 'welcomeMessage', 'updateSignupBuyer', 'updateSeller', 'updatePassword', 'printpopup'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionPrintpopup()
    {
        $this->layout = false;
        $product = UserPurchase::model()->findByPk($_GET['pid']);
        $cp = PurchasedCoupons::model()->findByPk($_GET['cid']);
        $this->render('popup', array('data' => $product, 'cp_code' => $cp->invoice_id));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $msg = '';
        if (isset($_GET['msg']))
            $msg = $_GET['msg'];
        $store = $this->loadModelstore($id);
        $this->render('update', array(
            'model' => $this->loadModel($id),
            'msg' => $msg,
        ));
    }

    /**
     * sign up using fancybox
     */
    public function actionSignupAcType()
    {
        //$this->layout = false;
        //$this->render('signupAcType');
        $this->redirect(array('signupBuyer', 'fbox' => 1));
    }

    /**
     * sign up using fancybox
     */
    public function actionSignupBuyer()
    {
        if (Yii::app()->user->isGuest) {
            //$model = new User;
            //$model->scenario = 'up_password';
            //$xPass;
            if (isset($_POST['User'])) {
                $um = new UserManagement();
                $model = $um->createUser($_POST['User'], $_SESSION['temp_store']);
                if ($model) {
                    if (isset($_SESSION['temp_store'])) {
                        unset($_SESSION['temp_store']);
                    }

                    $cm = new CentralMailing();
                    $mail = $cm->welcome_buyer($model);
                    $this->render('thankyou_signup', array('msg' => 1));
                    exit;
                }
            } else {
                $model = new User;
                $model->scenario = 'up_password';
                $xPass;

                if (isset($_SESSION['temp_store'])) {
                    $model->email = $_SESSION['temp_store']['email'];
                    $model->state_id = $_SESSION['temp_store']['state_id'];
                    $model->location_id = $_SESSION['temp_store']['location_id'];
                    $model->zip = $_SESSION['temp_store']['zip'];
                }
            }

            $this->render('signupBuyer', array(
                'model' => $model,
            ));
        } else
            $this->redirect(array('product/index'));
    }

    public function actionUpdateSignupBuyer()
    {
        $id = Yii::app()->user->id;
        $model = $this->loadModel($id);
        $model->scenario = 'up_password';
        $msg = '';
        //$data = User::model()->findByPk($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['User'])) {
            $old_password = $model->password;
            $model->attributes = $_POST['User'];
            //print_r($model->attributes); exit;
            //$model->location_id=8;
//               $cell_phone_update = $_POST['User']['cellphone'];

            if ($model->validate(array('zip', 'fname', 'email', 'cellphone', 'address', 'address2'))) {
//                    if ($model->password == '' || $old_password == $model->password) {
                $command = Yii::app()->db->createCommand();
                $command->update('tbl_user', array('zip' => $model->zip, 'fname' => $model->fname, 'cellphone' => $model->cellphone, 'address' => $model->address, 'address2' => $model->address2), 'id = :id', array(':id' => $model->id));
                $msg = 'successful';
                $this->redirect(array('view', 'id' => $model->id, 'msg' => $msg));
//                    } else {
//                         
//                              $model->save();
//                              $msg = 'successful';
//                              $this->redirect(array('view', 'id' => $model->id, 'msg' => $msg));
//                         }
            } else {
                $msg = 'Error';
                echo '<div class = "flash">' . Yii::app()->user->setFlash('Error', "Data not update!") . '</div>';

                $this->render('update', array(
                    'model' => $model,
                ));
//                    $this->redirect(array('view', 'id' => $model->id, 'msg' => $msg));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionGiftthis($id, $up)
    {
        $this->layout = false;
        if ($_POST) {
            $uid = Yii::app()->user->id;
            $model = User::model()->findByPk($uid);
            $criteria = new CDbCriteria;
            $criteria->condition = "user_id = $uid and product_id = $id";
            $UPdata = UserPurchase::model()->find($criteria);
            $coupon = $UPdata->invoice_id;
            $name = $model->fname;
            $em = $_POST['email'];
            $body = $_POST['message'];

            $cm = new CentralMailing();
            $mail = $cm->gift_complete(Yii::app()->user->id, $id, $em, $body);

            $quantity = UserPurchase::model()->findbyPk($up);
            $quant = $quantity->quantity + 1;
            $command = Yii::app()->db->createCommand();
            $command->update('tbl_user_purchase', array('gift' => $quant), 'id = :id', array(':id' => $up));

            $this->redirect(array('user/buyersDashboard'));
            exit;
        }
        $this->render('giftthis');
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $msg = '';
        //$model->scenario = 'up_password';
        $model = new User;
        $xPass;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        // if the page is been redirected from facebook
        require_once("fb_php_sdk/facebook.php");
        $config = array();
        $config['appId'] = Yii::app()->params['FB_APP_ID'];
        $config['secret'] = Yii::app()->params['FB_APP_SECRET'];
        $config['fileUpload'] = false; // optional
        $fb = new Facebook($config);

        try {
            $x = $fb->getUser();
        } catch (FacebookApiException $e) {
            // If the user is logged out, you can have a
            // user ID even though the access token is invalid.
            // In this case, we'll get an exception, so we'll
            // just ask the user to login again here.
            $login_url = $fb->getLoginUrl();
        }

        if ($x) {
            // We have a user ID, so probably a logged in user.
            // If not, we'll get an exception, which we handle below.
            try {
                $fql = 'SELECT first_name, last_name, email, current_location from user where uid = ' . $x;
                $ret_obj = $fb->api(array(
                    'method' => 'fql.query',
                    'query' => $fql,
                ));

                // FQL queries return the results in an array, so we have
                //  to get the user's name from the first element in the array.
                //echo '<pre>Name: ' . $ret_obj[0]['name'] . '</pre>';
                //var_dump($ret_obj[0]);
                // Now update the model from the facebook information
                $model->fname = $ret_obj[0]['first_name'];
                $model->lname = $ret_obj[0]['last_name'];
                $model->email = $ret_obj[0]['email'];
                $model->zip = ($ret_obj[0]['current_location']['zip'] == "") ? ' ' : $ret_obj[0]['current_location']['zip'];
                $model->address = $ret_obj[0]['current_location']['name'];
                $model->status = 'inactive';
                $model->fbId = $x;
                //Might be already registered. Try to sign in
                //create session
            } catch (FacebookApiException $e) {
                $login_url = $fb->getLoginUrl();
            }
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->status = 'inactive';
            $xPass = $model->password;
            $model->activatekey = mt_rand() . mt_rand();
            $valid = $model->validate();
            if ($valid) {
                $model->save(false);
                $msg = 'successful';
                //make role as buyer
                $role = new UserRole;
                $role->user_id = $model->id;
                $role->value = 'buyer';
                $role->save(false);

                $cm = new CentralMailing();
                $cm->welcome_buyer($model);

                $this->render('thankyou_signup', array('msg' => 1));
                exit;
            }
        }

        $this->render('create', array(
            'model' => $model,
            'msg' => $msg,
        ));
    }

    /**
     * Welcome Message.
     */
    public function actionWelcomeMessage()
    {
        $this->layout = false;
        $this->render('thankyou_signup');
    }

    /**
     * Deal Welcome.
     */
    public function actionWelcomeMail()
    {
        if (!isset($_REQUEST['id'])) {
            $this->redirect(Yii::app()->user->returnUrl);
        }

        $cm = new CentralMailing();
        $mail = $cm->welcome_buyer(Yii::app()->user);

        $url = CHtml::normalizeUrl(array('/user/welcomeMessage'));
        $this->redirect($url);
        //$this->redirect(Yii::app()->user->returnUrl);
    }

    /**
     * Buyer's Dashboard.
     */
    public function actionBuyersDashboard()
    {
        //$this->layout = 'admin';
        $uid = Yii::app()->user->id;
        $_id = '';
        $_LIds = '';
        $_ids = '0';
        $ids = '0';
        $criteria = new CDbCriteria;

        //Depending upon user purchase
        $UPCriteria = new CDbCriteria();
        $UPCriteria->condition = "user_id = $uid";
        //$UPCriteria->order = 'id DESC';

        $UPdata = UserPurchase::model()->findAll($UPCriteria);
        $UPdata = CHtml::listData($UPdata, 'product_id', 'product_id');
        foreach ($UPdata as $data) {
            $ids .= ', ' . $data;
        }

        $criteria->condition = "up.user_id = $uid"; //"t.id IN ($ids)";
        $criteria->order = 't.id DESC';
        //$criteria->select = 't.*, up.invoice_id as upid';
        //$criteria->join = 'LEFT OUTER JOIN  purchased_coupons up ON t.id=up.purchase_id';
        $criteria->join = 'LEFT JOIN  tbl_user_purchase up ON t.purchase_id=up.id';
        //$criteria->with = array('userPurchases');
        //$criteria->together = true;
        $dataProvider = new CActiveDataProvider('PurchasedCoupons', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 1,
            ),
        ));
        $this->render('buyersDashboard', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $store = $this->loadModelstore($id);
        $this->render('update', array(
            'model' => $model,
            'store' => $store,
        ));
    }

    public function actionUpdatePassword()
    {
        $model->scenario = 'up_password';
        $id = Yii::app()->user->id;
        $model = $this->loadModel($id);
        if (isset($_POST['User'])) {
            $old_password = $model->password;
            $model->password = $_POST['User']['password'];
            $model->old_password = $_POST['User']['old_password'];
            $model->password_repeat = $_POST['User']['password_repeat'];
            $msg = 'failed';
            //$valid = $model->validate();
            //if($valid) {
            if ($_POST['User']['password'] == '' || $_POST['User']['old_password'] == '' || $_POST['User']['password_repeat'] == '') {
                $model->addError('old_password', 'Fill all three fields of password, new pasword and repeat password!');
            } else if ($old_password != md5($_POST['User']['old_password'])) {
                //echo $old_password.' != '.md5($_POST['User']['old_password']);
                $model->addError('old_password', 'Current Password value is not correct!');
            } else if ($model->password != $model->password_repeat) {
                //echo $_POST['User']['password'].' = '.$model->password.' != '.$model->password_repeat; exit;
                $model->addError('old_password', 'Password and repeat password are not same!');
            } /* else if($model->password)
                      {
                      $model->addError('old_password', 'Current Password value is not correct!');
                      } */ else {
                $model->password = md5($model->password);
                $model->save(false);
                $msg = 'successful';
                //$this->redirect(array('view','id'=>$model->id));
            }
        }

        // TODO: send email notifying of change
        $this->render('updatePassword', array(
            'model' => $model,
            'msg' => $msg,
        ));
    }

    public function actionUpdateSeller()
    {
        $id = Yii::app()->user->id;
        $model = $this->loadModel($id);
        $store = $this->loadModelstore($id);

        //$data = User::model()->findByPk($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $output = array();
        if (isset($_POST['User'])) {
            $ucc = new UserManagement();
            $output = $ucc->update($_POST, $model, $store, $id);
            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', $output);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $ucc = new UserManagement();
            $ucc->delete($id);

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $this->layout = 'admin';
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_POST['searching']))
            //$model->attributes=$_GET['User'];
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $_POST['searching'])) {
            $model->email = $_POST['searching'];
        } else {
            $model->fname = $_POST['searching'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelstore($id)
    {
        $model = UserStore::model()->findByAttributes(array("user_id" => $id));
        //if($model===null)
        //throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionActivation()
    {
        $email = $_GET['email'];
        // don't strip out '+', as its a valid email character
        $email = str_replace(' ', '+', $email);
        $activkey = $_GET['activkey'];

        if ($email && $activkey) {
            $find = User::model()->findByAttributes(array('email' => $email));
            if ($find->status == 'active') {
                $uid = Yii::app()->user->id;
                if ($uid != null) {
                    $this->render('thankyou_signup', array('msg' => 3));
                } else {
                    $this->render('thankyou_signup', array('msg' => 5));
                }
            } elseif ($find->status == 'inactive') {
                if ($find->activatekey == $activkey) {
                    $um = new UserManagement();
                    $um->activateUser($find);
                    $loginM = new LoginForm;
                    $loginM->username = $email;
                    $loginM->password = '';
                    $loginM->rememberMe = 0;
                    $temp2 = $loginM->login2();
                    $this->render('thankyou_signup', array('msg' => 2));
                    exit;
                } else {
                    $this->render('thankyou_signup', array('msg' => 4));
                }
            } else {
                $this->render('thankyou_signup', array('msg' => 4));
            }
        }
    }

}

     