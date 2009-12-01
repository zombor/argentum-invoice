<h2><?=html::anchor('admin/client/edit/'.$client->short_name, 'Edit This Client')?></h2>
<h2>Client: <?=$client->company_name;?></h2>
<div id="client_details">
	<ul>
	<li><strong>Contact</strong> <?=$client->contact_full_name()?> (<?=html::mailto($client->email_address)?>)</li>
	<li><strong>Address</strong>
	<?=$client->mailing_address?><br />
	<?=$client->mailing_city, ',&nbsp;'.$client->mailing_state?><br />
	<?=$client->mailing_zip_code?>
	</li>
	<li><strong>Phone Number</strong> <?=$client->phone_number?></li>
	<li><strong>Tax Rate (%)</strong> <?=$client->tax_rate?></li>
	<li><strong>Currency</strong> <?=$client->currency->name?></li>
	</ul>
</div>
<div class="contact_list">
	<h2>Client Contacts</h2>
	<ul>
	<?php foreach ($client->find_related('contacts') as $contact):?><li><?=html::anchor('contact/view/'.$contact->id, $contact->first_name.' '.$contact->last_name.' - '.$contact->email)?></li>
	<?php endforeach;?>
	</ul>
	<h3><?=html::anchor('admin/contact/create', 'Create A New Contact')?></h3>
</div>