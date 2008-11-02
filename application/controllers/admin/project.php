<?php

/*
*  class:       Project_Controller
*  description: Provides application support for projects including adding, editing and deleting
*/
class Project_Controller extends Website_Controller {

	/*
	*  function:     add
	*  description:  Creates a new project
	*  parameters:   $_POST: Contains the post data to create the project
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
				}

				$project->save();
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

	/*
	*  function:     edit
	*  description:  Updates an existing project
	*  parameters:   $id:    The ID of the project to update.
	*                $_POST: Contains the post data to update with
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
			$project->set_fields($this->input->post());

			try
			{
				if ($_POST['project']['client_id'] == 'new')
				{
					$client = new Client_Model();
					$client->set_fields($this->input->post('client'));
					$client->save();
				}

				$project->save();
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

	/*
	*  function:     delete
	*  description:  Deletes an existing project
	*  parameters:   $_POST['id']: ID of the project to delete
	*/
	public function delete()
	{
		Auto_Modeler_ORM::factory('project', $this->input->post('id'))->delete();
		url::redirect('project/view_all');
	}
}