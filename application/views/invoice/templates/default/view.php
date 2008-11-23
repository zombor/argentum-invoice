<?php
/**
 * Invoice Default View
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 *
 * @property object $invoice Main Invoice Object
 */
?>
<?php
	$subtotal = 0;
?>
<style type="text/css">
	#invoice .client {
		width: 25%;
	}

	#invoice table {
		width: 99%;
		margin-top: 2em;
		border: 1px solid black;
	}

	#invoice th {
		font-weight: bold;
		border-bottom: 1px solid black;
	}

	#invoice tr.uneven {
		background-color: #CCC;
	}

	#invoice tr.subtotal td {
		border-top: 3px dashed black;
	}

	#invoice .total td {
		font-weight: bold;
		border-top: 2px solid black;
	}

	#billing_client {
		width: 99%;
		border: none;
	}

	#billing_client .client {
		width: 25%;
	}
</style>
<div id="invoice">
	<h2>Invoice #<?=$invoice->id?> - <?=date('Y/m/d', $invoice->date)?></h2>
	<table id="billing_client">
		<tbody>
			<tr>
				<td class="company">
					Remit Payment To: <?=Kohana::config('argentum.company_name')?><br />
					<?=Kohana::config('argentum.company_address')?><br />
					<?=Kohana::config('argentum.company_city')?>, <?=Kohana::config('argentum.company_state')?> <?=Kohana::config('argentum.company_zip')?>
				</td>
				<td class="client">
					Attn: <?=$invoice->client->contact_first_name?> <?=$invoice->client->contact_last_name?><br />
					<?=$invoice->client->company_name?><br />
					<?=$invoice->client->mailing_address?><br />
					<?=$invoice->client->mailing_city?>, <?=$invoice->client->mailing_state?> <?=$invoice->client->mailing_zip?>
				</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<th>Hours/Quantity</th>
				<th>Operation/Description</th>
				<th>Hourly Rate</th>
				<th>Total Cost</th>
			</tr>
			<?php foreach ($invoice->find_operation_types() as $operation_type_id => $operation_type):?><tr class="<?=text::alternate('even', 'uneven')?>">
			<?php $subtotal+=($operation_type['rate']*$operation_type['time'])?>
<td><?=number_format($operation_type['time'], 2)?></td>
				<td><?=$operation_type['name']?></td>
				<td>$<?=number_format($operation_type['rate'], 2)?></td>
				<td>$<?=number_format(($operation_type['rate']*$operation_type['time']), 2)?></td>
			</tr><?php endforeach;?>
			<?php foreach ($invoice->find_related('non_hourly') as $non_hourly):?><tr>
			<?php $subtotal+=$non_hourly->cost?>
				<td><?=$non_hourly->quantity?></td>
				<td><?=$non_hourly->description?></td>
				<td>N/A</td>
				<td>$<?=number_format($non_hourly->cost, 2)?></td>
			<?php endforeach;?></tr>
			<tr class="subtotal">
				<td colspan="2"></td>
				<td>Subtotal</td>
				<td>$<?=number_format($subtotal, 2)?></td>
			</tr>
			<tr class="tax">
				<td colspan="2"></td>
				<td>Sales Tax</td>
				<td>$<?=number_format($invoice->find_sales_tax(), 2)?></td>
			</tr>
			<tr class="total">
				<td colspan="2"></td>
				<td>Grand Total</td>
				<td>$<?=number_format($subtotal+$invoice->find_sales_tax(), 2)?></td>
			</tr>
		</tbody>
	</table>
</div>
<h3><?=html::anchor('invoice/view_pdf/'.$invoice->id, 'Download PDF', array('class' => 'download_pdf'))?></h3>