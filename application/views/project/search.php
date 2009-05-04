<h1>Search Results</h1>
<ul>
	<?php foreach ($results as $project):?><li><?=html::anchor('project/view/'.$project->id, $project->name)?>
	</li><?php endforeach?>
</ul>