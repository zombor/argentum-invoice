<h2>Client: <?=$client->company_name;?></h2>

<div id="client_details">
	<ul>
	<li><strong>Contact</strong> <?=$client->contact_full_name()?> (<?=html::mailto($client->email_address)?>)</li>
	<li><strong>Address</strong>
	<?=$client->mailing_address?><br />
	<?=$client->mailing_city, $client->mailing_state?> 
	<?=$client->mailing_zip_code?>
	</li>
	<li><strong>Phone Number</strong> <?=$client->phone_number?></li>
	<li><strong>Tax Rate</strong> <?=$client->tax_rate?></li>
	</ul>
</div>
<h2><?=html::anchor('admin/client/edit/'.$client->short_name, 'Edit This Client')?></h2>