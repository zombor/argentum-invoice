<?php

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

	public function login()
	{
		$this->template->body = new View('user/login');

		if (request::method() == 'post' AND $this->auth->login($this->input->post('username'), $this->input->post('password')))
		{
			url::redirect(arr::remove('requested_page', $_SESSION));
		}
	}

	public function logout()
	{
		$this->auth->logout(TRUE);
		url::redirect();
	}
}