<?=form::open(NULL, array('id' => 'invoice_email'))?>
<h2>Email Invoice To Client</h2>
<h3>Subject:</h3>
<p><input name="subject" id="subject" value="Invoice #<?=$invoice->id?>" /></p>
<p>Choose the contacts you want to send this invoice to below.</p>
<h3>TO:</h3>
<div class="to_list">
<?php foreach ($invoice->client->find_related('contacts') as $contact):?><p><?=form::checkbox(array('name' => 'contacts_to['.$contact->id.']', 'value' => $contact->id, 'class' => 'to'))?> <label for="contacts_to[<?=$contact->id?>]"><?=$contact->first_name.' '.$contact->last_name?></label></p>
	<?php endforeach;?>
</div>
<h3>CC:</h3>
<div class="cc_list">
<?php foreach ($invoice->client->find_related('contacts') as $contact):?><p><?=form::checkbox(array('name' => 'contacts_cc['.$contact->id.']', 'value' => $contact->id, 'class' => 'to'))?> <label for="contacts_cc[<?=$contact->id?>]"><?=$contact->first_name.' '.$contact->last_name?></label></p>
	<?php endforeach;?>
</div>
<h3>BCC:</h3>
<div class="to_list">
<?php foreach (Auto_Modeler_ORM::factory('user')->fetch_all() as $user):?><p><?=form::checkbox(array('name' => 'users_bcc['.$user->id.']', 'value' => $user->id, 'class' => 'to'))?> <label for="users_bcc[<?=$user->id?>]"><?=$user->first_name.' '.$user->last_name?></label></p>
	<?php endforeach;?>
</div>
<p><?=form::submit('send', 'Send Invoice')?></p>
<?=form::close()?>