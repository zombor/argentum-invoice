$(function() {
	$('#project_id').change(function()
	{
		$.ajax({
				type:    "POST",
				url:     "find_tickets.html",
				data:    "project_id="+$('#project_id option:selected').val(),
				success: function(html) { $('#ticket_id').html(html); }
		});
	});

	// Gets the timer status of the selected ticket id
	$('#ticket_id').livequery('change', function()
	{
		$.ajax({
				type:    "POST",
				url:     "find_ticket_status.html",
				data:    "ticket_id="+$('#ticket_id option:selected').val(),
				success: function(html) {
					if (html == 'ON')
					{
						var new_value = 'stop';
						$('.timer_status').html('Started on<br />Ticket ID: '+$('#ticket_id option:selected').val());
						$('input#start_stop').attr('src', 'image/clock_stop.png');
					}
					else
					{
						var new_value = 'start';
						$('.timer_status').html('STOPPED');
						$('input#start_stop').attr('src', 'image/clock_go.png');
					}

					$('input#start_stop').attr('name', new_value);
					$('input#start_stop').attr('disabled', '');
				}
		});
	});

	$('#start_stop').click(function()
	{
		$.ajax({
				type:    "GET",
				url:     $('input#start_stop').attr('name')+"/"+$('#ticket_id option:selected').val()+".html",
				success: function(r) {
					if ($('input#start_stop').attr('name') == 'start')
					{
						var new_value = 'stop';
						$('.timer_status').html('Started on<br />Ticket ID: '+$('#ticket_id option:selected').val());
						$('input#start_stop').attr('src', 'image/clock_stop.png');
					}
					else
					{
						var new_value = 'start';
						$('.timer_status').html('STOPPED');
						$('input#start_stop').attr('src', 'image/clock_go.png');
					}

					$('input#start_stop').attr('name', new_value);
				}
		});
	});

	$('a.live_timer_window').click(function()
	{
		myRef = window.open($(this).attr('href'),'live_timer','width=350,height=175,toolbar=0,resizable=0,menubar=0');
		return false;
	});
});