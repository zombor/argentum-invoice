<h2><?=html::anchor('admin/contact/edit/'.$contact->id, 'Edit This Contact')?></h2>
<h2>Contact Details</h2>
<ul class="contact_details">
	<li>Name: <?=$contact->first_name?> <?=$contact->last_name?></li>
	<li>Email: <?=html::mailto($contact->email, $contact->email)?></li>
</ul>
<h2>Associated Clients</h2>
<ul class="contact_clients">
	<?php foreach ($contact->find_parent('clients') as $client):?><li><?=html::anchor('client/view/'.$client->short_name, $client->company_name)?></li>
	<?php endforeach;?>
</ul>