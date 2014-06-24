<?php

$this->breadcrumbs=array(

	'User Purchases'=>array('index'),

	'Manage',

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('user-purchase-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>

 <div id="postdealrow">

<?php $this->renderPartial('/seller/admin_menu');?>


</div>

 <div id="postdealrow">



<div class="current-deals"><div style=" color: #FFFFFF; float: left;font-size: 23px;margin-left: 19px;width: 500px;">User's Deal Purchase List</div></div>





 <?php $this->renderPartial('_search',array(

	'model'=>$model,

)); 

?>

</div>

 <div id="postdealrow">

<div class="export">

<?php echo CHtml::link('Export List',array('UserPurchase/Downloadpdf','id'=>$model->product_id)); ?>

</div>

<br />



<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'user-purchase-grid',

	'dataProvider'=>$model->search(),

	'columns'=>array(

		'user.fname',

		'user.lname',

		'user.email',

		'user.cellphone',

		'product.name',

		'product.couponcode',

		'Coupon Code'=>'invoice_id',

		'collection_date',

		array(

		'header'=>'Credit Card',

		'value' => 'substr($data->getcard(),-4)',

		),





		/*

		'transaction_id',

		'transaction_status',

		'consumption_status',

		'expiry_date',

		'collection_date',

		'paid_price',

		'donated',

		'quantity',

		*/

		/*array(

			'class'=>'CButtonColumn',

		),*/

	),

)); ?>



</div>