<h2>Edit Ticket</h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="user_id">Assigned User:</label> <?=form::dropdown('user_id', array(NULL => 'Unassigned') + Auto_Modeler_ORM::factory('user')->select_list('id', 'username'), $ticket->user_id)?></li>
	<li><label for="description">Ticket Description:</label><br /><?=form::textarea(array('name' => 'description', 'value' => $ticket->description))?></li>
	<li><label for="operation_type_id">Operation:</label> <?=form::dropdown('operation_type_id', Auto_Modeler_ORM::factory('operation_type')->select_list('id', 'name'), $ticket->operation_type_id)?></li>
	<li><label for="rate">Rate:</label> <?=form::input('rate', $ticket->rate)?></li>
	<li><label for="billable">Billable:</label> <?=form::checkbox('billable', TRUE, $ticket->billable)?></li>
	<li><label for="complete">Complete:</label> <?=form::checkbox('complete', TRUE, $ticket->complete)?></li>
	<li><?=form::submit('submit', 'Update Ticket')?></li>
</ul>
<?form::close()?>