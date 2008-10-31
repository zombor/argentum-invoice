<h1>Create Invoice For <?=$client->company_name?></h1>
<?=form::open('invoice/create')?>
<?=form::hidden('client_id', $client->id)?>
<h2>Invoice Comments:</h2>
<p><?=form::textarea('comments')?></p>
<h2>Tickets to be billed:</h2>
<table>
	<tbody>
		<tr>
			<th>Bill</th>
			<th>Ticket ID</th>
			<th>Assigned To</th>
			<th>Description</th>
			<th>Time</th>
			<th>Rate</th>
			<th>Ticket Total Cost</th>
		</tr>
		<?php foreach ($projects['tickets'] as $project_id => $tickets):?><tr>
			<th colspan="7"><?=Auto_Modeler_ORM::factory('project', $project_id)->name?></th>
		</tr>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=form::checkbox('tickets['.$ticket->id.']', $ticket->id, TRUE)?></td>
			<td><?=$ticket->id?></td>
			<td><?=$ticket->user->username?></td>
			<td><?=$ticket->description?></td>
			<td><?=number_format($ticket->total_time, 2)?></td>
			<td>$<?=number_format($ticket->operation_type->rate, 2)?></td>
			<td>$<?=number_format($ticket->total_time*$ticket->operation_type->rate, 2)?></td>
		</tr><?php endforeach;?>
		<?php endforeach;?>
		<tr>
			<td colspan="7">Non-Hourly</td>
		</tr>
		<tr>
			<th>Bill</th>
			<th>Nonhourly ID</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Cost</th>
		</tr>
		<?php foreach ($projects['non_hourly'] as $project_id => $non_hourlies):?><tr>
			<th colspan="7"><?=Auto_Modeler_ORM::factory('project', $project_id)->name?></th>
		</tr>
		<?php foreach ($non_hourlies as $non_hourly):?><tr>
			<td><?=form::checkbox('non_hourly['.$non_hourly->id.']', $non_hourly->id, TRUE)?></td>
			<td><?=$non_hourly->id?></td>
			<td><?=$non_hourly->description?></td>
			<td><?=$non_hourly->quantity?></td>
			<td><?=number_format($non_hourly->cost, 2)?></td>
		</tr><?php endforeach;?>
		<?php endforeach;?>
	</tbody>
</table>
<p><?=form::submit('create', 'Create Invoice')?></p>
<?=form::close()?>