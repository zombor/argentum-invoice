<?php $total_hours = 0;
$total_cost = 0;
?><h2>View Active Tickets For <?=html::anchor('project/view/'.$project->id, 'Project ID '.$project->id.': '.$project->name)?></h2>
<?php include Kohana::find_file('views', 'project/menu')?>
<table class="tickets">
	<thead>
		<tr>
			<th>Ticket ID</th>
			<th>User</th>
			<th>Creation Date</th>
			<th>Description</th>
			<th>Operation</th>
			<th class="hours">Total Hours</th>
			<th class="hours">Total Cost</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=html::anchor('ticket/view/'.$ticket->id, $ticket->id, array('class' => 'colorbox'))?></td>
			<td><?=$ticket->user_id == NULL ? 'Unassigned' : $ticket->user->username?></td>
			<td><?=date('m/d/Y', $ticket->creation_date)?></td>
			<td><?=Markdown($ticket->description)?></td>
			<td><?=$ticket->operation_type_id ? $ticket->operation_type->name : ''?></td>
			<td class="hours"><?=$ticket->operation_type_id ? number_format($ticket->total_time, 2) : ''?></td>
			<td class="hours"><?=Auto_Modeler_ORM::factory('currency', Kohana::config('argentum.default_currency'))->symbol?> <?=number_format($ticket->operation_type_id ? $ticket->total_time*$ticket->rate : $ticket->rate, 2)?></td>
			<td><?=html::anchor('admin/time/add/'.$ticket->id, html::image(array('src' => 'images/icons/time_add.png', 'alt' => 'Add Time')), array('class' => 'add_time'))?> <?=html::anchor('admin/ticket/edit/'.$ticket->id, html::image(array('src' => 'images/icons/pencil.png', 'alt' => 'Edit Ticket')), array('class' => 'edit_ticket'))?> <?=html::anchor('admin/ticket/delete/'.$ticket->id, html::image(array('src' => 'images/icons/cross.png', 'alt' => 'Delete Ticket')), array('class' => 'delete_ticket colorbox'))?>
			    <?php Event::run('argentum.active_ticket_item_display', $ticket); $total_hours+=$ticket->total_time; $total_cost+=$ticket->operation_type_id ? $ticket->total_time*$ticket->rate : $ticket->rate?></td>
	</tr><?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"></td>
			<td colspan="2" class="hours"><strong>Total Hours: <?=number_format($total_hours, 2)?></strong></td>
			<td class="hours"><strong>Total Cost: <?=Auto_Modeler_ORM::factory('currency', Kohana::config('argentum.default_currency'))->symbol?> <?=number_format($total_cost, 2)?></strong></td>
			<td></td>
		</tr>
	</tfoot>
</table>