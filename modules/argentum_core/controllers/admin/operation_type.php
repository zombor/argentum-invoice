<?php
/**
 * Admin Operation Type Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
include Kohana::find_file('controllers', 'admin/admin_website');
class Operation_type_Controller extends Admin_Website_Controller {

	/**
	 * Displays all operation types
	 */
	public function all()
	{
		$this->view->operation_types = Auto_Modeler_ORM::factory('operation_type')->fetch_all('name');
	}

	/**
	 * Creates a new operation type
	 */
	public function add()
	{
		$operation_type = new Operation_type_Model();
		$this->template->content = $this->view = new View('admin/operation_type/form');
		$this->view->action = 'Add';
		$this->view->errors = '';

		if ($_POST)
		{
			$operation_type->set_fields($this->input->post());

			try
			{
				$operation_type->save();
				url::redirect('admin/operation_type/all');
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->operation_type = $operation_type;
				$this->template->body->errors = $e;
			}
		}

		$this->view->operation_type = $operation_type;
	}

	/**
	 * Edits an existing operation type
	 */
	public function edit($id)
	{
		$operation_type = new Operation_type_Model($id);
		$this->template->content = $this->view = new View('admin/operation_type/form');
		$this->view->errors = '';
		$this->view->action = 'Edit';

		if ($_POST)
		{
			$operation_type->set_fields($this->input->post());

			try
			{
				$operation_type->save();
				url::redirect('admin/operation_type/all');
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
			}
		}

		$this->view->operation_type = $operation_type;
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