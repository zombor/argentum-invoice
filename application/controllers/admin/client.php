<?php

/**
 * Client Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */
class Client_Controller extends Website_Controller {

	/**
	 *  Creates a new client in the database
	 */
	public function add()
	{
		$client = new Client_Model();
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/client/form');
			$this->template->body->errors = '';
			$this->template->body->client = $client;
			$this->template->body->title = 'Add';
		}
		else
		{
			$client->set_fields($this->input->post());

			try
			{
				$client->save();
				url::redirect('client/view/'.$client->short_name);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/client/form');
				$this->template->body->client = $client;
				$this->template->body->errors = $e;
				$this->template->body->title = 'Add';
			}
		}
	}

	/**
	 *  Edits an existing client
	 */
	public function edit($short_name)
	{
		$client = new Client_Model($short_name);
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/client/form');
			$this->template->body->errors = '';
			$this->template->body->client = $client;
			$this->template->body->title = 'Update';
		}
		else
		{
			$client->set_fields($this->input->post());

			try
			{
				$client->save();
				url::redirect('client/view/'.$client->short_name);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/client/form');
				$this->template->body->client = $client;
				$this->template->body->errors = $e;
				$this->template->body->title = 'Update';
			}
		}
	}

	/**
	 *  Deletes an existing client
	 */
	public function delete()
	{
		Auto_Modeler_ORM::factory('client', $this->input->post('id'))->delete();
		url::redirect('client/view_all');
	}
}