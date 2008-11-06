<h2>Invoice Payments for Invoice ID <?=$invoice_id?></h2>
<table>
	<tbody>
		<tr>
			<th>Payment ID</th>
			<th>Payment Date</th>
			<th>Payment Amount</th>
			<th>Admin</th>
		</tr>
		<?php foreach ($invoice_payments as $payment):?><tr>
			<td><?=$payment->id?></td>
			<td><?=$payment->date?></td>
			<td><?=$payment->amount?></td>
			<td><?=form::open('admin/invoice/delete_payment', array(), array('payment_id' => $payment->id))?><?=form::submit('delete', 'Delete')?><?=form::close()?></td>
	</tr><?php endforeach;?>
	</tbody>
</table>