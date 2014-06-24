<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>

	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('location_id')); ?>:</b>

	<?php echo CHtml::encode($data->location_id); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>

	<?php echo CHtml::encode($data->fname); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>

	<?php echo CHtml::encode($data->lname); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>

	<?php echo CHtml::encode($data->email); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>

	<?php echo CHtml::encode($data->password); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:</b>

	<?php echo CHtml::encode($data->zip); ?>

	<br />



	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>

	<?php echo CHtml::encode($data->address); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>

	<?php echo CHtml::encode($data->phone); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('cellphone')); ?>:</b>

	<?php echo CHtml::encode($data->cellphone); ?>

	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>

	<?php echo CHtml::encode($data->status); ?>

	<br />



	*/ ?>



</div>