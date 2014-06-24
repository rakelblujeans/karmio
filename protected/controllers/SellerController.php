<?php

class SellerController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'create', 'update', 'checkIn', 'share', 'downloadpdf', 'searchcoupon', 'Print_deal', 'exportBuyers'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'dashboard', 'suspendMail', 'approvedMail'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionExportBuyers() {
        $dg = new DocumentGeneration();
        echo $dg->exportBuyersList($_GET['deal_id']);
        exit;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Seller;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Seller'])) {
            $model->attributes = $_POST['Seller'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionSearchcoupon() {
        $searching = 'a';
        if (isset($_POST['searching']) || isset($_REQUEST['searching'])) {
            $searching = addslashes($_POST['searching']);
            if (isset($_REQUEST['searching'])) {
                $searching = addslashes($_REQUEST['searching']);
            }

            $uid = Yii::app()->user->id;
            $criteria = new CDbCriteria();
            if ($uid == 1) {
                //$criteria->condition = "name like '".$searching."%' or couponcode like '".$searching."%'";
                $criteria->condition = "name like '" . $searching . "%' or couponcode like '" . $searching . "%' or fname LIKE '%" . $searching . "%' or lname LIKE '%" . $searching . "%'";
                $criteria->join = "JOIN tbl_user ON `t`.user_id=tbl_user.id";
            } else {
                $criteria->condition = "(name like '" . $searching . "%' or couponcode like '" . $searching . "%') and user_id=$uid ";
            }

            $criteria->order = 'id DESC';

            $pDatum = new CActiveDataProvider('Product', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 5,
                ),
            ));

            $this->render('searchcoupon', array(
                'pDatum' => $pDatum,
                'searching' => $searching,
            ));
        } else {
            $this->render('searchcoupon', array(
                'msg' => 'Please enter keyword for searching',
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Seller'])) {
            $model->attributes = $_POST['Seller'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        //$this->layout = 'admin';
        $sm = new SellerManagement();
        $output = $sm->listAllData(Yii::app()->user, $_POST);

        if ($output['cDeal'] == null)
            $this->redirect(Yii::app()->home);
        $this->render('index', $output);
    }

    /**
     * Manage the deals, update their status
     */
    public function actionDashboard() {
        $this->layout = 'admin';
        $sm = new SellerManagement();
        $output = $sm->getDashboardData(Yii::app()->user, $_POST, $_REQUEST, $_FILES);

        if (isset($_POST['id'])) {
          //redirect to send mail and come back.
          if ($_POST['status_update'] == 'published') {
            $url = CController::createUrl('seller/approvedMail', 
                                          array('status' => $output['status'], 
                                                'id' => $_POST['id']));
          } else if ($_POST['status_update'] == 'suspended') { //else {
            $url = CController::createUrl('seller/suspendMail', 
                                          array('status' => $output['status'], 
                                                'id' => $_POST['id']));
          }
          $this->redirect($url);
          Yii::app()->end();
        }
        
        if ($output['cDeal'] == null)
          $this->redirect(Yii::app()->home);
        $this->render('dashboard', $output);
    }

    public function actionShare() {
        $uid = Yii::app()->user->id;
        //$data = Product::model()->getShareList($uid);
        $cCriteria = new CDbCriteria();
        $cCriteria->select = 'l.* , org.logo';
        $cCriteria->alias = 'l';
        $cCriteria->join = 'join tbl_user u on (l.user_id = u.id ) and (l.organization_id = u.organization_id) left join tbl_organization org on (l.organization_id = org.id )';
        $cCriteria->condition = "(l.status = 'sold_out' or l.status = 'ended') and (l.user_id = $uid) ";
        $cCriteria->order = 'l.id desc';

        $cDeal = new CActiveDataProvider('Product', array(
            'criteria' => $cCriteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));

        // $criteria = new CDbCriteria(); 
        // $criteria->select = 'l.name, l.regular_price, l.price, org.logo as logo';
        //$criteria->alias = 'l';
        //$criteria->together = true;
        // $criteria->join = 'LEFT join tbl_user u on (l.user_id = u.id ) and (l.organization_id = u.organization_id) LEFT join tbl_organization org on (l.organization_id = org.id )';
        //$criteria->condition = "(l.status = 'sold_out' or l.status = 'ended') and (l.user_id = '2') ";
        // $criteria->order = 'l.id desc';
        //$data = Product::model()->findAll($criteria);
        //$cDeal=new CActiveDataProvider('Product', array(
        //	'criteria'=>$criteria,
        //    'pagination'=>array(
        //		'pageSize'=>5,
        //	),
        //	));
//if($cDeal==null) 
        //$this->redirect(Yii::app()->home);

        $this->render('share', array('cDeal' => $cDeal));
    }

    public function actionDownloadpdf($id) {
        $dg = new DocumentGeneration();
        $dg->downloadPurchaseDetailPdf($id);
    }

    /**
     * Deal Approved Mail.
     */
    public function actionApprovedMail() {
        if (!isset($_REQUEST['id'])) {
            $url = CController::createUrl('seller/dashboard');
            $this->redirect($url);
        }
        $cm = new CentralMailing();
        $mail = $cm->deal_approved($_REQUEST['id']);

        $url = CController::createUrl('seller/dashboard', array('status' => $_REQUEST['status']));
        $this->redirect($url);
    }

    /**
     * Deal Suspended Mail.
     */
    public function actionSuspendMail() {
        if (!isset($_REQUEST['id'])) {
            $url = CController::createUrl('seller/dashboard');
            $this->redirect($url);
        }

        $cm = new CentralMailing();
        $mail = $cm->deal_suspended($_REQUEST['id']);

        $url = CController::createUrl('seller/dashboard', array('status' => $_REQUEST['status']));
        $this->redirect($url);
    }

    /**
     * CheckIn.
     */
    public function actionCheckIn() {
        //if (isset($_POST['invoice'])) {
            $sm = new SellerManagement();
            $output = $sm->checkIn(Yii::app()->user, $_POST);
            $this->render('checkin', $output);
        //}
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Seller('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Seller']))
            $model->attributes = $_GET['Seller'];
        $this->render('checkin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Seller::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Seller-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrint_deal($id) {
        $data = Product::model()->findByPk($id);
        $html = $this->renderPartial('print_view', array('data' => $data), true);
        $dg = new DocumentGeneration();
        $dg->printDealDetail($id, $html);
    }

}

