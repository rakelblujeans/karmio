<?php

class CharitiesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	* Declares class-based actions.
	*/
	public function actions()
	{
	    return array(
		    // captcha action renders the CAPTCHA image displayed on the contact page
		    'captcha'=>array(
			    'class'=>'CaptchaExtendedAction',
			    'mode'=>CaptchaExtendedAction::MODE_MATH,
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'view', 'thankyou', 'create', 'captcha'),
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
		$this->layout = 'admin';
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
		//$this->layout = 'admin';
		$model=new Charities;
		if (isset($_GET['type']))
			$model->type = $_GET['type'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if ( isset($_GET['confirmentry'] ) ) {
			// read values from session
			$model->name = Yii::app()->session['charity_name'];
			$model->owner_name = Yii::app()->session['charity_owner_name'];
			$model->email = Yii::app()->session['charity_email'];
			$model->ein = Yii::app()->session['charity_ein'];
			
			if ( $model->save(false) ) {
				// clear saved valued from session
				unset( Yii::app()->session['charity_name'] );
				unset( Yii::app()->session['charity_owner_name'] );
				unset( Yii::app()->session['charity_email'] );
				unset( Yii::app()->session['charity_ein'] );
				
				// Send an email to the owner				
                $cm = new CentralMailing();
                $cm->new_charity_registered($model);

                $this->render('create-thanks');
				Yii::app()->end();
			}
		}

		if(isset($_POST['Charities']))
		{
			$model->attributes=$_POST['Charities'];
			
			// go to the confirmation step only if the values
			// suppplied are valid
			if ( $model->validate() ) {
				// Save those four attributes in session which need to be
				// confirmed on next screen
				Yii::app()->session['charity_name'] = $model->name;
				Yii::app()->session['charity_owner_name'] = $model->owner_name;
				Yii::app()->session['charity_email'] = $model->email;
				Yii::app()->session['charity_ein'] = $model->ein;
				
				$this->render('create-confirm');
				Yii::app()->end();
			}
			// the following code is not needed in current situation where we are dealing with
			// only text fields
			/*
			if (isset( $_FILES['logo']['name'] ) )
				$model->logo = $_FILES['logo']['name'];
			if($model->save())
			{
				if(isset($_FILES['logo']['name']) && $_FILES['logo']['name'] != '')
					 { 
					  if(!empty($_FILES['logo']['name']))
					  {
						$pic = $_FILES['logo']['name'];
					 	$image_name= mt_rand(4,6).$pic;
						$model->logo = $image_name;
						$newname="images/charityLogos/".$image_name;
						$copied = copy($_FILES['logo']['tmp_name'], $newname);
						chmod($newname,0777);
						}
						 else
						 { 
						 $model->logo = 'default.jpg'; 
						 }
						$npic=''; 
						$npic=''; 
						$rand = rand(1000,9999);
						$npic = "images/charityLogos/".$rand.$_FILES["logo"]["name"];
						$thumb = new Thumbnail($_FILES["logo"]["tmp_name"], 126, 144, $npic);
						$thumb->create();
						//echo $dir.$npic.'<br>';
						//print_r(getimagesize($dir.$npic)); exit;
						
						//Thumbnail::resize_crop($_FILES["logo"]["tmp_name"], $npic, 300, 175);
					// $npic=$model->generate_resized_image($_FILES["picture"]["name"],$_FILES["picture"]["tmp_name"],$_FILES["picture"]["size"]);
					 $model->logo=$npic;
					 $model->save(false, array('logo'));
					}
				$this->redirect(array('create-thanks'));
			}
			*/
		}
		
		if ( isset( $_GET['modify'] ) ) {
			$model->name = Yii::app()->session['charity_name'];
			$model->owner_name = Yii::app()->session['charity_owner_name'];
			$model->email = Yii::app()->session['charity_email'];
			$model->ein = Yii::app()->session['charity_ein'];
		}

		$this->render('create-form',array(
			'model'=>$model,
		));
	}
	
	public function actionThankyou() {
		$this->render('thankyou');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = 'admin';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Charities']))
		{
			$model->attributes=$_POST['Charities'];
			$ein = Charities::model()->findAll('ein='.$_POST['Charities']['ein']);
			
			if(count($ein))
			{
			if($model->save())
			{
				if(isset($_FILES['logo']['name']) && $_FILES['logo']['name'] != '')
					 { 
					  if(!empty($_FILES['logo']['name']))
					  {
						 $pic = $_FILES['logo']['name'];
					 	$image_name= mt_rand(4,6).$pic;
						$model->logo = $image_name;
						$newname="images/charityLogos/".$image_name;
						$copied = copy($_FILES['logo']['tmp_name'], $newname);
						chmod($newname,0777);
						}
						 else
						 { 
						 $model->logo = 'default.jpg'; 
						 }
						$npic=''; 
						$npic=''; 
						$rand = rand(1000,9999);
						$npic = "images/charityLogos/".$rand.$_FILES["logo"]["name"];
						$thumb = new Thumbnail($_FILES["logo"]["tmp_name"], 126, 144, $npic);
						$thumb->create();
						//echo $dir.$npic.'<br>';
						//print_r(getimagesize($dir.$npic)); exit;
						
					//	Thumbnail::resize_crop($_FILES["logo"]["tmp_name"], $npic, 300, 175);
					// $npic=$model->generate_resized_image($_FILES["picture"]["name"],$_FILES["picture"]["tmp_name"],$_FILES["picture"]["size"]);
					 $model->logo=$npic;
					 $model->save(false, array('logo'));
					}
				$this->redirect(array('view','id'=>$model->id));
			}
			}
			else
			{
				$model->addError('ein', 'Ein is invalid');
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
			$charity = $this->loadModel($id);
			if($charity->ein != '')
				Product::model()->updateAll(array('ein' => NULL), 'ein='.$charity->ein);
			//$charity->delete();
			$charity->updateAll(array('deleted' => 1), 'id='.$id);

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
		$dataProvider=new CActiveDataProvider('Charities');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = 'admin';
		$model=new Charities('search');
		$model->unsetAttributes();  // clear any default values
		$model->type = $_GET['type'];
		if(isset($_POST['searching']))
		{
			$model->name=$_POST['searching'];
			//$model->name=$_POST['searching'];
		}

		$this->render('admin',array(
			'model'=>$model,
			'type' => $_GET['type'],
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Charities::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='charities-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
