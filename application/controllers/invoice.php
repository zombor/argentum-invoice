<?php

class Invoice_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('invoice/index');
	}

	public function create()
	{
		$client = new Client_Model($this->input->get('client_id'));

		$projects = Auto_Modeler_ORM::factory('project')->fetch_some(array('client_id' => $client->id));
	}
}