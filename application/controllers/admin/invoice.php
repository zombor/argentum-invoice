<?php

/*
*  class:       Invoice_Controller
*  description: Provides application support for creating and modifying invoices
*/
class Invoice_Controller extends Website_Controller {

	/*
	*  function:     create
	*  description:  Creates an invoice for a client.
	                 Will display all unbilled tickets and non-hourly items for all
	                 active projects for the client.
	*  parameters:   $_GET['client_id']: The ID of the client to create the invoice for
	                 $_POST['tickets']:    An array of tickets to bill
	                 $_POST['non_hourly']: An array of non-hourly items to bill
	                 $_POST['comments']:   Comments for the invoice to save
	                 $_POST['client_id']:  The ID of the client to invoice
	*/
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

			$this->template->body = new View('admin/invoice/create');

			// Load all the unbill items for this client
			$this->template->body->projects = Auto_Modeler_ORM::factory('project')->find_unbilled($client->id);
			$this->template->body->client = $client;
		}
	}

	public function post_payment($invoice_id)
	{
		$invoice_payment = new Invoice_Payment_Model();

		if (request::method() == 'post')
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
				$this->template->body = new View('admin/invoice/post_payment');
				$this->template->body->errors = $e;
				$this->template->body->invoice_payment = $invoice_payment;
				$this->template->body->invoice_id = $this->uri->segment(4);
			}
		}
		else
		{
			$this->template->body = new View('admin/invoice/post_payment');
			$this->template->body->errors = '';
			$this->template->body->invoice_payment = $invoice_payment;
			$this->template->body->invoice_id = $this->uri->segment(4);
		}
	}
	
	public function view_payments($invoice_id)
	{
		$this->template->body = new View('admin/invoice/view_payments');
	}
}