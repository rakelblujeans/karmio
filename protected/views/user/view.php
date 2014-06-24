<?php

$this->breadcrumbs=array(

	'Users'=>array('index'),

	$model->id,

);

 if(isset(Yii::app()->user->isSeller) && isset(Yii::app()->user->isBuyer))

				{

$this->menu=array(

	array('label'=>'Update Profile', 'url'=>array('updateSeller', 'id'=>$model->id)),

	

);

}

 if(isset(Yii::app()->user->isSeller) && !isset(Yii::app()->user->isBuyer))

				{

$this->menu=array(

	array('label'=>'Update Profile', 'url'=>array('updateSeller', 'id'=>$model->id)),

	

);

}

 if(isset(Yii::app()->user->isBuyer) && !isset(Yii::app()->user->isSeller))

				{

				$this->menu=array(

	array('label'=>'Update Profile', 'url'=>array('update', 'id'=>$model->id)),

	

);				}

$this->widget('application.extensions.fancybox.EFancyBox', array(

    	'target'=>'a.signup',

		'config'=>array(

							'enableEscapeButton'	=> true,

							'showCloseButton'		=> false,

							'hideOnOverlayClick'	=> true,

							'centerOnScroll'		=> true,



						),

    	)

	);

?>

<div id="postdealrow">

<div class="current-deals"><div class="t-deal">My Profile</div></div>

</div>

<div id="postdealrow">



<?php if(isset(Yii::app()->user->isSeller) && isset(Yii::app()->user->isBuyer))

		{

				$this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'First Name'=>'fname',

		'Last Name'=>'lname',

		'Email'=>'email',

		array('value' => $model->location_id, 'label' => 'City'),
		array('value' => $model->state_id, 'label' => 'State'),

		'Zip Code'=>'zip',

		'Address'=>'userStores.address',

		'Address2'=>'userStores.address2',

		'Store Name'=>'userStores.name',

		'Website'=>'userStores.website',

		'cellphone',

	),

)); 



		}

		if(isset(Yii::app()->user->isSeller) && !isset(Yii::app()->user->isBuyer))

		{

				$this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'First Name'=>'fname',

		'Last Name'=>'lname',

		'Email'=>'email',

		array('value' => $model->location_id, 'label' => 'City'),
		array('value' => $model->state_id, 'label' => 'State'),

		'Zip Code'=>'zip',

		'Address'=>'userStores.address',

		'Address2'=>'userStores.address2',

		'Store Name'=>'userStores.name',

		'Website'=>'userStores.website',

		'cellphone',

	),

)); 



		}

		if(isset(Yii::app()->user->isBuyer) && !isset(Yii::app()->user->isSeller))

		{

	$this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'First Name'=>'fname',

		'Last Name'=>'lname',

		'Email'=>'email',
		array('value' => $model->location_id, 'label' => 'City'),
		array('value' => $model->state_id, 'label' => 'State'),
		
		'Zip Code'=>'zip',

		'cellphone',

	),

)); 



		}

		

		

		

		?>

</div>

