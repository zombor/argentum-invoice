<?php
/**
 * Invoice Post Payment View
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 *
 * @property int    $invoice_id ID of the invoice to post payment for
 * @property array  $errors array of validation errors
 * @property object $invoice_payment the invoice payment object
 */
?>
<h2>Post Payment For Invoice ID <?=$invoice_id?></h2>
<?=form::open('admin/invoice/post_payment/'.$invoice_id, array(), array('invoice_id' => $invoice_id))?>
<?=$errors?>
<ul>
	<li><label for="amount">Payment Amount:</label> <?=form::input('amount', $invoice_payment->amount)?></li>
	<li><label for="date">Payment Date</label> <?=form::input('date', $invoice_payment->date)?></li>
	<li><?=form::submit('submit', 'Enter Payment')?></li>
</ul>
<?=form::close()?>