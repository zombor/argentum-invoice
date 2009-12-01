<?php
/**
 * Subview view for project list
 *
 * @var $projects  Array of projects
 */
?>
<ul id="project_list">
	<?php foreach ($projects as $project):?> 
	<li><a href="<?=url::site('project/view/'.$project->id);?>">
		<div class="task_count">ACTIVE TICKETS: <strong><?=count($project->find_related('tickets', array('complete' => 0)));?></strong></div>
		<div class="project_id">ID: <?=$project->id?></div>
		<div class="client"><?=$project->client->company_name?></div>
		<div class="name"><?=$project->name?></div>
	</a></li>
	<?php endforeach?>
</ul>