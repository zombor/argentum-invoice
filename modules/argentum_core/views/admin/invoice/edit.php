<h2>Edit Invoice #<?=$invoice->id?></h2>
<?=form::open()?>
	<?php if (count($invoice->find_related('tickets'))):?><h3>Invoice Details</h3>
	<ul>
		<li><label for="title">Title:</label> <input name="title" id="title" value="<?=$invoice->title?>" /></li>
		<li><label for="comments">Comments:</label> <textarea name="comments" id="comments"><?=$invoice->title?></textarea></li>
		<li><label for="currency_id">Currency:</label> <?=form::dropdown('currency_id', Auto_Modeler_ORM::factory('currency')->select_list('id', 'name'), $invoice->currency_id)?></li>
		<li><label for="conversion_rate">Conversion Rate:</label> <input name="conversion_rate" id="conversion_rate" value="<?=$invoice->conversion_rate?>" /></li>
	</ul>
	<h3 style="clear: both;">Unbill Tickets</h3>
	<table id="invoice_form">
		<thead>
			<tr>
				<th>Un-Bill</th>
				<th>Ticket ID</th>
				<th>Assigned To</th>
				<th>Description</th>
				<th>Time</th>
				<th>Rate</th>
				<th>Ticket Total Cost</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($invoice->find_related('tickets') as $ticket):?><tr>
				<td><?=form::checkbox(array('name' => 'tickets['.$ticket->id.']', 'value' => $ticket->id, 'rel' => $ticket->total_time*$ticket->rate))?></td>
				<td><?=$ticket->id?></td>
				<td><?=$ticket->user == NULL ? 'Unassigned' : $ticket->user->username ?></td>
				<td><?=$ticket->description?></td>
				<td><?=number_format($ticket->total_time, 2)?></td>
				<td>$<?=number_format($ticket->rate, 2)?></td>
				<td>$<?=number_format($ticket->total_time*$ticket->rate, 2)?></td>
			</tr><?php endforeach;?> 
		</tbody>
	</table><?php endif;?> 
	<?php if (count($invoice->find_related('non_hourly'))):?><h3>Unbill Non-Hourly Items</h3>
	<table id="invoice_form">
		<thead>
			<tr>
				<th>Un-Bill</th>
				<th>Nonhourly ID</th>
				<th colspan="3">Description</th>
				<th>Quantity</th>
				<th>Cost</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($invoice->find_related('non_hourly') as $non_hourly):?><tr>
				<td><?=form::checkbox(array('name' => 'non_hourly['.$non_hourly->id.']', 'value' => $non_hourly->id, 'rel' => $non_hourly->cost))?></td>
				<td><?=$non_hourly->id?></td>
				<td colspan="3"><?=$non_hourly->description?></td>
				<td><?=$non_hourly->quantity?></td>
				<td>$<?=number_format($non_hourly->cost, 2)?></td>
			</tr><?php endforeach;?> 
		</tbody>
	</table><?php endif;?> 
	<p><input type="submit" value="Edit Invoice" /></p>
</form>