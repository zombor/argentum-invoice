<?php
/**
 * Operation_type Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Operation_type_Controller extends Website_Controller {

	/**
	 * Displays all operation types
	 */
	public function all()
	{
		$this->template->body = new View('admin/operation_type/all');
		$this->template->body->operation_types = Auto_Modeler_ORM::factory('operation_type')->fetch_all('name');
	}

	/**
	 * Creates a new operation type
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

	/**
	 * Edits an existing operation type
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

	/**
	 * Deletes an operation type
	 */
	public function delete()
	{
		Auto_Modeler_ORM::factory('operation_type', $this->input->post('id'))->delete();
		url::redirect('operation_type/view_all');
	}
}