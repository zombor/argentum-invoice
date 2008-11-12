<?php

/*
*  class:       User_Controller
*  description: Provides application support for logging users in/out and generating reports for user accounts
*/
class User_Controller extends Website_Controller {

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
	*  parameters:   $_GET['start_date']: array of start date data
	*                $_GET['end_date']:   array of end date data
	*/
	public function timesheet()
	{
		$_GET = $this->input->get();

		$this->template->body = new View('user/timesheet');
		$this->template->body->start_date = mktime(0, 0, 0, $_GET['start_date']['month'], $_GET['start_date']['day'], $_GET['start_date']['year']);
		$this->template->body->end_date = mktime(0, 0, 0, $_GET['end_date']['month'], $_GET['end_date']['day'], $_GET['end_date']['year']);
	}

	public function active_projects()
	{
		$this->template->body = new View('user/active_projects');
		$this->template->body->projects = $_SESSION['auth_user']->find_assigned_projects();
	}
}