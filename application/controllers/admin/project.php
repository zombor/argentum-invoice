<?php

class Project_Controller extends Website_Controller {

	public function add()
	{
		$project = new Project_Model();
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/project/form');
			$this->template->body->errors = '';
			$this->template->body->project = $project;
			$this->template->body->title = 'Add';
		}
		else
		{
			$project->set_fields($this->input->post());

			try
			{
				$project->save();
				url::redirect('project/view/'.$project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/project/form');
				$this->template->body->project = $project;
				$this->template->body->errors = $e;
				$this->template->body->title = 'Add';
			}
		}
	}
	
	public function edit($id)
	{
		$project = new Project_Model($id);
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/project/form');
			$this->template->body->errors = '';
			$this->template->body->project = $project;
			$this->template->body->title = 'Update';
		}
		else
		{
			$project->set_fields($this->input->post());

			try
			{
				$project->save();
				url::redirect('project/view/'.$project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/project/form');
				$this->template->body->project = $project;
				$this->template->body->errors = $e;
				$this->template->body->title = 'Update';
			}
		}
	}
	
	public function delete()
	{
		Auto_Modeler_ORM::factory('project', $this->input->post('id'))->delete();
		url::redirect('project/view_all');
	}
}