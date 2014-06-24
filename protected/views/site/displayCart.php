<?php $this->pageTitle=Yii::app()->name; ?>

<table style="border:1px">
	<tr>
		<th>Name</th>
		<th width=15%>Unit Price</th>
		<th width=10%>Quantity</th>
		<th width=10%>Cost</th>
	</tr>
	<?php
		foreach($data as $row)
		{?>
	<tr>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['price']; ?></td>
		<td><?php echo $row['qty']; ?></td>
		<td><?php echo $row['cost']; ?></td>
	</tr>
		<?php } ?>
</table>
