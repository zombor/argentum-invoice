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
			
		}
		else
		{
			$client = new Client_Model($this->input->get('client_id'));

			$this->template->body = new View('invoice/create');
			$this->template->body->projects = Auto_Modeler_ORM::factory('project')->find_unbilled_tickets($client->id);
			$this->template->body->client = $client;
		}
	}
}