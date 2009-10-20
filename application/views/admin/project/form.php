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
	<li><label for="company_name">Company Name:</label> <input name="client[company_name]" value="<?=$client->company_name?>" id="company_name" /></li>
	<li><label for="contact_first_name">Contact First Name:</label> <input name="client[contact_first_name]" value="<?=$client->contact_first_name?>" id="contact_first_name" /></li>
	<li><label for="contact_last_name">Contact Last Name:</label> <input name="client[contact_last_name]" value="<?=$client->contact_last_name?>" id="contact_last_name" /></li>
	<li><label for="email_address">Email Address:</label> <input name="client[email_address]" value="<?=$client->email_address?>" id="email_address" /></li>
	<li class="clear"><label for="client_mailing_address">Mailing Address:</label><textarea name="client[mailing_address]" id="client_mailing_address"><?=$client->mailing_address?></textarea></li>
	<li><label for="mailing_city">Mailing City:</label> <input name="client[mailing_city]" value="<?=$client->mailing_city?>" id="mailing_city" /></li>
	<li><label for="mailing_state">Mailing State/Province:</label> <input name="client[mailing_state]" value="<?=$client->mailing_state?>" id="mailing_state" /></li>
	<li><label for="mailing_country">Mailing Country:</label> <input name="client[mailing_country]" value="<?=$client->mailing_country?>" id="mailing_country" /></li>
	<li><label for="mailing_zip_code">Mailing Zip Code:</label> <input name="client[mailing_zip_code]" value="<?=$client->mailing_zip_code?>" id="mailing_zip_code" /></li>
	<li><label for="phone_number">Phone Number:</label> <input name="client[phone_number]" value="<?=$client->phone_number?>" id="phone_number" /></li>
	<li><label for="tax_rate">Tax Rate:</label> <input name="client[tax_rate]" value="<?=$client->tax_rate?>" id="tax_rate" /></li>
	<li><label for="currency_id">Currency:</label> <?=form::dropdown('client[currency_id]', Auto_Modeler_ORM::factory('currency')->select_list('id', 'name'), $client->currency_id)?></li>
</ul>
</div>	
	<p style="clear: both;">&nbsp;</p>