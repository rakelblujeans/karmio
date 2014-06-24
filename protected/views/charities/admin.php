<?php
$this->breadcrumbs=array(
	'Charities'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Charities', 'url'=>array('index')),
	array('label'=>'Create Charities', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('charities-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
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

  <div class="t-deal">Charities</div>

 </div>

 <br />

<div class="rowleft">

<div class="headingcoupon"><!--Charity Control--></div>





</div><!--rowleft-->

<div class="rowcenterlong">

<form action="<?php echo CController::createUrl('admin'); ?>" name="" method="post" id="s-form">

 		<div style="color:#FF0000; font-size:9px" class="errs"></div>

       <input type="text" name="searching" id="searching" class="header-searchleft"  value="name" onfocus="if(this.value=='name')this.value='';" onblur="if(this.value=='')this.value='name';" />

	  



       <input type="button" name="" class="header-searchright" value="" onclick="submitform()" />



      </form>  

	  

</div><!--rowcenter-->



</div><!--postdealrow-->



<!-- search-form -->
<h1>Manage <?php echo $type?> Charities</h1>

<p>
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button', 'style' => 'color:#FFFFFF')).'|';
echo CHtml::link('Add Charity',CController::createUrl('create', array('type' => $type)) ,array('style' => 'color:#FFFFFF')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'charities-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'tag_line',
		'state',
		'ein',
		'type',
		/*'isupdated',
		
		'city',
		'cause',
		'category',
		'url',
		'type',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
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