

<div id="project_form">
	<h2><?=$title?> Project</h2>
	<?=$errors?>
	<?=form::open()?>
	<ul>
		<li><label for="name">Project Name:</label> <?=form::input('project[name]', $project->name)?></li>
		<li><label for="project_client_id">Assigned Client:</label> 
		<?=form::dropdown(array('name' => 'project[client_id]',
								'id' => 'project_client_id'), array('--' => '-- Choose A Client --') + Auto_Modeler_ORM::factory('client')->select_list('id', 'company_name') + array('new' => 'New Client...'), $project->client_id)?></li>
  
		<li><label for="taxable">Taxable</label><?=form::checkbox('taxable', TRUE, $project->taxable)?></li>
		<li><label for="complete">Complete</label><?=form::checkbox('complete', TRUE, $project->complete)?></li>
		<li><label for="notes">Project Notes:</label><br />
			<?=form::textarea(array('name' => 'project[notes]', 
						'value' => $project->notes,
						'id' => "notes"))?></li>
		<li><?=form::submit('submit', $title.' Project')?></li>
	</ul>
	<?form::close()?>
</div>

<div id="new_client"<?php if ($project->client_id == 'new'):?> style="display:block;"<?php endif;?>>
<h4>New Client Information</h4>
<ul>
	<li><label for="company_name">Company Name:</label> <?=form::input('client[company_name]', $client->company_name)?></li>
	<li><label for="contact_first_name">Contact First Name:</label> <?=form::input('client[contact_first_name]', $client->contact_first_name)?></li>
	<li><label for="contact_first_name">Contact Last Name:</label> <?=form::input('client[contact_last_name]', $client->contact_last_name)?></li>
	<li><label for="email_address">Email Address:</label> <?=form::input('client[email_address]', $client->email_address)?></li>
	<li class="clear"><label for="client_mailing_address">Mailing Address:</label>
		<?=form::textarea(array('name' => 'client[mailing_address]', 
					'value' => $client->mailing_address,
					'id' => 'client_mailing_address'))?></li>
	<li><label for="mailing_city">Mailing City:</label> <?=form::input('client[mailing_city]', $client->mailing_city)?></li>
	<li><label for="mailing_state">Mailing State/Province:</label> <?=form::input('client[mailing_state]', $client->mailing_state)?></li>
	<li><label for="mailing_country">Mailing Country:</label> <?=form::input('client[mailing_country]', $client->mailing_country)?></li>
	<li><label for="mailing_zip_code">Mailing Zip Code:</label> <?=form::input('client[mailing_zip_code]', $client->mailing_zip_code)?></li>
	<li><label for="mailing_country">Mailing Country:</label> <?=form::input('mailing_country', $client->mailing_country)?></li>
	<li><label for="phone_number">Phone Number:</label> <?=form::input('client[phone_number]', $client->phone_number)?></li>
	<li><label for="tax_exempt">Tax Rate:</label> <?=form::input('client[tax_rate]',$client->tax_rate)?></li>
	<li><label for="currency_id">Currency:</label> <?=form::dropdown('client[currency_id]', Auto_Modeler_ORM::factory('currency')->select_list('id', 'name'), $client->currency_id)?></li>
</ul>
</div>