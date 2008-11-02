<?php

/*
*  class:       Non_hourly_Controller
*  description: Provides application support for creating and updating non-hourly items
*/
class Non_hourly_Controller extends Website_Controller {

	/*
	*  function:     add
	*  description:  Creates a non-hourly item
	*  parameters:   $project_id: The project the add to
	*                $_POST: Contains the post data to create the project
	*/
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

	/*
	*  function:     edit
	*  description:  Updates a non-hourly item
	*  parameters:   $id: The ID of the non-hourly item to edit
	*                $_POST: Contains the post data to create the project
	*/
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