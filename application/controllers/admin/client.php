<?php

class Client_Controller extends Website_Controller {

	public function add()
	{
		$client = new Client_Model();
		if (!$_POST) // Display the form
		{
			$this->template->body = new View('admin/client/add');
			$this->template->body->errors = '';
			$this->template->body->client = $client;
		}
		else
		{
			$client->set_fields($this->input->post());

			try
			{
				$client->save();
				url::redirect('client/show_all');
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/client/add');
				$this->template->body->client = $client;
				$this->template->body->errors = $e;
				$this->template->body->set($this->input->post());
			}
		}
	}
	
	public function edit()
	{
	
	}
	
	public function delete()
	{
	
	}
}