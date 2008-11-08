<?php

/*
*  class:       Client_Controller
*  description: Provides application support for viewing and searching for clients
*/
class Client_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('client/index');
		$this->template->body->clients = Auto_Modeler_ORM::factory('client')->fetch_all('company_name');
	}

	/*
	*  function:     view
	*  description:  Displays the information for the requested client
	*  parameters:   $short_name: The short name of the client to view
	*/
	public function view($short_name = NULL)
	{
		$client = new Client_Model($short_name);
		
		if ( ! $client->id)
			Event::run('system.404');


		$this->template->body = new View('client/view');
		$this->template->body->client = $client;
	}

	/*
	*  function:     search
	*  description:  Searches for clients
	*  parameters:   $_GET['term']: The search term to query the database with.
	*                               Searches the company name, contact name and address.
	*/
	public function search()
	{
		$term = $this->input->get('term');
		$results = Auto_Modeler_ORM::factory('client')->search($term);
		$this->template->body = new View('client/search');
		$this->template->body->results = $results;
	}
}