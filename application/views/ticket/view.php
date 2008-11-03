<h2>View Ticket ID# <?=$ticket->id?></h2>
<p>Assigned to: <?=$ticket->user->username?></p>
<p>Operation: <?=$ticket->operation_type->name?></p>
<h3>Time</h3>
<table>
	<tbody>
		<tr>
			<th>Time ID</th>
			<th>User</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Total TIme</th>
		</tr>
		<?php foreach ($ticket->find_related('time') as $time):?><tr>
			<td><?=$time->id?></td>
			<td><?=$time->user->username?></td>
			<td><?=date('Y/m/d g:i A', $time->start_time)?></td>
			<td><?=date('Y/m/d g:i A', $time->end_time)?></td>
			<td><?=number_format(($time->end_time-$time->start_time)/60/60, 2)?></td>
	</tr><?php endforeach; ?>
	</tbody>
</table>