$(document).ready(function() {
	// admin/projects/add
	// display new client form when "New client" is selected
	$('#project_client_id').change(function() {
		if ($(this).val() == 'new') {
			$("#new_client").fadeIn();
		} else {
			$("#new_client").fadeOut();
		}
	});

	$('#create_ticket, #add_nonhourly, .edit_ticket, .add_time, .view_ticket, .colorbox').colorbox();

	$('form#choose_invoice_client').submit(function()
	{
		if ($(this).find('#client_id').val() == '---')
		{
			alert('Please select a client!');
			return false;
		}
	});

	$("table.invoice_list").tablesorter();

	$('table#invoice_form input[type=checkbox]').click(function()
	{
		var total_cost = parseFloat($('span.total_cost').html());
		var this_cost = parseFloat($(this).attr('rel'));
		if ($(this).is(':checked'))
		{
			var total = total_cost+this_cost;
			$('span.total_cost').html(number_format(total, 2));
		}
		else
		{
			$('span.total_cost').html(number_format(total_cost-this_cost, 2));
		}
	});

	$('form#invoice_email').submit(function()
	{
		var checked = parseInt($(this).find('input.to:checked').size());
		if (checked == 0)
		{
			alert('You must select recipients.');
			return false;
		}
	});
});

function number_format (number, decimals, dec_point, thousands_sep)
{
	// Formats a number with grouped thousands
	//
	// version: 906.1806
	// discuss at: http://phpjs.org/functions/number_format
	// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +	 bugfix by: Michael White (http://getsprink.com)
	// +	 bugfix by: Benjamin Lupton
	// +	 bugfix by: Allan Jensen (http://www.winternet.no)
	// +	revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	// +	 bugfix by: Howard Yeend
	// +	revised by: Luke Smith (http://lucassmith.name)
	// +	 bugfix by: Diogo Resende
	// +	 bugfix by: Rival
	// +	 input by: Kheang Hok Chin (http://www.distantia.ca/)
	// +	 improved by: davook
	// +	 improved by: Brett Zamir (http://brett-zamir.me)
	// +	 input by: Jay Klehr
	// +	 improved by: Brett Zamir (http://brett-zamir.me)
	// +	 input by: Amir Habibi (http://www.residence-mixte.com/)
	// +	 bugfix by: Brett Zamir (http://brett-zamir.me)
	var n = number, prec = decimals;

	var toFixedFix = function (n,prec) {
		var k = Math.pow(10,prec);
		return (Math.round(n*k)/k).toString();
	};

	n = !isFinite(+n) ? 0 : +n;
	prec = !isFinite(+prec) ? 0 : Math.abs(prec);
	var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
	var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

	var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

	var abs = toFixedFix(Math.abs(n), prec);
	var _, i;

	if (abs >= 1000) {
		_ = abs.split(/\D/);
		i = _[0].length % 3 || 3;

		_[0] = s.slice(0,i + (n < 0)) +
			  _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
		s = _.join(dec);
	} else {
		s = s.replace('.', dec);
	}

	var decPos = s.indexOf(dec);
	if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
		s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
	}
	else if (prec >= 1 && decPos === -1) {
		s += dec+new Array(prec).join(0)+'0';
	}
	return s;
}