<?php

class Operation_type_Controller extends Website_Controller {

	public function view_all()
	{
		$this->template->body = new View('admin/oepration_type/view_all');
		$this->template->body->operation_types = Auto_Modeler_ORM::factory('operation_type')->fetch_all('name');
	}

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
				url::redirect('operation_type/view_all');
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
			$client->set_fields($this->input->post());

			try
			{
				$operation_type->save();
				url::redirect('client/view_all');
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
	
	public function delete()
	{
		Auto_Modeler_ORM::factory('operation_type', $this->input->post('id'))->delete();
		url::redirect('operation_type/view_all');
	}
}