<h2>Current Active Timers</h2>
<table>
	<tbody>
		<tr>
			<th>Timer ID</th>
			<th>Owned By</th>
			<th>Project</th>
			<th>Ticket ID</th>
			<th>Start Time</th>
			<th>Total Time</th>
		</tr>
		<?php foreach($timers as $timer):?><tr>
			<td><?=$timer->id?></td>
			<td><?=$timer->user->first_name?> <?=$timer->user->last_name?></td>
			<td><?=$timer->ticket->project->name?></td>
			<td><?=$timer->ticket_id?></td>
			<td><?=date('Y/m/d g:i A', $timer->start_time)?></td>
			<td><?=number_format((time()-$timer->start_time)/60)?> Minutes</td>
		</tr><?php endforeach;?>
	</tbody>
</table>