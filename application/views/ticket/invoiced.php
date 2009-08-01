<h2>View Invoiced Tickets For <?=html::anchor('project/view/'.$project->id, 'Project ID '.$project->id.': '.$project->name)?></h2>
<?php include Kohana::find_file('views', 'project/menu')?>
<table class="tickets">
	<tbody>
		<tr>
			<th>Ticket ID</th>
			<th>User</th>
			<th>Creation Date</th>
			<th>Close Date</th>
			<th>Description</th>
			<th>Total Time</th>
			<th>Invoice ID</th>
		</tr>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=html::anchor('ticket/view/'.$ticket->id, $ticket->id)?></td>
			<td><?=$ticket->user_id == NULL ? 'Unassigned' : $ticket->user->username?></td>
			<td><?=date('m/d/Y', $ticket->creation_date)?></td>
			<td><?=date('m/d/Y', $ticket->close_date)?></td>
			<td><?=Markdown($ticket->description)?></td>
			<td><?=number_format($ticket->total_time, 2)?> Hours</td>
			<td><?=html::anchor('invoice/view/'.$ticket->invoice_id, $ticket->invoice_id)?></td>
	</tr><?php endforeach;?>
	</tbody>
</table>