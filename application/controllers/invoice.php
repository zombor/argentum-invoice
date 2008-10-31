<?php

class Invoice_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('invoice/index');
	}

	public function create()
	{
		if (request::method() == 'post')
		{
			$invoice = new Invoice_Model();

			// Save the new invoice
			$invoice->comments = $this->input->post('comments');
			$invoice->date = time();
			$invoice->client_id = $this->input->post('client_id');
			$invoice_id = $invoice->save();

			// Assign all the tickets to this invoice
			foreach ($this->input->post('tickets') as $ticket_id)
			{
				$ticket = new Ticket_Model($ticket_id);
				$ticket->invoiced = TRUE;
				$ticket->invoice_id = $invoice->id;
				$ticket->save();
			}

			url::redirect('invoice/view/'.$invoice->id);
		}
		else
		{
			$client = new Client_Model($this->input->get('client_id'));

			$this->template->body = new View('invoice/create');
			$this->template->body->projects = Auto_Modeler_ORM::factory('project')->find_unbilled_tickets($client->id);
			$this->template->body->client = $client;
		}
	}

	public function view($invoice_id)
	{
		$this->template->body = new View('invoice/view');
		$this->template->body->invoice = new Invoice_Model($invoice_id);
	}
}