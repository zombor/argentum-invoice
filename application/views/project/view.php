<h1>View Project</h1>
<ul>
	<li>Project Name: <?=$project->name?></li>
	<li>Project Client: <?=html::anchor('client/view/'.$project->client->short_name, $project->client->company_name)?></li>
	<li>Project Notes: <?=$project->notes?></li>
</ul>
<h2><?=html::anchor('admin/project/edit/'.$project->id, 'Edit This Project')?></h2>