<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php  
echo $this->renderPartial('UpdateSignupBuyer', array('model'=>$model,'store'=>$store, 'msg' => $msg));
/*
if(isset(Yii::app()->user->isBuyer) && isset(Yii::app()->user->isSeller) && $store != NULL)
				{
					echo $this->renderPartial('UpdateSignupSeller', array('model'=>$model,'store'=>$store));
				} 
if(isset(Yii::app()->user->isBuyer) && (!isset(Yii::app()->user->isSeller) || $store == NULL))
				{
					echo $this->renderPartial('UpdateSignupBuyer', array('model'=>$model));
				}
			
if(isset(Yii::app()->user->isSeller) && !isset(Yii::app()->user->isBuyer))
				{
					echo $this->renderPartial('UpdateSignupSeller', array('model'=>$model,'store'=>$store));
				} 
	*/

?>

