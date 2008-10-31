<h1>View All Invoices</h1>
<table>
	<tbody>
		<tr>
			<th>Invoice ID</th>
			<th>Client</th>
			<th>Total Income</th>
			<th>Total Paid</th>
		</tr>
		<?php foreach ($invoices as $invoice):?><tr>
			<td><?=html::anchor('invoice/view/'.$invoice->id, $invoice->id)?></td>
			<td><?=$invoice->client->company_name?></td>
			<td>$<?=number_format($invoice->total_income(), 2)?>
			<td>$<?=number_format($invoice->total_paid(), 2)?>
		<?php endforeach;?></tr>
	</tbody>
</table>