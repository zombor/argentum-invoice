<?php
/**
 * Project Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Ticket_Controller extends Website_Controller {

	/**
	 * Displays all active tickets for a project
	 * @param int $project_id
	*/
	public function active($project_id)
	{
		$this->template->body = new View('ticket/active');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => FALSE));
		$this->template->body->project = new Project_Model($project_id);
	}

	/**
	 * Displays all closed tickets for a project
	 * @param int $project_id
	*/
	public function closed($project_id)
	{
		$this->template->body = new View('ticket/closed');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => TRUE, 'invoiced' => FALSE));
		$this->template->body->project = new Project_Model($project_id);
	}

	/**
	 * Displays all invoiced tickets for a project
	 * @param int $project_id
	*/
	public function invoiced($project_id)
	{
		$this->template->body = new View('ticket/invoiced');
		$this->template->body->tickets = Auto_Modeler_ORM::factory('ticket')->fetch_some(array('project_id' => $project_id, 'complete' => TRUE, 'invoiced' => TRUE));
		$this->template->body->project = new Project_Model($project_id);
	}

	/**
	 * Views details for a ticket
	 * @param int $id
	*/
	public function view($id)
	{
		$this->template->body = new View('ticket/view');
		$this->template->body->ticket = new Ticket_Model($id);
	}
}