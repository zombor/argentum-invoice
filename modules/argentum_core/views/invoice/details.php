<h2>Invoice Details For Invoice #<?=$invoice->id?></h2>
<?php if (count($invoice->find_related('tickets'))):?><h3 style="clear: both;">Tickets</h3>
<table id="invoice_form">
	<thead>
		<tr>
			<th>Ticket ID</th>
			<th>Assigned To</th>
			<th>Description</th>
			<th>Time</th>
			<th>Rate</th>
			<th>Ticket Total Cost</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($invoice->find_related('tickets') as $ticket):?><tr>
			<td><?=$ticket->id?></td>
			<td><?=$ticket->user == NULL ? 'Unassigned' : $ticket->user->username ?></td>
			<td><?=$ticket->description?></td>
			<td><?=number_format($ticket->total_time, 2)?></td>
			<td>$<?=number_format($ticket->rate, 2)?></td>
			<td>$<?=number_format($ticket->total_time*$ticket->rate, 2)?></td>
		</tr><?php endforeach;?> 
	</tbody>
</table><?php endif;?> 
<?php if (count($invoice->find_related('non_hourly'))):?><h3>Non-Hourly Items</h3>
<table id="invoice_form">
	<thead>
		<tr>
			<th>Nonhourly ID</th>
			<th colspan="3">Description</th>
			<th>Quantity</th>
			<th>Cost</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($invoice->find_related('non_hourly') as $non_hourly):?><tr>
			<td><?=$non_hourly->id?></td>
			<td colspan="3"><?=$non_hourly->description?></td>
			<td><?=$non_hourly->quantity?></td>
			<td>$<?=number_format($non_hourly->cost, 2)?></td>
		</tr><?php endforeach;?> 
	</tbody>
</table><?php endif;?> 