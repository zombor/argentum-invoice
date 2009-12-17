<div id="ticket_form">
	<h2>Edit Ticket For Project ID <?=$ticket->project->id?></h2>
	<?=$errors?>
	<?=form::open()?>
	<ul>
		<li><label for="user_id">Assigned User:</label> <?=form::dropdown('user_id', array(NULL => 'Unassigned') + Auto_Modeler_ORM::factory('user')->select_list('id', 'username'), $ticket->user_id)?></li>
		<li><label for="rate">Item Cost:</label> <?=form::input('rate', $ticket->rate)?></li>
		<li><label for="billable">Billable:</label> <?=form::checkbox('billable', TRUE, $ticket->billable)?></li>
		<li><label for="complete">Complete:</label> <?=form::checkbox('complete', TRUE, $ticket->complete)?></li>
		<li><label for="description">Ticket Description:</label><br /><?=form::textarea(array('name' => 'description', 'value' => $ticket->description))?></li>
		<li><?=form::submit('submit', 'Update Ticket')?></li>
	</ul>
	<?form::close()?>
</div>