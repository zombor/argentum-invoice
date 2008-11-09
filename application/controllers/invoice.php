<?php

/*
*  class:       Invoice_Controller
*  description: Provides application support for viewing invoices
*/
class Invoice_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('invoice/index');
	}

	/*
	*  function:     list_all
	*  description:  Displays all invoices for a requested time period.
	                 By default, it displays all invoices for the current year.
	*  parameters:   $year:  Year to view
	*                $month: Month to view
	*/
	public function list_all($year = NULL, $month = NULL)
	{
		if ($year == NULL AND $month == NULL)
			$year = date('Y');
		else if ($year == NULL)
			$year = date('Y');

		$start_date = mktime(0, 0, 0, ($month == NULL ? 1 : $month), 1, $year);
		$end_date = $month == NULL ? mktime(23, 59, 59, 12, 31, $year) : mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year);

		$this->template->body = new View('invoice/list_all');
		$this->template->body->invoices = Auto_Modeler_ORM::factory('invoice')->find_invoices_by_date($start_date, $end_date);
	}

	/*
	*  function:     view
	*  description:  Displays the requested invoice
	*  parameters:   $invoice_id: The invoice id to view
	*/
	public function view($invoice_id = NULL)
	{
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		$this->template->body = new View('invoice/templates/default/view');
		$this->template->body->invoice = new Invoice_Model($invoice_id);
	}
	
	public function view_pdf($invoice_id = NULL)
	{
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		require Kohana::find_file('vendor/dompdf', 'dompdf_config.inc');

		$html = View::factory('invoice/templates/default/pdf')->set(array('invoice' => new Invoice_Model($invoice_id)));
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($invoice_id.'.pdf');
	}
}