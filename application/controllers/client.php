<?php

class Client_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('client/index');
	}
	
	public function show_all()
	{
		$this->template->body = new View('client/show_all');
		$this->template->body->client = Auto_Modeler_ORM::factory('client')->fetch_all();
	}
	
	public function view($short_name)
	{
		$this->template->body = new View('client/view');
		$this->template->body->client = new Client_Model($short_name);
	}
}