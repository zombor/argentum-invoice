<h2>Add Time To Ticket ID <?=$this->uri->segment(4)?></h2>
<?=$errors?>
<?=form::open()?>
<ul>
	<li><label for="start_time">Start Time:</label> <?=form::input('start_time', isset($start_time) ? $start_time : $time->start_time)?></li>
	<li><label for="end_time">End Time:</label> <?=form::input('end_time', isset($end_time) ? $end_time : $time->end_time)?></li>
	<li><label for="ticket_complete">Ticket Complete:</label> <?=form::checkbox('ticket_complete', TRUE, isset($ticket_complete) ? $ticket_complete : FALSE)?></li>
	<li><?=form::submit('submit', 'Add Time')?></li>
</ul>
<?form::close()?>