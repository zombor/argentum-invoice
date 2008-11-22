<h2>View Active Tickets For <?=html::anchor('project/view/'.$this->uri->segment(3), 'Project ID '.$this->uri->segment(3))?></h2>
<?php include Kohana::find_file('views', 'project/menu')?>
<table class="tickets">
	<tbody>
		<tr>
			<th>Ticket ID</th>
			<th>User</th>
			<th>Creation Date</th>
			<th>Description</th>
			<th>Operation</th>
			<th>Total Time</th>
			<th>Actions</th>
		</tr>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=html::anchor('ticket/view/'.$ticket->id, $ticket->id)?></td>
			<td><?=$ticket->user_id == NULL ? 'Unassigned' : $ticket->user->username?></td>
			<td><?=date('m/d/Y', $ticket->creation_date)?></td>
			<td><?=Markdown($ticket->description)?></td>
			<td><?=$ticket->operation_type->name?></td>
			<td><?=number_format($ticket->total_time, 2)?> Hours</td>
			<td><?=html::anchor('admin/time/add/'.$ticket->id, html::image(array('src' => 'images/icons/time_add.png', 'alt' => 'Add Time')), array('class' => 'add_time'))?> <?=html::anchor('admin/ticket/edit/'.$ticket->id, html::image(array('src' => 'images/icons/pencil.png', 'alt' => 'Edit Ticket')), array('class' => 'edit_ticket'))?> <?=form::open('admin/ticket/delete', NULL, array('id' => $ticket->id))?><?=form::input(array('src' => url::base().'images/icons/cross.png', 'alt' => 'Delete Ticket', 'type' => 'image'))?><?=form::close()?></td>
	</tr><?php endforeach;?>
	</tbody>
</table>