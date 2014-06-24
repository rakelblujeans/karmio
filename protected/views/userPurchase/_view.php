<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_id')); ?>:</b>
	<?php echo CHtml::encode($data->store_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_method')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_id')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_status')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consumption_status')); ?>:</b>
	<?php echo CHtml::encode($data->consumption_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collection_date')); ?>:</b>
	<?php echo CHtml::encode($data->collection_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paid_price')); ?>:</b>
	<?php echo CHtml::encode($data->paid_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donated')); ?>:</b>
	<?php echo CHtml::encode($data->donated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	*/ ?>

</div>