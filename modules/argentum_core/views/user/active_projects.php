<h2>My Active Projects</h2>
<ul>
	<?php foreach($projects as $project):?><li><?=html::anchor('project/view/'.$project->id, $project->id.': '.$project->name)?> - <?=count($project->find_related('tickets', array('complete' => 0)));?> Active Tickets</li>
<?php endforeach;?>
</ul>