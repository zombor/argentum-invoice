<h1>View Active Tickets For <?=html::anchor('project/view/'.$this->uri->segment(3), 'Project ID '.$this->uri->segment(3))?></h1>
<table>
	<tbody>
		<tr>
			<th>Ticket ID</th>
			<th>User</th>
			<th>Creation Date</th>
			<th>Description</th>
			<th>Total Time</th>
			<th>Actions</th>
		</tr>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=$ticket->id?></td>
			<td><?=$ticket->user->username?></td>
			<td><?=date('m/d/Y', $ticket->creation_date)?></td>
			<td><?=$ticket->description?></td>
			<td></td>
			<td><?=html::anchor('time/add/'.$ticket->id, html::image(array('src' => 'images/icons/plus.png', 'alt' => 'Add Time')))?> <?=html::anchor('admin/ticket/edit/'.$ticket->id, html::image(array('src' => 'images/icons/pencil.png', 'alt' => 'Edit Ticket')))?></td>
	</tr><?php endforeach;?>
	</tbody>
</table>