<?php
/**
 * Project Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Project_Controller extends Website_Controller {

	/**
	 * Displays all active projects
	 */
	public function index()
	{
		$this->view->title = 'Active Projects';
		$this->view->project_list = new View('project/_list');
		$this->view->project_list->projects = Auto_Modeler_ORM::factory('project')->fetch_where(array('complete' => FALSE), 'name');
	}

	/**
	 * Displays all projects
	 */
	public function show_all()
	{
		$this->template->title = 'All Projects';
		$this->view->project_list = new View('project/_list');
		$this->view->project_list->projects = Auto_Modeler_ORM::factory('project')->fetch_all('name');
	}

	/**
	 * Views the main details for a project
	 * @param int $id
	 */
	public function view($id)
	{
		$this->view->project = new Project_Model($id);
	}

	/**
	 * Searches for a project
	 */
	public function search()
	{
		$term = $this->input->get('term');
		$results = Auto_Modeler_ORM::factory('project')->search($term);
		$this->view->results = $results;
	}

	public function overview()
	{
		$this->view->new_tickets = Auto_Modeler_ORM::factory('ticket')->fetch_all('creation_date', 'DESC', 10);
		$this->view->unpaid_invoices = Auto_Modeler_ORM::factory('invoice')->fetch_where(array('date <' => (time()-60*60*24*30)));
		$this->view->projects = Auto_Modeler_ORM::factory('project')->find_top_tickets();
	}
}