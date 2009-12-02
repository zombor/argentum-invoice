<?php
/**
 * Invoice Create View
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 *
 * @property object $client Client Model Object
 * @property array  $template array of available invoice templates
 * @property array  $projects array of project tickets and non-hourly items 
 */

 $total_cost = 0;
?>
<h2>Create Invoice For <?=$client->company_name?></h2>
<?=form::open('admin/invoice/create')?>
<?=form::hidden('client_id', $client->id)?>
<h3>Invoice Comments:</h3>
<p><?=form::textarea('comments')?></p>
<h3>Invoice Currency:</h3>
<p><?=form::dropdown('currency_id', Auto_Modeler_ORM::factory('currency')->select_list('id', 'name'), $client->currency_id)?></p>
<h3>Invoice Template:</h3>
<p><?=form::dropdown('template_name', $templates)?></p>
<h3>Tickets to be billed:</h3>
<table id="invoice_form">
	<thead>
		<tr>
			<th>Bill</th>
			<th>Ticket ID</th>
			<th>Assigned To</th>
			<th>Description</th>
			<th>Time</th>
			<th>Rate</th>
			<th>Ticket Total Cost</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($projects['tickets'] as $project_id => $tickets):?><tr>
			<th colspan="7" class="project">Project: <?=Auto_Modeler_ORM::factory('project', $project_id)->name?></th>
		</tr>
		<?php foreach ($tickets as $ticket):?><tr>
			<td><?=form::checkbox(array('name' => 'tickets['.$ticket->id.']', 'value' => $ticket->id, 'checked' => TRUE, 'rel' => $ticket->total_time*$ticket->rate))?></td>
			<td><?=$ticket->id?></td>
			<td><?=$ticket->user == NULL ? 'Unassigned' : $ticket->user->username ?></td>
			<td><?=$ticket->description?></td>
			<td><?=number_format($ticket->total_time, 2)?></td>
			<td>$<?=number_format($ticket->rate, 2)?></td>
			<td>$<?=number_format($ticket->total_time*$ticket->rate, 2)?><?php $total_cost+=$ticket->total_time*$ticket->rate?></td>
		</tr><?php endforeach;?>
		<?php endforeach;?>
		<tr>
			<td colspan="7"><h3>Non-hourly to be billed:</h3></td>
		</tr>
		<tr>
			<th>Bill</th>
			<th>Nonhourly ID</th>
			<th colspan="3">Description</th>
			<th>Quantity</th>
			<th>Cost</th>
		</tr>
		<?php foreach ($projects['non_hourly'] as $project_id => $non_hourlies):?><tr>
			<th colspan="7" class="project">Project: <?=Auto_Modeler_ORM::factory('project', $project_id)->name?></th>
		</tr>
		<?php foreach ($non_hourlies as $non_hourly):?><tr>
			<td><?=form::checkbox(array('name' => 'non_hourly['.$non_hourly->id.']', 'value' => $non_hourly->id, 'checked' => TRUE, 'rel' => $non_hourly->cost))?></td>
			<td><?=$non_hourly->id?></td>
			<td colspan="3"><?=$non_hourly->description?></td>
			<td><?=$non_hourly->quantity?></td>
			<td>$<?=number_format($non_hourly->cost, 2)?><?php $total_cost+=$non_hourly->cost?></td>
		</tr><?php endforeach;?>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7" class="project"><h3>Totals</h3></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td><strong>$<span class="total_cost"><?=number_format($total_cost, 2)?></span></strong></td>
		</tr>
	</tfoot>
</table>
<p><input type="submit" value="Create Invoice" <?php if ( ! count($projects['tickets']) AND ! count($projects['non_hourly'])):?>disabled="disabled" <?php endif;?>/></p>
<?=form::close()?>