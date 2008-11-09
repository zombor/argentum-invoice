<?php

class login {

	public function __construct()
	{
		// Hook into routing
		Event::add('system.routing', array($this, 'check'));
	}

	public function check()
	{
		// Always logged in
		$auth = new Auth();
		$uri = new URI();

		if ($uri->segment(1) != 'user' AND $uri->segment(1) != 'invoice' AND ! $auth->logged_in('login'))
		{
			$_SESSION['requested_page'] = $uri->string();
			url::redirect('user/login');
		}
		else if ($uri->segment(1) == 'user')
		{
			// Make sure they can read cookies.
			if ( ! cookie::get('kohanasession', FALSE))
				throw new Kohana_Exception('argentum.no_cookies');
		}
	}
}

new login;