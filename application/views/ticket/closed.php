<h1>View Closed Tickets For <?=html::anchor('project/view/'.$this->uri->segment(3), 'Project ID '.$this->uri->segment(3))?></h1>
<?php include Kohana::find_file('views', 'project/menu')?>
<table>
	<tbody>
		<tr>
			<th>Ticket ID</th>
			<th>User</th>
			<th>Creation Date</th>
			<th>Close Date</th>
			<th>Description</th>
			<th>Total Time</th>
			<th>Actions</th>
		</tr>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=html::anchor('ticket/view/'.$ticket->id, $ticket->id)?></td>
			<td><?=$ticket->user_id == NULL ? 'Unassigned' : ?></td>
			<td><?=date('m/d/Y', $ticket->creation_date)?></td>
			<td><?=date('m/d/Y', $ticket->close_date)?></td>
			<td><?=$ticket->description?></td>
			<td><?=number_format($ticket->total_time, 2)?> Hours</td>
			<td><?=html::anchor('admin/ticket/edit/'.$ticket->id, html::image(array('src' => 'images/icons/pencil.png', 'alt' => 'Edit Ticket')))?></td>
	</tr><?php endforeach;?>
	</tbody>
</table>