<?php

class Non_hourly_Controller extends Website_Controller {

	public function add($project_id)
	{
		$non_hourly = new Non_hourly_Model();
		$non_hourly->project_id = $project_id;

		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/non_hourly/add');
			$this->template->body->errors = '';
			$this->template->body->non_hourly = $non_hourly;
		}
		else
		{
			$non_hourly->set_fields($this->input->post());
			$non_hourly->creation_date = time();

			try
			{
				$non_hourly->save();
				url::redirect('non_hourly/view_project/'.$non_hourly->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/non_hourly/add');
				$this->template->body->non_hourly = $non_hourly;
				$this->template->body->errors = $e;
				$this->template->body->set($this->input->post());
			}
		}
	}


	public function edit($id)
	{
		$non_hourly = new Non_hourly_Model($id);

		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/non_hourly/edit');
			$this->template->body->errors = '';
			$this->template->body->non_hourly = $non_hourly;
		}
		else
		{
			$non_hourly->set_fields($this->input->post());

			try
			{
				$non_hourly->save();
				url::redirect('non_hourly/view_project/'.$non_hourly->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/non_hourly/edit');
				$this->template->body->non_hourly = $non_hourly;
				$this->template->body->errors = $e;
				$this->template->body->set($this->input->post());
			}
		}
	}
}