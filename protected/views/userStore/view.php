<style>.row{ padding:20px;}</style>
<div id="MainBody" class="FBGIMG">
    <div class="CenterAlign">
        <div class="HundredPercent">
         <div class="BForm">
         <div class="FormLeftSide">
        
		   <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'phone',
		'address',
		'address2',
		'zip',
		array('value' => $model->state_id, 'label' => 'State'),
		array('value' => $model->location_id, 'label' => 'City'),
	),
)); ?>
<div class="titlemain"><a href="<?php echo CController::createUrl('/userStore/update&id='.$model->id); ?>">Update</a></div>
          <!-- <div class="row"><label> <strong style="margin:10px;">Business Name: </strong>
           <?php echo $model->name; ?></label></div>
           <div class="row"><label> <strong style="margin:10px;">Address: </strong>
           <?php echo $model->address; ?></label></div>
           <div class="row"><label> <strong style="margin:10px;">Address 2: </strong>
           <?php echo $model->address2; ?></label></div>
            <div style="float:left; margin:0px 15px 0px 0px;">
           <div class="row"><label> <strong style="margin:10px;">City: </strong>
           <?php echo $model->location_id; ?></label></div>
            </div>
            <div style="float:left; margin:0px 15px 0px 0px;">
           <div class="row"><label> <strong style="margin:10px;">ST: </strong>
            <?php echo $model->state_id; ?></label></div>
            </div>
            <div style="">
           <div class="row"><label> <strong style="margin:10px;">Zip: </strong>
           <?php echo $model->zip; ?></label></div>
            </div>
           <div class="row"><label> <strong style="margin:10px;">Website: </strong>
            <?php echo $model->website; ?></label></div>-->
        </div>
     
        </div>
    </div>
</div>
</div>