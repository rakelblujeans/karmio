<?php

// TODO: think this is not used. flag for removal

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','dashboard','suspendMail','approvedMail'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Seller;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seller']))
		{
			$model->attributes=$_POST['Seller'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seller']))
		{
			$model->attributes=$_POST['Seller'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$uid = Yii::app()->user->id;
		
		$cCriteria = new CDbCriteria();
		$cCriteria->condition = "user_id = $uid AND status = 'published'";

		$cDeal=new CActiveDataProvider('Product', array(
			'criteria'=>$cCriteria,
		    'pagination'=>array(
				'pageSize'=>5,
			),
		));

		$myCriteria = new CDbCriteria();
		$myCriteria->select = 'SUM(paid_price) AS paid_price'
							.', SUM(donated) AS donated'
							.', SUM(quantity) AS quantity';
		$myCriteria->join = 'LEFT JOIN tbl_product ON tbl_product.id=product_id';
		$myCriteria->condition = "tbl_product.user_id = $uid AND tbl_product.status = 'published'";
		$data = UserPurchase::model()->findAll($myCriteria);
		
		foreach($data as $cDatum)
		{
			;
		}
		if($cDatum->quantity == null)
		{
			$cDatum->paid_price = 0;
			$cDatum->donated = 0;
			$cDatum->quantity = 0;
		}

		
		$cCriteria = new CDbCriteria();
		$cCriteria->condition = "user_id = $uid AND status NOT IN ('published', 'unpublished')";

		$pDeal=new CActiveDataProvider('Product', array(
			'criteria'=>$cCriteria,
		    'pagination'=>array(
				'pageSize'=>5,
			),
		));

		$myCriteria = new CDbCriteria();
		$myCriteria->select = 'SUM(paid_price) AS paid_price'
							.', SUM(donated) AS donated'
							.', SUM(quantity) AS quantity';
		$myCriteria->join = 'LEFT JOIN tbl_product ON tbl_product.id=product_id';
		$myCriteria->condition = "tbl_product.user_id = $uid AND tbl_product.status NOT IN ('published','unpublished')";
		$data = UserPurchase::model()->findAll($myCriteria);
		
		foreach($data as $pDatum)
		{
			;
		}
		if($pDatum->quantity == null)
		{
			$pDatum->paid_price = 0;
			$pDatum->donated = 0;
			$pDatum->quantity = 0;
		}


		if($cDeal==null) 
			$this->redirect(Yii::app()->home);
		$this->render('index', array('cDeal'=>$cDeal, 
									'cData'=>$cDatum,
									'pDeal'=>$pDeal,
									'pData'=>$pDatum,));
	}

	/**
	 * Manage the deals, update their status
	 */
	public function actionDashboard()
	{
		$uid = Yii::app()->user->id;
		$status = 'published';
		//var_dump($_POST);
		if(isset($_REQUEST['status']))
			$status = $_REQUEST['status'];
		if(isset($_POST['unpublished_x']))
			$status = 'unpublished';
		if(isset($_POST['holding_x']))
			$status = 'holding';
		if(isset($_POST['suspended_x']))
			$status = 'suspended';
		
		if(isset($_POST['status_update']) && isset($_POST['id']))
		{
			if($_POST['status_update'] == 'published' || $_POST['status_update'] == 'suspended')
			{
				$product=Product::model()->findByPk((int)$_POST['id']);
				if($product != null)
				{
					$product->status = $_POST['status_update'];
					$product->save(false);

					//redirect to send mail and come back.
					if($_POST['status_update'] == 'published')
					{
						$url = CController::createUrl('admin/approvedMail', array('status'=>$status, 'id'=>$_POST['id']));
					}
					else
					{
						$url = CController::createUrl('admin/suspendMail', array('status'=>$status, 'id'=>$_POST['id']));
					}
					$this->redirect($url);
				}
			}
		}
		$cCriteria = new CDbCriteria();
		$cCriteria->condition = "status = '$status'";
		$cCriteria->order = 'id DESC';

		$cDeal=new CActiveDataProvider('Product', array(
			'criteria'=>$cCriteria,
		    'pagination'=>array(
				'pageSize'=>5,
			),
		));


		if($cDeal==null) 
			$this->redirect(Yii::app()->home);
		$this->render('dashboard', array('cDeal'=>$cDeal,'status'=>$status));
	}

	/**
	 * Deal Approved Mail.
	 */
	public function actionApprovedMail()
	{
		if(!isset($_REQUEST['id']))
		{
			$url = CController::createUrl('admin/dashboard');
			$this->redirect($url);
		}	
		$cm = new CentralMailing();
		$mail = $cm->deal_approved($_REQUEST['id']);

		$url = CController::createUrl('admin/dashboard', array('status' => $_REQUEST['status']));
		$this->redirect($url);
	}

	/**
	 * Deal Suspended Mail.
	 */
	public function actionSuspendMail()
	{
		if(!isset($_REQUEST['id']))
		{
			$url = CController::createUrl('admin/dashboard');
			$this->redirect($url);
		}	
		$cm = new CentralMailing();
		$mail = $cm->deal_suspended($_REQUEST['id']);

		$url = CController::createUrl('admin/dashboard', array('status' => $_REQUEST['status']));
		$this->redirect($url);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = 'admin';
		$model=new Seller('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seller']))
			$model->attributes=$_GET['Seller'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Seller::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Seller-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
