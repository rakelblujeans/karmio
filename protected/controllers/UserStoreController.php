<?php

class UserStoreController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $layout = '//layouts/column1';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CaptchaExtendedAction',
                'mode' => CaptchaExtendedAction::MODE_MATH,
            ),
        );
    }

    /**
     * @return array action filters
     */
    public $stickyLogin = 0;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is uld by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index', 'create' and 'view' actions
                  'actions' => array('index', 'view', 'getStores', 'gmapStore', 'launch', 'create', 'captcha', 'signupSeller', 'thankYou'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions' => array('update', 'createstore', 'business', 'create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions' => array('admin', 'delete', 'approveStore', 'denyStore', 'signupSeller'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
    }

    public function actionLaunch()
    {
        $this->render('launch');
        Yii::app()->end();
    }

    public function actionApproveStore()
    {
        $store = UserStore::model()->findByPk($_GET['id']);
        $store->is_verified = 1;
        $store->save(false, array('is_verified'));

        $cm = new CentralMailing();
        $cm->store_approved($store);

        $this->redirect(array('userStore/admin'));
    }

    public function actionDenyStore()
    {
        $store = UserStore::model()->findByPk($_GET['id']);
        $store->is_verified = 0;
        $store->save(false, array('is_verified'));

        $cm = new CentralMailing();
        $cm->store_denied($store);

        $this->redirect(array('userStore/admin'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    /*
    public function actionCreate()
    {
        $msg = '';
         // Just to assure that user couldnot modify it by himself.
        if(!Yii::app()->user->isGuest)
        {
            $model = new UserStore;
            if(Yii::app()->user->getState('fbID') != 0)
            {
            $this->render('karmio_signup',array(
                    'model'=>$model,
                    ));
                    Yii::app()->end();
            }
        }
        if(Yii::app()->user->isGuest)
        {
            //$this->stickyLogin = 1;
            //Yii::app()->user->returnUrl = Yii::app()->request->url;
            $smodel=new TempStore;
            $valid = false;
            if(isset($_POST['UserStore']))
            {
                $model = new UserStore;
                $smodel->attributes = $_POST['UserStore'];
                $model->attributes = $_POST['UserStore'];
                $model->is_verified = 0;
                //print_r($model->attributes); exit;
                $valid = $model->validate();
                if($valid == 1)
                {
                    $model->save();
                    $_SESSION['temp_store'] = $_POST['UserStore'];
                    $this->redirect(array('user/signupBuyer'));
                }
                else
                {
                    $this->render('create',array(
                    'model'=>$model,
                    ));
                    Yii::app()->end();
                }
            }
        }
        else
        {
         $uid = Yii::app()->user->id;
            $isSeller = UserRole::model()->findByAttributes(array("user_id"=>$uid, 'value'=>'seller'));
            if($isSeller == null || $isSeller=='')
            {
                $this->stickyLogin = 2;
            }
        }
        $model=new UserStore;
        $valid = false;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['UserStore']))
        {
            $model->attributes=$_POST['UserStore'];
            $model->user_id = Yii::app()->user->id;
            $model->is_verified = 0;// Just to assure that user couldnot modify it by himself.
            $valid = false;
            $valid = $model->validate();
            if($valid == 1)
            {
                $name = 'st'.time().'.jpg';
                $location = str_replace('#','',$model->address);
                $location = str_replace(' ','+',trim($location));
                //$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$location.'&sensor=false');
                $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$location.'&sensor=false');
                $output= json_decode($geocode);
                //print_r($output); exit;
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                $file = 'http://maps.googleapis.com/maps/api/staticmap?center='.$lat.','.$long.'&size=240x280&markers='.$lat.','.$long.'&zoom=14&maptype=roadmap&sensor=false';
                //echo $file;  exit;
                //$file = 'example.txt';
                 $newfile = 'images/storeMap/'.$name;
                //echo $file; exit;
                if (copy($file, $newfile)) {
                    $model->image_path = $newfile;
                }
                else
                {
                    $model->image_path = 'images/storeMap/default.jpg';
                }

                $model->save();
                //make role as buyer
                $seller = null;
                $seller = UserRole::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id, 'value'=>'seller'));
                if($seller == null)
                {
                    $role = new UserRole;
                    $role->user_id = Yii::app()->user->id;
                    $role->value = 'seller';
                    $role->save(false);
                }
                $cond = strpos(Yii::app()->user->returnUrl, 'product/create');

                    if($cond)
                    {
                        //The new user must be a seller
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                    else
                    {
                        //$this->redirect(array('update','id'=>$model->id, 'msg' => 'success'));
                        $this->render('thankyou');
                        Yii::app()->end();
                    }

            }
        }
        if($model->isNewRecord)
        {
             $user = User::model()->findByPk(Yii::app()->user->id);
             $model->owner_name = $user->fname.' '.$user->lname;
             $model->phone = $user->phone;
        }
        //code added by rabia
        $uid = Yii::app()->user->id;
                $store = UserStore::model()->findAll('user_id='.$uid.' AND is_verified=0');
        if(count($store) > 0){
            $this->render('store_not_verified');
            }
            else
        {
            $this->render('create',array(
            'model'=>$model,
            'msg' => $msg
            ));
        }
    }
    */

    /**
     * Written by Muhammad Anas
     *
     * This version of create action allows creation of a new record in UserStore
     * Table with values of just 3 fields set: name, owner_name and email
     * Work started on: 23 September, 2013
     */
    public function actionCreate()
    {
        $model = new UserStore;
        $model->scenario = 'captchaRequired';
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_GET['confirmentry'])) {
            // read values from session
            $model->name = Yii::app()->session['business_name'];
            $model->owner_name = Yii::app()->session['business_owner_name'];
            $model->email = Yii::app()->session['business_email'];

            $isAdmin = isset(Yii::app()->user->isAdmin) ? Yii::app()->user->isAdmin : 0;
            $um = new UserManagement();
            $new_store = $um->signupSeller(null, $model->attributes, $isAdmin);
            if ($new_store) {
                // clear saved valued from session
                unset(Yii::app()->session['business_name']);
                unset(Yii::app()->session['business_owner_name']);
                unset(Yii::app()->session['business_email']);

                $this->render('create-thanks');
                Yii::app()->end();
            }
        }

        if (isset($_POST['UserStore'])) {
            $model->attributes = $_POST['UserStore'];

            // go to the confirmation step only if the values
            // suppplied are valid
            if ($model->validate()) {
                // Save those three attributes in session which need to be
                // confirmed on next screen
                Yii::app()->session['business_name'] = $model->name;
                Yii::app()->session['business_owner_name'] = $model->owner_name;
                Yii::app()->session['business_email'] = $model->email;

                $this->render('create-confirm');
                Yii::app()->end();
            }
        }

        if (isset($_GET['modify'])) {
            $model->name = Yii::app()->session['business_name'];
            $model->owner_name = Yii::app()->session['business_owner_name'];
            $model->email = Yii::app()->session['business_email'];
        }

        $this->render('create-form', array(
            'model' => $model,
        ));
    }

    public function actionCreatestore()
    {
        // Just to assure that user could not modify it by himself.
        if (Yii::app()->user->isGuest) {
            $this->stickyLogin = 1;
            Yii::app()->user->returnUrl = Yii::app()->request->url;
        }
        $model = new UserStore;
        $valid = false;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['UserStore'])) {
            $model->attributes = $_POST['UserStore'];
            $model->user_id = Yii::app()->user->id; // Just to assure that user couldnot modify it by himself.
            $valid = false;
            $valid = $model->validate();
            if ($valid == 1) {
                $name = 'st' . time() . '.jpg';
                $location = str_replace('#', '', $model->address);
                $location = str_replace(' ', '+', trim($location));
                $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $location . '&sensor=false');
                $output = json_decode($geocode);
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                $file = 'http://maps.google.com/staticmap?&size=240x280&center=' . $lat . ',' . $long . '&markers=' . $lat . ',' . $long . '&zoom=14&maptype=roadmap$sensor=false';
                $newfile = 'images/storeMap/' . $name;

                if (copy($file, $newfile)) {
                    $model->image_path = $newfile;
                } else {
                    $model->image_path = 'images/storeMap/default.jpg';
                }
                $model->save();

                //make role as buyer
                $seller = null;
                $seller = UserRole::model()->findAllByAttributes(array(
                    'user_id' => Yii::app()->user->id,
                    'value' => 'seller'));
                if ($seller == null) {
                    $role = new UserRole;
                    $role->user_id = Yii::app()->user->id;
                    $role->value = 'seller';
                    $role->save(false);
                }
            }
        }

        /*
            $row = Yii::app()->db->createCommand(array(
        'select' => '*',
        'from' => 'tbl_user_store',
        'where' => 'user_id=:user_id',
        'params' => array(':user_id'=>Yii::app()->user->id),))->queryRow();
        if(!empty($row))
        {
        $model->name=$row['name'];
        $model->address=$row['address'];
        $model->address2=$row['address2'];
        $model->zip=$row['zip'];
        $model->phone=$row['phone'];
        $model->location_id=$row['location_id'];
        }*/

        $this->render('createstore', array(
            'model' => $model,
        ));
    }

    public function actionBusiness()
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => '*',
            'from' => 'tbl_user_store',
            'where' => 'user_id=:user_id',
            'params' => array(':user_id' => Yii::app()->user->id),))->queryRow();

        if (!empty($row)) {
            $this->redirect(array('view', 'id' => $row['id']));
        } else {
            $this->redirect(array('createstore'));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate2($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['UserStore'])) {
            $model->attributes = $_POST['UserStore'];
            $valid = false;
            $valid = $model->validate();
            if ($model->save()) {
                $this->render('_success', array(
                    'model' => $model,));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $msg = '';
        if (isset($_GET['msg']) && $_GET['msg'] != '')
            $msg = $_GET['msg'];
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['UserStore'])) {
            $model->attributes = $_POST['UserStore'];
            $valid = false;
            $valid = $model->validate();
            if ($valid)
                $msg = 'success';
            $model->save();
        }
        if (isset($_REQUEST['fbox'])) {
            $this->layout = false;
            if ($model->name == '')
                $model->name = 'Business Name';
            if ($model->phone == '')
                $model->phone = 'Phone';
            if ($model->address == '')
                $model->address = 'Address';
            if ($model->address2 == '')
                $model->address2 = 'Address2';
            if ($model->zip == '')
                $model->zip = 'Zip Code';
            if ($model->website == '')
                $model->website = 'http://';
            if ($valid) {
                $msg = 'success';
                $this->render('_success');
            } else {
                $this->render('_form_create_fbox', array(
                    'model' => $model,
                ));
            }
        } else {
            $this->render('update', array(
                'model' => $model,
                'msg' => $msg
            ));
        }
    }

    public function actionThankYou() 
    {
      $this->render('thankyou');
      Yii::app()->end();
    }

    public function actionSignupSeller()
    {
      $isAdmin = isset(Yii::app()->user->isAdmin) ? Yii::app()->user->isAdmin : 0;
      if (Yii::app()->user->isGuest || $isAdmin) {
        // because we are not signed in, require captcha
        $msg = '';
        if (isset($_GET['msg']) && $_GET['msg'] != '')
          $msg = $_GET['msg'];
        
        if(isset($_POST['UserStore'])) {
          $ucc = new UserManagement();
          // TODO: turn off captcha
          $store = $ucc->signupSeller($_POST['User'], $_POST['UserStore'], 
                                      $isAdmin);
          if ($store) {
            $msg = 'success';
            if ($isAdmin) {
              // admin signup flow:
              // User is auto-approved and we move onto creating
              // a new deal
              $this->redirect(array('product/create&uid=' . $store->user_id));
            } else {
              // normal signup flow:
              // User has to wait to be verified
              $this->redirect(array('thankYou'));
            }
          }
        }
        
        $model = new UserStore;
        $user = new User;
        // TODO: clear form?
        // TODO: forms errors aren't displaying. not sure why
          $this->render('seller-signup', 
                        array('model' => $model,
                              'user' => $user,
                              'msg' => $msg 
                              ));
          
      } else {
        $this->redirect(array('product/index'));
      }
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
            $this->loadModel($id)->delete();
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
        $dataProvider = new CActiveDataProvider('UserStore');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionGmapStore()
    {
        $this->layout = false;
        if (isset($_REQUEST['st_id'])) {
            $s_id = $_REQUEST['st_id'];
            $model = UserStore::model()->findByPk($s_id);
            $this->render('_gmap', array(
                'model' => $model,
            ));
        } elseif (isset($_REQUEST['pro_id'])) {
            $p_id = $_REQUEST['pro_id'];
            $model = Product::model()->findByPk($p_id);
            $this->render('_gmap', array(
                'model' => $model,
            ));
        } else {
            //redirect
            $this->render('_gmap');
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $this->layout = 'admin';
        $model = new UserStore('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['UserStore']))
            $model->attributes = $_GET['UserStore'];

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
        $model = UserStore::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-store-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Send User Stores
     */
    public function actionGetStores()
    {
        $model = new Product;
        $uid = Yii::app()->user->id;
        $data = UserStore::model()->findAll('user_id = :uId',
            array(':uId' => $uid)
        );
        $data = CHtml::listData($data, 'id', 'name');
        echo CHtml::activeCheckBoxList($model, 'storeArray', $data);
    }

}

