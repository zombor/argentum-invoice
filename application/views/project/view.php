<h1>View Project</h1>
<?php include Kohana::find_file('views', 'project/menu')?>
<ul>
	<li>Project Name: <?=$project->name?></li>
	<li>Project Client: <?=html::anchor('client/view/'.$project->client->short_name, $project->client->company_name)?></li>
	<li>Project Notes: <?=$project->notes?></li>
</ul>