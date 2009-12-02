<h2>View Ticket ID# <?=$ticket->id?></h2>
<h3>Project: <?=html::anchor('project/view/'.$ticket->project->id, $ticket->project->name)?></h3>
<p>Assigned to: <?=$ticket->user_id == NULL ? 'Unassigned' : $ticket->user->username?></p>
<p>Operation: <?=$ticket->operation_type->name?></p>
<p>Description: <?=Markdown($ticket->description)?></p>
<h3>Time</h3>
<table>
	<tbody>
		<tr>
			<th>Time ID</th>
			<th>User</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Total TIme</th>
			<th>Admin</th>
		</tr>
		<?php foreach ($ticket->find_related('time') as $time):?><tr>
			<td><?=$time->id?></td>
			<td><?=$time->user->first_name?> <?=$time->user->last_name?></td>
			<td><?=date('Y/m/d g:i A', $time->start_time)?></td>
			<td><?=date('Y/m/d g:i A', $time->end_time)?></td>
			<td><?=number_format(($time->end_time-$time->start_time)/60/60, 2)?></td>
			<td><?=form::open('admin/time/delete', NULL, array('id' => $time->id))?><?=form::input(array('src' => url::base().'images/icons/cross.png', 'alt' => 'Delete Time', 'type' => 'image'))?><?=form::close()?></td>
	</tr><?php endforeach; ?>
	</tbody>
</table>