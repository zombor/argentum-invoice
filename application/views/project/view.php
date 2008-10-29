<h1>View Project</h1>
<ul>
	<li><?=html::anchor('admin/project/edit/'.$project->id, 'Edit')?></li>
	<li><?=html::anchor('admin/ticket/add/'.$project->id, 'Create Ticket')?></li>
	<li><?=html::anchor('ticket/active/'.$project->id, 'View Active Tickets')?></li>
	<li><?=html::anchor('ticket/closed/'.$project->id, 'View Closed Tickets')?></li>
	<li><?=html::anchor('ticket/invoiced/'.$project->id, 'View Invoiced Tickets')?></li>
	<li><?=html::anchor('non_hourly/view_project/'.$project->id, 'View Non-Hourly')?>
</ul>
<ul>
	<li>Project Name: <?=$project->name?></li>
	<li>Project Client: <?=html::anchor('client/view/'.$project->client->short_name, $project->client->company_name)?></li>
	<li>Project Notes: <?=$project->notes?></li>
</ul>