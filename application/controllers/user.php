<?php
/**
 * Project Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class User_Controller extends Website_Controller {

	/**
	 * Displays the main user screen
	 */
	public function index()
	{
		$this->template->body = new View('user/index');
	}

	/**
	 * Performs a user login
	 */
	public function login()
	{
		$this->template->body = new View('user/login');

		if (request::method() == 'post' AND $this->auth->login($this->input->post('username'), $this->input->post('password')))
		{
			url::redirect(arr::remove('requested_page', $_SESSION));
		}
	}

	/**
	 * Performs a user logout
	 */
	public function logout()
	{
		$this->auth->logout(TRUE);
		url::redirect();
	}

	/**
	 * Displays the logged in user's timesheet
	 */
	public function timesheet()
	{
		$_GET = $this->input->get();

		$this->template->body = new View('user/timesheet');
		$this->template->body->start_date = mktime(0, 0, 0, $_GET['start_date']['month'], $_GET['start_date']['day'], $_GET['start_date']['year']);
		$this->template->body->end_date = mktime(0, 0, 0, $_GET['end_date']['month'], $_GET['end_date']['day'], $_GET['end_date']['year']);
	}

	/**
	 * Displays the logged in user's projects with tickets that have been assigned to them
	 */
	public function active_projects()
	{
		$this->template->body = new View('user/active_projects');
		$this->template->body->projects = $_SESSION['auth_user']->find_assigned_projects();
	}
}