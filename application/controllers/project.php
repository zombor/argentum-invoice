<?php

/*
*  class:       Project_Controller
*  description: Provides application support for projects including viewing and searching
*/
class Project_Controller extends Website_Controller {

	public function index()
	{
		$this->template->body = new View('project/index');
	}

	/*
	*  function:     show_all
	*  description:  Displays all the projects in the application
	*  parameters:   None expected.
	*/
	public function show_all()
	{
		$this->template->body = new View('project/show_all');
		$this->template->body->projects = Auto_Modeler_ORM::factory('project')->fetch_all('name');
	}

	/*
	*  function:     view
	*  description:  Displays the home page for the requestd project
	*  parameters:   $id: The ID number of the project to view
	*/
	public function view($id)
	{
		$this->template->body = new View('project/view');
		$this->template->body->project = new Project_Model($id);
	}

	/*
	*  function:     search
	*  description:  Searches for projects
	*  parameters:   $_GET['term']: The search term to query the database with.
	*                               Searches the project name and project notes.
	*/
	public function search()
	{
		$term = $this->input->get('term');
		$results = Auto_Modeler_ORM::factory('project')->search($term);
		$this->template->body = new View('project/search');
		$this->template->body->results = $results;
	}
}