<input type="hidden" name="project_id" id="project_id" value="<?=$project->id?>" />
<ul class="submenu clear">
	<li><?=html::anchor('admin/project/edit/'.$project->id, 'Edit Project', array('id' => 'edit_project'))?></li>
	<li><?=html::anchor('admin/ticket/add/'.$project->id, 'Create Ticket', array('id' => 'create_ticket'))?></li>
	<li><?=html::anchor('ticket/active/'.$project->id, 'View Active Tickets')?></li>
	<li><?=html::anchor('ticket/closed/'.$project->id, 'View Closed Tickets')?></li>
	<li><?=html::anchor('ticket/invoiced/'.$project->id, 'View Invoiced Tickets')?></li>
	<li><?=html::anchor('admin/non_hourly/add/'.$project->id, 'Add Non-Hourly', array('id' => 'add_nonhourly'))?></li>
	<li><?=html::anchor('non_hourly/view_project/'.$project->id, 'View Non-Hourly')?></li>
</ul>
