<h3>Receive Emails For:</h3>
<ul>
	<li><?=form::checkbox('email[ticket_create]', TRUE, $roles->ticket_create)?> <label for="email[ticket_create]">Ticket Creation</label></li>
	<li><?=form::checkbox('email[ticket_close]', TRUE, $roles->ticket_close)?> <label for="email[ticket_close]">Ticket Close</label></li>
	<li><?=form::checkbox('email[ticket_update]', TRUE, $roles->ticket_update)?> <label for="email[ticket_update]">Ticket Update</label></li>
	<li><?=form::checkbox('email[ticket_time]', TRUE, $roles->ticket_time)?> <label for="email[ticket_time]">Ticket Time Addition</label></li>
	<li><?=form::checkbox('email[project_create]', TRUE, $roles->project_create)?> <label for="email[project_create]">Project Creation</label></li>
	<li><?=form::checkbox('email[project_close]', TRUE, $roles->project_close)?> <label for="email[project_close]">Project Close</label></li>
</ul>