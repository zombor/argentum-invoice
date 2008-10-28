<?php

class Project_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('project/index');
	}
	
	public function show_all()
	{
		$this->template->body = new View('project/show_all');
		$this->template->body->projects = Auto_Modeler_ORM::factory('project')->fetch_all('name');
	}
	
	public function view($id)
	{
		$this->template->body = new View('project/view');
		$this->template->body->project = new Project_Model($id);
	}

	public function search()
	{
		$term = $this->input->get('term');
		$results = Auto_Modeler_ORM::factory('project')->search($term);
		$this->template->body = new View('project/search');
		$this->template->body->results = $results;
	}
}