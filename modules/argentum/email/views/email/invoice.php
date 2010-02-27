<?=form::open()?>
<div id="invoice_email">
	<h2>Email Invoice #<?=$invoice->id?> To Client</h2>
	<p>Choose the contacts you want to send this invoice to below.</p>
	<h3>TO:</h3>
	<ul class="email_list">
	<?php foreach ($invoice->client->find_related('contacts') as $contact):?><li><?=form::checkbox(array('name' => 'contacts_to['.$contact->id.']', 'value' => $contact->id, 'id' => 'contacts_to_'.$contact->id))?> <label for="contacts_to_<?=$contact->id?>"><?=$contact->first_name.' '.$contact->last_name?> (<?=$contact->email?>)</label></li>
		<?php endforeach;?>
	</ul>
	<h3>CC:</h3>
	<ul class="email_list">
	<?php foreach ($invoice->client->find_related('contacts') as $contact):?><li><?=form::checkbox(array('name' => 'contacts_cc['.$contact->id.']', 'value' => $contact->id, 'id' => 'contacts_cc_'.$contact->id))?> <label for="contacts_cc_<?=$contact->id?>"><?=$contact->first_name.' '.$contact->last_name?> (<?=$contact->email?>)</label></li>
		<?php endforeach;?>
	</ul>
	<p><em>You can also BCC Argentum user accounts:</em></p>
	<h3>BCC:</h3>
	<ul class="email_list">
	<?php foreach (Auto_Modeler_ORM::factory('user')->fetch_all() as $user):?><li><?=form::checkbox(array('name' => 'users_bcc['.$user->id.']', 'value' => $user->id, 'id' => 'users_bcc_'.$user->id))?> <label for="users_bcc_<?=$user->id?>"><?=$user->first_name.' '.$user->last_name?> (<?=$user->email?>)</label></li>
		<?php endforeach;?>
	</ul>
</div>
<p><?=form::submit('send', 'Send Invoice')?></p>
</form>