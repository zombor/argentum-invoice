<?php

class Ticket_Controller extends Website_Controller {

	public function active($project_id)
	{
		$this->template->body = new View('ticket/active');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => FALSE));
		$this->template->body->project = new Project_Model($project_id);
	}

	public function closed($project_id)
	{
		$this->template->body = new View('ticket/closed');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => TRUE, 'invoiced' => FALSE));
		$this->template->body->project = new Project_Model($project_id);
	}

	public function invoiced($project_id)
	{
		$this->template->body = new View('ticket/invoiced');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => TRUE, 'invoiced' => TRUE));
		$this->template->body->project = new Project_Model($project_id);
	}

}