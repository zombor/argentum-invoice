<h2>Post Payment For Invoice ID <?=$invoice_id?></h2>
<?=form::open('admin/invoice/post_payment/'.$invoice_id, array(), array('invoice_id' => $invoice_id))?>
<?=$errors?>
<ul>
	<li><label for="amount">Payment Amount:</label> <?=form::input('amount', $invoice_payment->amount)?></li>
	<li><label for="date">Payment Date</label> <?=form::input('date', $invoice_payment->date)?></li>
	<li><?=form::submit('submit', 'Enter Payment')?></li>
</ul>
<?=form::close()?>