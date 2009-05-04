<div id="live_timer_window">
	<div id="timer_status_box">
		<h1>Timer is</h1>
		<h2 class="timer_status"></h2>
	</div>
	<h1>Project:</h1>
	<p><?=form::dropdown('project_id', array('--' => '- Choose A Project -') + $projects)?></p>
	<h1>Ticket</h1>
	<p><?=form::dropdown('ticket_id', array('--' => '--'))?></p>
	<p><input type="image" name="start" id="start_stop" src="<?=url::site()?>live_timer/image/clock_error.png" disabled="disabled" /></p>
</div>