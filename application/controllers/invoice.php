<?php

class Invoice_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('invoice/index');
	}

	public function create()
	{
		if (request::method() == 'post' AND ($this->input->post('tickets')) OR $this->input->post('non_hourly'))
		{
			$invoice = new Invoice_Model();

			// Save the new invoice
			$invoice->comments = $this->input->post('comments');
			$invoice->date = time();
			$invoice->client_id = $this->input->post('client_id');
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

			// Assign all the tickets to this invoice
			if ($this->input->post('non_hourly'))
				foreach ($this->input->post('non_hourly') as $non_hourly_id)
				{
					$non_hourly = new Non_hourly_Model($non_hourly_id);
					$non_hourly->invoiced = TRUE;
					$non_hourly->invoice_id = $invoice->id;
					$non_hourly->save();
				}

			// Redirect to the invoice
			url::redirect('invoice/view/'.$invoice->id);
		}
		else
		{
			$client = new Client_Model($this->input->get('client_id'));

			$this->template->body = new View('invoice/create');

			// Load all the unbill items for this client
			$this->template->body->projects = Auto_Modeler_ORM::factory('project')->find_unbilled($client->id);
			$this->template->body->client = $client;
		}
	}

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

	public function view($invoice_id = NULL)
	{
		$invoice = new Invoice_Model($invoice_id);

		if ( ! $invoice->id)
			Event::run('system.404');

		$this->template->body = new View('invoice/view');
		$this->template->body->invoice = new Invoice_Model($invoice_id);
	}
}