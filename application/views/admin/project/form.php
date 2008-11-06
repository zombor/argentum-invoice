<h2><?=$title?> Project</h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="name">Project Name:</label> <?=form::input('project[name]', $project->name)?></li>
	<li><label for="client_id">Assigned Client:</label> <?=form::dropdown('project[client_id]', Auto_Modeler_ORM::factory('client')->select_list('id', 'company_name') + array('new' => 'New Client...'), $project->client_id)?></li>
	<li><label for="notes">Project Notes:</label><br /><?=form::textarea(array('name' => 'project[notes]', 'value' => $project->notes))?></li>
	<li><label for="taxable">Taxable</label><?=form::checkbox('taxable', TRUE, $project->taxable)?></li>
	<li><label for="complete">Complete</label><?=form::checkbox('complete', TRUE, $project->complete)?></li>
	<li><?=form::submit('submit', $title.' Project')?></li>
</ul>
<div id="new_client">
<h3>New Client Information</h3>
<ul>
	<li><label for="company_name">Company Name:</label> <?=form::input('client[company_name]', $client->company_name)?></li>
	<li><label for="contact_first_name">Contact First Name:</label> <?=form::input('client[contact_first_name]', $client->contact_first_name)?></li>
	<li><label for="contact_first_name">Contact Last Name:</label> <?=form::input('client[contact_last_name]', $client->contact_last_name)?></li>
	<li><label for="mailing_address">Mailing Address:</label><br /><?=form::textarea(array('name' => 'client[mailing_address]', 'value' => $client->mailing_address))?></li>
	<li><label for="mailing_city">Mailing City:</label> <?=form::input('client[mailing_city]', $client->mailing_city)?></li>
	<li><label for="mailing_state">Mailing State:</label> <?=form::input('client[mailing_state]', $client->mailing_state)?></li>
	<li><label for="mailing_zip_code">Mailing Zip Code:</label> <?=form::input('client[mailing_zip_code]', $client->mailing_zip_code)?></li>
	<li><label for="email_address">Email Address:</label> <?=form::input('client[email_address]', $client->email_address)?></li>
	<li><label for="phone_number">Phone Number:</label> <?=form::input('client[phone_number]', $client->phone_number)?></li>
	<li><label for="tax_exempt">Tax Rate:</label> <?=form::input('client[tax_rate]',$client->tax_rate)?></li>
</ul>
</div>
<?form::close()?>