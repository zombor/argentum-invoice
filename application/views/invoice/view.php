<?php 
	$subtotal = 0;
?>
<h1>Invoice</h1>
<p>Attn: <?=$invoice->client->contact_first_name?> <?=$invoice->client->contact_last_name?><br />
<?=$invoice->client->company_name?><br />
<?=$invoice->client->mailing_address?><br />
<?=$invoice->client->mailing_city?>, <?=$invoice->client->mailing_state?> <?=$invoice->client->mailing_zip?></p>
<table>
	<tbody>
		<tr>
			<th>Hours/Quantity</th>
			<th>Operation/Description</th>
			<th>Hourly Rate</th>
			<th>Total Cost</th>
		</tr>
		<?php foreach ($invoice->find_operation_types() as $operation_type_id => $operation_type):?><tr>
		<?php $subtotal+=($operation_type['rate']*$operation_type['time'])?>
			<td><?=number_format($operation_type['time'], 2)?></td>
			<td><?=$operation_type['name']?></td>
			<td>$<?=number_format($operation_type['rate'], 2)?></td>
			<td>$<?=number_format(($operation_type['rate']*$operation_type['time']), 2)?></td>
		<?php endforeach;?></tr>
		<?php foreach ($invoice->find_related('non_hourly') as $non_hourly):?><tr>
		<?php $subtotal+=$non_hourly->cost?>
			<td><?=$non_hourly->quantity?></td>
			<td><?=$non_hourly->description?></td>
			<td>N/A</td>
			<td>$<?=number_format($non_hourly->cost, 2)?></td>
		<?php endforeach;?></tr>
		<tr>
			<td colspan="2"></td>
			<td>Subtotal</td>
			<td>$<?=number_format($subtotal, 2)?></td>
		</tr>
	</tbody>
</table>