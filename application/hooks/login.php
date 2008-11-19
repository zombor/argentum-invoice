<?php
/**
 * Login Hook
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class login {

	/**
	 * Adds the login check to the routing event
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.routing', array($this, 'check'));
	}

	/**
	 * Checks to ensure the user is logged in. A user must be logged in to use Argentum.
	 */
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
		else if ($uri->segment(1) == 'user' AND ! empty($_SERVER['HTTP_REFERER']))
		{
			// Make sure they can read cookies.
			if ( ! cookie::get('kohanasession', FALSE))
				throw new Kohana_Exception('argentum.no_cookies');
		}
		else
			$_SESSION['requested_page'] = 'project';
	}
}

new login;