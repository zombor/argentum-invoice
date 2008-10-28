<h1>View Client</h1>
<ul>
	<li>Company Name: <?=$client->company_name?></li>
	<li>Contact First Name: <?=$client->contact_first_name?></li>
	<li>Contact Last Name: <?=$client->contact_last_name?></li>
	<li>Mailing Address: <?=$client->mailing_address?></li>
	<li>Mailing City: <?=$client->mailing_city?></li>
	<li>Mailing State: <?=$client->mailing_state?></li>
	<li>Mailing Zip Code: <?=$client->mailing_zip_code?></li>
	<li>Email Address: <?=$client->email_address?></li>
	<li>Phone Number: <?=$client->phone_number?></li>
	<li>Tax Exempt: <?=$client->tax_exempt?></li>
</ul>
<h2><?=html::anchor('admin/client/edit/'.$client->short_name, 'Edit This Client')?></h2>