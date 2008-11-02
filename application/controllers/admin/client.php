<?php

/*
*  class:       Client_Controller
*  description: Provides application support for adding and editing clients
*/
class Client_Controller extends Website_Controller {

	/*
	*  function:     add
	*  description:  Creates a new client
	*  parameters:   $_POST: Contains the post data to create the project
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

	/*
	*  function:     edit
	*  description:  Modifies an existing client
	*  parameters:   $short_name: The name of the client to edit
	*                $_POST: Contains the post data to create the project
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
			$client->tax_exempt = $this->input->post('tax_exempt', FALSE);

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

	/*
	*  function:     delete
	*  description:  Deletes a client.
	*  parameters:   $_POST['id]: The ID of the client to delete.
	*/
	public function delete()
	{
		Auto_Modeler_ORM::factory('client', $this->input->post('id'))->delete();
		url::redirect('client/view_all');
	}
}