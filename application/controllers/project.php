<?php
/**
 * Project Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Project_Controller extends Website_Controller {

	/**
	 * Displays all active projects
	 */
	public function index()
	{
		$this->template->body = new View('project/index');
		$this->template->body->title = 'Active Projects';
		$this->template->body->project_list = new View('project/_list');
		$this->template->body->project_list->projects = Auto_Modeler_ORM::factory('project')->fetch_where(array('complete' => FALSE), 'name');
	}

	/**
	 * Displays all projects
	 */
	public function show_all()
	{
		$this->template->body = new View('project/index');
		$this->template->body->title = 'All Projects';
		$this->template->body->project_list = new View('project/_list');
		$this->template->body->project_list->projects = Auto_Modeler_ORM::factory('project')->fetch_all('name');
	}

	/**
	 * Views the main details for a project
	 * @param int $id
	 */
	public function view($id)
	{
		$this->template->body = new View('project/view');
		$this->template->body->project = new Project_Model($id);
	}

	/**
	 * Searches for a project
	 */
	public function search()
	{
		$term = $this->input->get('term');
		$results = Auto_Modeler_ORM::factory('project')->search($term);
		$this->template->body = new View('project/search');
		$this->template->body->results = $results;
	}

	public function overview()
	{
		$this->template->body = new View('project/overview');
		$this->template->body->new_tickets = Auto_Modeler_ORM::factory('ticket')->fetch_all('creation_date', 'DESC', 10);
		$this->template->body->unpaid_invoices = Auto_Modeler_ORM::factory('invoice')->fetch_where(array('date <' => (time()-60*60*24*30)));
		$this->template->body->projects = Auto_Modeler_ORM::factory('project')->find_top_tickets();
	}
}