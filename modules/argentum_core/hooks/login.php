<?php
/**
 * Login Hook
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class login {

	/**
	 * Adds the login check to the routing event
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.routing', array($this, 'check_install'));
		if (Kohana::config('argentum.installed'))
			Event::add('system.routing', array($this, 'check_login'));
	}

	/**
	 * Checks to ensure the application is properly installed.
	 */
	public function check_install()
	{
		if ( ! Kohana::config('argentum.installed') AND (Router::$controller != 'settings' OR Router::$method != 'install'))
			url::redirect('admin/settings/install');
	}

	/**
	 * Checks to ensure the user is logged in. A user must be logged in to use Argentum.
	 */
	public function check_login()
	{
		// Always logged in
		$auth = new Auth();
		$uri = new URI();

		if (Router::$controller != 'user' AND Router::$method != 'login' AND ! $auth->logged_in())
		{
			$_SESSION['requested_page'] = $uri->string();
			url::redirect('user/login');
		}
		else if (Router::$controller == 'user' AND ! empty($_SERVER['HTTP_REFERER']))
		{
			// Make sure they can read cookies.
			if ( ! cookie::get(Kohana::config('session.name'), FALSE))
				throw new Kohana_Exception('argentum.no_cookies');
		}
		else
			$_SESSION['requested_page'] = 'project';
	}
}

new login;