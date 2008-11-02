<?php

/*
*  class:       User_Controller
*  description: Provides application support for logging users in/out and generating reports for user accounts
*/
class User_Controller extends Website_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth = new Auth();
	}

	public function index()
	{
		$this->template->body = new View('user/index');
	}

	/*
	*  function:     login
	*  description:  Displays the login form if no POST set, otherwise, perform a user login
	*  parameters:   $_POST['username']: username of the user logging in
	*                $_POST['password']: password of the user logging in
	*/
	public function login()
	{
		$this->template->body = new View('user/login');

		if (request::method() == 'post' AND $this->auth->login($this->input->post('username'), $this->input->post('password')))
		{
			url::redirect(arr::remove('requested_page', $_SESSION));
		}
	}

	/*
	*  function:     logout
	*  description:  Logs the current user out of the application. Destroys the current session
	*  parameters:   None expected.
	*/
	public function logout()
	{
		$this->auth->logout(TRUE);
		url::redirect();
	}

	/*
	*  function:     timesheet
	*  description:  displays a user's timesheet for a specified time period
	*  parameters:   $_POST['start_date']: unix time stamp of the start date
	*                $_POST['end_date']:   unix time stamp of the end date
	*/
	public function timesheet()
	{
		
	}
}