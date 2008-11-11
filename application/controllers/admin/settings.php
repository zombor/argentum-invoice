<?php

class Settings_Controller extends Website_Controller
{
	public function __construct()
	{
		// Make sure the user is an application administrator
		Auth::instance()->logged_in('admin') OR Event::run('system.404');

		parent::__construct();
	}
	public function index()
	{
		$this->template->body = new View('admin/settings/index');
	}

	public function application()
	{
		$settings = new Settings_Model();
		$this->template->body = new View('admin/settings/application');
		$this->template->body->settings = $settings;
		$this->template->body->errors = '';

		if ( ! $_POST)
		{
			$this->template->body->status = NULL;
		}
		else
		{
			$settings->set_fields($this->input->post());
			try
			{
				$settings->save();
				$this->template->body->status = TRUE;
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
				$this->template->body->settings = $settings;
				$this->template->body->status = FALSE;
			}
		}
	}
}