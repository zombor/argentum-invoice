$(function() {
	// admin/projects/add
	// display new client form when "New client" is selected
	$('#project_client_id').change(function() {
		if ($(this).val() == 'new') {
			$("#new_client").fadeIn();
		} else {
			$("#new_client").fadeOut();
		}
	});

	$('#create_ticket, #add_nonhourly, .edit_ticket, .add_time, .view_ticket').colorbox();

	/*$('#ticket_form form').livequery('submit', function() {
		// Submit the form with ajax
		$(this).ajaxSubmit({
			target: '#colorbox #modalLoadedContent'
		});
		return false;
	});*/
});

function processJson(data) {
	alert(data.message);
	window.location.reload();
}