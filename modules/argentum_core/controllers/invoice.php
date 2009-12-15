<?php
/**
 * Invoice Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Invoice_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('invoice/index');
	}

	/**
	 * Displays all invoices
	 * @param int $year
	 * @param int $month
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

	/**
	 * Views an invoice
	 * @param int $invoice_id
	 */
	public function view($invoice_id = NULL)
	{
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		$this->template->body = new View('invoice/templates/'.$invoice->template_name.'/view');
		$this->template->body->invoice = new Invoice_Model($invoice_id);
	}

	/**
	 * Views a PDF version of a invoice
	 * @param int $invoice_id
	 */
	public function view_pdf($invoice_id = NULL)
	{
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		require Kohana::find_file('vendor/dompdf', 'dompdf_config.inc');

		$html = View::factory('invoice/templates/'.$invoice->template_name.'/pdf')->set(array('invoice' => new Invoice_Model($invoice_id)));
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($invoice_id.'.pdf');
	}

	public function details($invoice_id = NULL)
	{
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		$this->template->body = new View('invoice/details');
		$this->template->body->invoice = $invoice;
	}
}