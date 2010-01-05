<?php
/**
 * Admin Project Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
include Kohana::find_file('controllers', 'admin/admin_website');
class Project_Controller extends Admin_Website_Controller {

	/**
	 * Creates a new project
	 */
	public function add()
	{
		$project = new Project_Model();
		$this->template->content = $this->view = new View('admin/project/form');
		$this->view->title = 'Add';
		$this->view->errors = '';
		$this->view->client = new Client_Model();

		if ($_POST)
		{
			$project->set_fields($this->input->post('project'));
			$project->taxable = $this->input->post('taxable', FALSE);
			$project->complete = $this->input->post('complete', FALSE);

			try
			{
				if ($_POST['project']['client_id'] == 'new')
				{
					$client = new Client_Model();
					$client->set_fields($this->input->post('client'));
					$client->save();
					$project->client_id = $client->id;
				}
				elseif ($_POST['project']['client_id'] == '--')
				{
					$client = new Client_Model;
					$project->client_id = '';
				}
				else
					$client = $project->client;

				$project->save();

				$event_data = array('project' => $project, 'post' => $_POST);
				Event::run('argentum.project_create', $event_data);

				url::redirect('project/view/'.$project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->view->project = $project;
				$this->view->errors = $e;
				$this->view->client = $client;
			}
		}

		$this->view->project = $project;
	}

	/**
	 * Edits an existing project
	 */
	public function edit($id)
	{
		$project = new Project_Model($id);
		$this->template->content = $this->view = new View('admin/project/form');
		$this->view->errors = '';
		$this->view->title = 'Update';
		$this->view->client = new Client_Model();

		if ($_POST)
		{
			$project->set_fields($this->input->post('project'));
			$project->taxable = $this->input->post('taxable', FALSE);
			$project->complete = $this->input->post('complete', FALSE);

			try
			{
				if ($_POST['project']['client_id'] == 'new')
				{
					$client = new Client_Model();
					$client->set_fields($this->input->post('client'));
					$client->save();
				}
				else
					$client = $project->client;

				$project->save();

				$event_data = array('project' => $project, 'post' => $_POST);
				Event::run('argentum.project_edit_submit', $event_data);

				url::redirect('project/view/'.$project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->view->errors = $e;
				$this->view->client = $client;
			}
		}

		$this->view->project = $project;
	}

	/**
	 * Deletes an existing project
	 */
	public function delete()
	{
		Auto_Modeler_ORM::factory('project', $this->input->post('id'))->delete();
		url::redirect('project/view_all');
	}
}