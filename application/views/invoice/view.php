<?php 
	$total_cost = 0;
?>
<h1>Invoice</h1>
<p>Attn: <?=$invoice->client->contact_first_name?> <?=$invoice->client->contact_last_name?><br />
<?=$invoice->client->company_name?><br />
<?=$invoice->client->mailing_address?><br />
<?=$invoice->client->mailing_city?>, <?=$invoice->client->mailing_state?> <?=$invoice->client->mailing_zip?></p>
<table>
	<tbody>
		<tr>
			<th>Hours</th>
			<th>Operation</th>
			<th>Hourly Rate</th>
			<th>Total Cost</th>
		</tr>
		<?php foreach ($invoice->find_related('tickets') as $ticket):?><tr>
		<?php $total_cost+=($ticket->operation_type->rate*$ticket->total_time)?>
			<td><?=number_format($ticket->total_time, 2)?></td>
			<td><?=$ticket->operation_type->name?></td>
			<td>$<?=number_format($ticket->operation_type->rate, 2)?></td>
			<td>$<?=number_format($ticket->operation_type->rate*$ticket->total_time, 2)?></td>
		<?php endforeach;?></tr>
		<tr>
			<td colspan="3"></td>
			<td>$<?=number_format($total_cost, 2)?></td>
		</tr>
	</tbody>
</table>