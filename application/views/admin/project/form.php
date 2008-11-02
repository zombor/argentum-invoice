<h2><?=$title?> Project</h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="name">Project Name:</label> <?=form::input('name', $project->name)?></li>
	<li><label for="client_id">Assigned Client:</label> <?=form::dropdown('client_id', Auto_Modeler_ORM::factory('client')->select_list('id', 'company_name'), $project->client_id)?></li>
	<li><label for="notes">Project Notes:</label><br /><?=form::textarea(array('name' => 'notes', 'value' => $project->notes))?></li>
	<li><?=form::submit('submit', $title.' Project')?></li>
</ul>
<?form::close()?>