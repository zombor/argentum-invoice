<?php

class Client_Controller extends Website_Controller {

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
	
	public function delete()
	{
		Auto_Modeler_ORM::factory('client', $this->input->post('id'))->delete();
		url::redirect('client/view_all');
	}
}