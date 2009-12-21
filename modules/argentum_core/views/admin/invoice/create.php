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
<h3>Invoice Due Date:</h3>
<p><input name="due_date" id="due_date" value="<?=date('m/d/Y', time()+(Kohana::config('argentum.default_invoice_net_days')*60*60*24))?>" /></p>
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
			<td><?=$ticket->operation_type_id ? number_format($ticket->total_time, 2) : ''?></td>
			<td><?=Auto_Modeler_ORM::factory('currency', Kohana::config('argentum.default_currency'))->symbol?> <?=number_format($ticket->rate, 2)?></td>
			<td><?=Auto_Modeler_ORM::factory('currency', Kohana::config('argentum.default_currency'))->symbol?> <?=number_format($ticket->operation_type_id ? $ticket->total_time*$ticket->rate : $ticket->rate, 2)?>
				<?php $total_cost+=$ticket->operation_type_id ? $ticket->total_time*$ticket->rate : $ticket->rate?></td>
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