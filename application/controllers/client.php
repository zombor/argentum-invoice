<?php

class Client_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('client/index');
	}
	
	public function show_all()
	{
		$this->template->body = new View('client/show_all');
		$this->template->body->clients = Auto_Modeler_ORM::factory('client')->fetch_all('company_name');
	}
	
	public function view($short_name)
	{
		$this->template->body = new View('client/view');
		$this->template->body->client = new Client_Model($short_name);
	}

	public function search()
	{
		$term = $this->input->get('term');
		$where = array('company_name' => $term,
		               'contact_first_name' => $term,
		               'contact_last_name' => $term,
		               'mailing_city' => $term,
		               'mailing_zip_code' => $term,
		               'email_address' => $term);

		$results = Auto_Modeler_ORM::factory('client')->fetch_some($where, 'company_name', 'ASC', 'or');
		$this->template->body = new View('client/search');
		$this->template->body->results = $results;
	}
}