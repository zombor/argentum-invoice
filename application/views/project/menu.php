<ul>
	<li><?=html::anchor('admin/project/edit/'.$project->id, 'Edit Project')?></li>
	<li><?=html::anchor('admin/ticket/add/'.$project->id, 'Create Ticket')?></li>
	<li><?=html::anchor('ticket/active/'.$project->id, 'View Active Tickets')?></li>
	<li><?=html::anchor('ticket/closed/'.$project->id, 'View Closed Tickets')?></li>
	<li><?=html::anchor('ticket/invoiced/'.$project->id, 'View Invoiced Tickets')?></li>
	<li><?=html::anchor('admin/non_hourly/add/'.$project->id, 'Add Non-Hourly')?></li>
	<li><?=html::anchor('non_hourly/view_project/'.$project->id, 'View Non-Hourly')?></li>
</ul>