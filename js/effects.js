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

	$('#jqmodal_window').jqm({
		trigger: false,
		onHide:  function(hash) {
			hash.w.fadeOut('2000',function(){ hash.o.remove(); });
			$("#jqmodal_window .content").html('Please wait... <img src="/images/busy.gif" alt="loading" />');
			window.location.reload();
		}
	});

	$('#create_ticket, #add_nonhourly, .edit_ticket, .add_time').click(function() {
		$('#jqmodal_window').jqmShow();
		$.ajax({ type: "GET",
		         url: $(this).attr('href'),
		         dataType: "html",
		         success: function(r) { $("#jqmodal_window .content").html(r); },
		         error: function(r) { alert(r); }
		});
		return false;
	});
	
	$('#ticket_form form').livequery('submit', function() {
		// Submit the form with ajax
		$(this).ajaxSubmit({
			target: '#jqmodal_window .content'
		});
		return false;
	});
});

function processJson(data) {
	alert(data.message);
	window.location.reload();
}