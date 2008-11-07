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

		if ($uri->segment(1) != 'user' AND ! $auth->logged_in('login'))
		{
			// Make sure the user can accept cookies
			cookie::set(array('name' => 'cookie_check', 'value' => 'argentum'));
			
			if ( ! cookie::get('cookie_check', FALSE))
				throw new Kohana_Exception('argentum.no_cookies');

			$_SESSION['requested_page'] = $uri->string();
			url::redirect('user/login');
		}
	}
}

new login;