<?php

/*
*  class:       Operation_type_Controller
*  description: Provides application support for creating and editing operation types
*/
class Operation_type_Controller extends Website_Controller {

	/*
	*  function:     all
	*  description:  Displays all operation types
	*  parameters:   None expected.
	*/
	public function all()
	{
		$this->template->body = new View('admin/operation_type/all');
		$this->template->body->operation_types = Auto_Modeler_ORM::factory('operation_type')->fetch_all('name');
	}

	/*
	*  function:     add
	*  description:  Creates a new Operation Type
	*  parameters:   $_POST: Contains the post data to create the project
	*/
	public function add()
	{
		$operation_type = new Operation_type_Model();
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/operation_type/form');
			$this->template->body->errors = '';
			$this->template->body->operation_type = $operation_type;
			$this->template->body->action = 'Add';
		}
		else
		{
			$operation_type->set_fields($this->input->post());

			try
			{
				$operation_type->save();
				url::redirect('admin/operation_type/all');
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/operation_type/form');
				$this->template->body->operation_type = $operation_type;
				$this->template->body->errors = $e;
				$this->template->body->action = 'Add';
			}
		}
	}

	/*
	*  function:     edit
	*  description:  Updates an existing operation type
	*  parameters:   $id: ID of the operation type to edit
	                 $_POST: Contains the post data to create the project
	*/
	public function edit($id)
	{
		$operation_type = new Operation_type_Model($id);
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/operation_type/form');
			$this->template->body->errors = '';
			$this->template->body->operation_type = $operation_type;
			$this->template->body->action = 'Edit';
		}
		else
		{
			$operation_type->set_fields($this->input->post());

			try
			{
				$operation_type->save();
				url::redirect('admin/operation_type/all');
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/operation_type/form');
				$this->template->body->operation_type = $operation_type;
				$this->template->body->errors = $e;
				$this->template->body->action = 'Edit';
			}
		}
	}

	/*
	*  function:     delete
	*  description:  Deletes an operation type
	*  parameters:   $_POST['id']: ID of the operation type to delete
	*/
	public function delete()
	{
		Auto_Modeler_ORM::factory('operation_type', $this->input->post('id'))->delete();
		url::redirect('operation_type/view_all');
	}
}