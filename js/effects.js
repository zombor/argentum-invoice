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
});