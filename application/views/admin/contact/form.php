<div id="contact_form">
	<h2><?=$title?> Contact</h2>
	<?=$errors?>
	<?=form::open()?>
	<ul>
		<li><label for="first_name">First Name:</label> <?=form::input('first_name', $contact->first_name)?></li>
		<li><label for="last_name">Last Name:</label> <?=form::input('last_name', $contact->last_name)?></li>
		<li><label for="email">Email Address:</label> <?=form::input('email', $contact->email)?></li>
		<li><label for="project_client_id">Assigned Clients:</label><br />
			<?php foreach ($clients as $client):?><?=form::checkbox('client['.$client->id.']', $client->id, $contact->belongs_to('clients', $client->id))?> <?=$client->company_name?><br />
			<?php endforeach; ?>
		<li><?=form::submit('submit', $title.' Contact')?></li>
	</ul>
</div>