<h2>Project: <?=$project->name?></h2>
<?php include Kohana::find_file('views', 'project/menu')?>
<h3>Project Details</h3>
<ul class="project_details">
	<li>Project Name: <?=$project->name?></li>
	<li>Project Client: <?=html::anchor('client/view/'.$project->client->short_name, $project->client->company_name)?></li>
	<li>Project Notes: <?=$project->notes?></li>
</ul>
<?php Event::run('argentum.project_display', $project)?>