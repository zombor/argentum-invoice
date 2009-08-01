<?php
/**
 * Admin Project Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Project_Controller extends Website_Controller {

	/**
	 * Creates a new project
	 */
	public function add()
	{
		$project = new Project_Model();
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/project/form');
			$this->template->body->errors = '';
			$this->template->body->project = $project;
			$this->template->body->title = 'Add';
			$this->template->body->client = new Client_Model();
		}
		else
		{
			$project->set_fields($this->input->post('project'));

			try
			{
				if ($_POST['project']['client_id'] == 'new')
				{
					$client = new Client_Model();
					$client->set_fields($this->input->post('client'));
					$client->save();
					$project->client_id = $client->id;
				}
				else
					$client = $project->client;

				$project->save();

				Event::run('argentum.project_create', $project);

				url::redirect('project/view/'.$project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/project/form');
				$this->template->body->project = $project;
				$this->template->body->errors = $e;
				$this->template->body->title = 'Add';
				$this->template->body->client = $client;
			}
		}
	}

	/**
	 * Edits an existing project
	 */
	public function edit($id)
	{
		$project = new Project_Model($id);
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/project/form');
			$this->template->body->errors = '';
			$this->template->body->project = $project;
			$this->template->body->title = 'Update';
			$this->template->body->client = new Client_Model();
		}
		else
		{
			$project->set_fields($this->input->post('project'));

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

				if ($project->complete)
				{
					// Send an email to all users who are set to receive emails on new projects
					$swift = email::connect();
					$message = new Swift_Message('New Project Created- ID:'.$project->id.', '.$project->title, View::factory('emails/project_creation')->set(array('project' => $project)));
					$recipients = new Swift_RecipientList();

					foreach (Auto_Modeler_ORM::factory('user')->fetch_some(array('email_project_create' => TRUE)) as $user)
					{
						$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
					}

					if ($swift->send($message, $recipients, $_SESSION['auth_user']->email))
						url::redirect('project/view/'.$project->id);
					else
						throw new Kohana_User_Exception('swift.general_error');
				}
				else
					url::redirect('project/view/'.$project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/project/form');
				$this->template->body->project = $project;
				$this->template->body->errors = $e;
				$this->template->body->title = 'Update';
				$this->template->body->client = $client;
			}
		}
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