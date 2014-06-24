<?php

class OrganizationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','listOrganizations'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new Organization;
		
		//$model2=new User;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organization']))
		{
		
			$model->attributes=$_POST['Organization'];
			if(isset($_POST['publish']))
				{$model->status = 'active';}
			else
				{$model->status = 'blocked';}
				
				  
			// $user = User::model()->find("email=:email", array(":email"=>'$model->email'));
			//if(!empty($user))
			//{
				
			$model->logo=CUploadedFile::getInstance($model,'logo');
			
			if($model->save())
			{
				$model->logo->saveAs('images/orgLogos/'.$model->logo);
				//$model->make_thumb($model->logo, 'images/');
				 require Yii::getPathOfAlias('application.extensions').'/phpmailer/class.phpmailer.php';
				 $mail = new PHPMailer(true);
  				 $mail->IsSMTP();                           // tell the class to use SMTP
  				 $mail->SMTPAuth   = true;                  // enable SMTP authentication
  				 $mail->Port       = 25;                    // set the SMTP server port
  				 $mail->Host       = "dev.personforce.net"; // SMTP server
  				 $mail->Username   = "muzgan_005@hotmail.com";      // SMTP server username
  				 $mail->Password   = "1";            // SMTP server password
  				 $mail->From       = "muzgan_005@hotmail.com";  
   				 $mail->FromName   = "nazish";  
  				$address = "ngillani@personforce.net";
				$mail->AddAddress($address, "John Doe");
   					 $mail->Subject    = "Your subject";
  				 $body = "Test SMTP Mail using PHPMailer";
  		    	 $mail->MsgHTML($body);
   				$mail->IsHTML(true); // send as HTML
  			    $mail->Send();


				$this->redirect(array('view','id'=>$model->id));
			}
			
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

		if(isset($_POST['Organization']))
		{
			$model->attributes=$_POST['Organization'];
			$model->logo=CUploadedFile::getInstance($model,'logo');
			if($model->save())
			{
			$model->logo->saveAs('images/orgLogos/'.$model->logo);
				$this->redirect(array('view','id'=>$model->id));
				}
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
		$dataProvider=new CActiveDataProvider('Organization');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models in fancy box for post a deal.
	 */
	public function actionListOrganizations()
	{
		$this->layout=false;
		$dataProvider=new CActiveDataProvider('Organization');
		$this->render('listOrganizations',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Organization('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Organization']))
			$model->attributes=$_GET['Organization'];

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
		$model=Organization::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='organization-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
