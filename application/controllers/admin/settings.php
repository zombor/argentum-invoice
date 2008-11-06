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
		if ( ! $_POST)
		{
			$this->template->body = new View('admin/settings/application');
		}
		else
		{
			// Save the settings
		}
	}
}