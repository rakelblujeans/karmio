<?php



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('user-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div id="postdealrow">

<?php $this->renderPartial('/seller/admin_menu');?>

</div>











<div id="postdealrow">

 <div class="current-deals">

  <div class="t-deal">Users</div>

 </div>

 <br />

<div class="rowleft">

<div class="headingcoupon">User Control</div>





</div><!--rowleft-->

<div class="rowcenterlong">

<form action="<?php echo CController::createUrl('admin'); ?>" name="" method="post" id="s-form">

 		<div style="color:#FF0000; font-size:9px" class="errs"></div>

       <input type="text" name="searching" id="searching" class="header-searchleft"  value="first name, last name, email, zip , address" onfocus="if(this.value=='first name, last name, email, zip , address')this.value='';" onblur="if(this.value=='')this.value='first name, last name, email, zip , address';" />

	  



       <input type="button" name="" class="header-searchright" value="" onclick="submitform()" />



      </form>  

	  

</div><!--rowcenter-->



</div><!--postdealrow-->



<!-- search-form -->

<div id="postdealrow">

<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'user-grid',

	'dataProvider'=>$model->search(),

	//'filter'=>$model,

	'columns'=>array(

		'fname',

		'lname',

		'email',

		'cellphone',

		'zip',

		array(

		'header'=>'Posted Deals',

		'type'=>'raw',

		'value' => '($data->getPosted()) == 0 ? $data->getPosted() : CHtml::link($data->getPosted(),Yii::app()->createUrl("product/userPosted",array("id"=>$data->id)))',



		//'CHtml::link($data->getPosted(),Yii::app()->createUrl("product/userPosted",array("id"=>$data->id)))',

		),

		array(

		'header'=>'Purchased Deals',

		'type'=>'raw',

		'value' => '($data->getPurchase()) == 0 ? $data->getPurchase() : CHtml::link($data->getPurchase(),Yii::app()->createUrl("userPurchase/userPurchased",array("id"=>$data->id)))',



		//'CHtml::link($data->getPurchase(),Yii::app()->createUrl("userPurchase/userPurchased",array("id"=>$data->id)))',

		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{delete}',
			'buttons'=>array
			(
				'delete' => array
				(
				   'visible'=>'($data->isAdmin == false)&&($data->posted == 0)',
		
				)),

		),

		

	),

)); ?>

</div>

<script type="text/javascript">

function submitform()

{

var searching = $("#searching").val();

var errs = "";

var error= false;



if(searching == '' || searching=='first name, last name, email, zip , address')

{

error=true;

$("#searching").addClass('error');

errs += "Enter user information like name, email etc";

}



if(error == false){

		$("#s-form").submit();

	}else{

		$(".errs").html(errs);

	}



}

</script>

