<h2>Edit Client</h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="company_name">Company Name:</label> <?=form::input('company_name', isset($company_name) ? $company_name : $client->company_name)?></li>
	<li><label for="contact_first_name">Contact First Name:</label> <?=form::input('contact_first_name', isset($contact_first_name) ? $contact_first_name : $client->contact_first_name)?></li>
	<li><label for="contact_first_name">Contact Last Name:</label> <?=form::input('contact_last_name', isset($contact_last_name) ? $contact_last_name : $client->contact_last_name)?></li>
	<li><label for="mailing_address">Mailing Address:</label><br /><?=form::textarea(array('name' => 'mailing_address', 'value' => isset($company_name) ? $company_name : $client->mailing_address))?></li>
	<li><label for="mailing_city">Mailing City:</label> <?=form::input('mailing_city', isset($mailing_city) ? $mailing_city : $client->mailing_city)?></li>
	<li><label for="mailing_state">Mailing State:</label> <?=form::input('mailing_state', isset($mailing_state) ? $mailing_state : $client->mailing_state)?></li>
	<li><label for="mailing_zip_code">Mailing Zip Code:</label> <?=form::input('mailing_zip_code', isset($mailing_zip_code) ? $mailing_zip_code : $client->mailing_zip_code)?></li>
	<li><label for="email_address">Email Address:</label> <?=form::input('email_address', isset($email_address) ? $email_address : $client->email_address)?></li>
	<li><label for="phone_number">Phone Number:</label> <?=form::input('phone_number', isset($phone_number) ? $phone_number : $client->phone_number)?></li>
	<li><label for="tax_exempt">Tax Expemt:</label> <?=form::checkbox('tax_exempt', TRUE, isset($tax_exempt) ? $tax_exempt : $client->tax_exempt)?></li>
	<li><?=form::submit('submit', 'Update This Client')?></li>
</ul>
<?form::close()?>