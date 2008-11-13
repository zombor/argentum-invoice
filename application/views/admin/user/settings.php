<h2>User Settings</h2>
<?php if (is_bool($status) AND $status):?><h3>Changes were successful</h3>
<?php elseif (is_bool($status) AND ! $status):?><h3>Please see the errors below:</h3><?php endif;?>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="first_name">First Name</label> <?=form::input('first_name', $user->first_name)?></li>
	<li><label for="last_name">Last Name</label> <?=form::input('last_name', $user->last_name)?></li>
	<li><label for="email">Email</label> <?=form::input('email', $user->email)?></li>
</ul>
<h3>Receive Emails For:</h3>
<ul>
	<li><?=form::checkbox('email_ticket_create', TRUE, $user->email_ticket_create)?> <label for="email_ticket_create">Ticket Creation</label></li>
	<li><?=form::checkbox('email_ticket_close', TRUE, $user->email_ticket_close)?> <label for="email_ticket_close">Ticket Close</label></li>
	<li><?=form::checkbox('email_ticket_update', TRUE, $user->email_ticket_update)?> <label for="email_ticket_update">Ticket Update</label></li>
	<li><?=form::checkbox('email_ticket_time', TRUE, $user->email_ticket_time)?> <label for="email_ticket_time">Ticket Time Addition</label></li>
	<li><?=form::checkbox('email_project_creation', TRUE, $user->email_project_creation)?> <label for="email_project_creation">Project Creation</label></li>
	<li><?=form::checkbox('email_project_close', TRUE, $user->email_project_close)?> <label for="email_project_close">Project Close</label></li>
</ul>
<p><?=form::submit('save', 'Save Settings')?></p>
<?=form::close()?>