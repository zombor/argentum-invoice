<?php
/**
 * Admin Invoice Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
include Kohana::find_file('controllers', 'admin/admin_website');
class Invoice_Controller extends Admin_Website_Controller {

	/**
	 * Creates an invoice for a client
	*/
	public function create()
	{
		if ($_POST AND $this->input->post('tickets'))
		{
			$invoice = new Invoice_Model();

			// Save the new invoice
			$invoice->comments = $this->input->post('comments');
			$invoice->date = time();
			$invoice->client_id = $this->input->post('client_id');
			$invoice->template_name = $this->input->post('template_name');
			$invoice->currency_id = $this->input->post('currency_id');
			$invoice->due_date = strtotime($this->input->post('due_date', time()+(Kohana::config('argentum.default_invoice_net_days')*60*60*24)));
			$invoice->conversion_rate = currency::convert(Auto_Modeler_ORM::factory('currency',
			                                                 Kohana::config('argentum.default_currency'))->name,
			                                              Auto_Modeler_ORM::factory('currency',
			                                                 $this->input->post('currency_id'))->name,
			                                              1);

			$invoice_id = $invoice->save();

			// Assign all the tickets to this invoice
			if ($this->input->post('tickets'))
				foreach ($this->input->post('tickets') as $ticket_id)
				{
					$ticket = new Ticket_Model($ticket_id);
					$ticket->invoiced = TRUE;
					$ticket->invoice_id = $invoice->id;
					$ticket->save();
				}

			// Redirect to the invoice
			url::redirect('invoice/view/'.$invoice->id);
		}
		else
		{
			$client = new Client_Model($this->input->get('client_id'));

			// Load all the unbill items for this client
			$this->view->projects = Auto_Modeler_ORM::factory('project')->find_unbilled($client->id);
			$this->view->client = $client;

			// Find all the invoice templates
			$directories = array();
			foreach (Kohana::list_files('views/invoice/templates/') as $directory)
			{
				$directories[basename($directory)] = ucfirst(str_replace('_', ' ', basename($directory)));
			}

			$this->view->templates = $directories;
		}
	}

	public function edit($invoice_id)
	{
		Auth::instance()->logged_in('admin') OR Event::run('system.404');
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		if ( ! $_POST)
		{
			$this->view->invoice = $invoice;
		}
		else
		{
			$tickets = arr::remove('tickets', $_POST);
			$non_hourlies = arr::remove('non_hourly', $_POST);

			$invoice->set_fields($_POST);

			try
			{
				$invoice->save();

				foreach ($tickets as $ticket_id)
				{
					$ticket = new Ticket_Model($ticket_id);
					$ticket->invoiced = FALSE;
					$ticket->invoice_id = NULL;
					$ticket->save();
				}
			}
			catch (Kohana_User_Exception $e) {}

			url::redirect('invoice/list_all');
		}
	}

	/**
	 * Adds a payment to an invoice
	 */
	public function post_payment($invoice_id)
	{
		$invoice_payment = new Invoice_Payment_Model();
		$this->view->errors = '';

		if ($_POST)
		{
			$invoice_payment->set_fields($this->input->post());
			$invoice_payment->date = $this->input->post('date');

			try
			{
				$invoice_payment->save();

				url::redirect('invoice/list_all');
			}
			catch (Kohana_User_Exception $e)
			{
				$this->view->errors = $e;
				$this->view->invoice_payment = $invoice_payment;
				$this->view->invoice_id = $this->uri->segment(4);
			}
		}

		$this->view->invoice_payment = $invoice_payment;
		$this->view->invoice_id = $this->uri->segment(4);
	}

	/**
	 * Views all payments for an invoice
	 */
	public function view_payments($invoice_id)
	{
		$this->view->invoice_payments = Auto_Modeler_ORM::factory('invoice_payment')->fetch_where(array('invoice_id' => $invoice_id));
		$this->view->invoice_id = $invoice_id;
	}

	/**
	 * Deleted a payments for an invoice
	 */
	public function delete_payment()
	{
		$payment_id = $this->input->post('payment_id');
		$invoice_payment = new Invoice_Payment_Model($payment_id);
		$invoice_payment->delete();
		url::redirect('admin/invoice/view_payments/'.$invoice_payment->invoice_id);
	}
}