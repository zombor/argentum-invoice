<?=form::open()?>
<div id="invoice_email">
	<h2>Email Invoice To Client</h2>
	<p>Choose the contacts you want to send this invoice to below.</p>
	<h3>TO:</h3>
	<div class="to_list">
	<?php foreach ($invoice->client->find_related('contacts') as $contact):?><p><?=form::checkbox('contacts_to['.$contact->id.']', $contact->id)?> <label for="contacts_to[<?=$contact->id?>]"><?=$contact->first_name.' '.$contact->last_name?></label></p>
		<?php endforeach;?>
	</div>
	<h3>CC:</h3>
	<div class="cc_list">
	<?php foreach ($invoice->client->find_related('contacts') as $contact):?><p><?=form::checkbox('contacts_cc['.$contact->id.']', $contact->id)?> <label for="contacts_cc[<?=$contact->id?>]"><?=$contact->first_name.' '.$contact->last_name?></label></p>
		<?php endforeach;?>
	</div>
	<h3>BCC:</h3>
	<div class="to_list">
	<?php foreach (Auto_Modeler_ORM::factory('user')->fetch_all() as $user):?><p><?=form::checkbox('users_bcc['.$user->id.']', $user->id)?> <label for="users_bcc[<?=$user->id?>]"><?=$user->first_name.' '.$user->last_name?></label></p>
		<?php endforeach;?>
	</div>
</div>
<p><?=form::submit('send', 'Send Invoice')?></p>
<?=form::close()?>