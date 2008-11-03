<ul id="project-list">
	<?php foreach ($projects as $project):?> 
	<li><a href="<?=url::site('project/view/'.$project->id);?>">
		<div class="name"><?=$project->name?></div>
		<div class="task-count">ACTIVE TICKETS: <strong><?=$project->active_tickets;?></strong></div>
	</a></li>
	<?php endforeach?>
</ul>