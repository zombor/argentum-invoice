<?php

/*
*  class:       Ticket_Controller
*  description: Provides application support for viewing tickets for projects
*/
class Ticket_Controller extends Website_Controller {

	/*
	*  function:     active
	*  description:  Displays the active tickets for the requested project
	*  parameters:   $project_id: The ID number of the project to view
	*/
	public function active($project_id)
	{
		$this->template->body = new View('ticket/active');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => FALSE));
		$this->template->body->project = new Project_Model($project_id);
	}

	/*
	*  function:     closed
	*  description:  Displays the closed tickets for the requested project
	*  parameters:   $project_id: The ID number of the project to view
	*/
	public function closed($project_id)
	{
		$this->template->body = new View('ticket/closed');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => TRUE, 'invoiced' => FALSE));
		$this->template->body->project = new Project_Model($project_id);
	}

	/*
	*  function:     invoiced
	*  description:  Displays the invoiced tickets for the requested project
	*  parameters:   $project_id: The ID number of the project to view
	*/
	public function invoiced($project_id)
	{
		$this->template->body = new View('ticket/invoiced');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => TRUE, 'invoiced' => TRUE));
		$this->template->body->project = new Project_Model($project_id);
	}

	/*
	*  function:     view
	*  description:  Displays the details of the ticket, including time spent on ticket
	*  parameters:   $id: The ID number of the ticket to view
	*/
	public function view($id)
	{
		$this->template->body = new View('ticket/view');
		$this->template->body->ticket = new Ticket_Model($id);
	}
}