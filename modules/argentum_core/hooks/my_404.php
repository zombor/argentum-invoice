<?php
/**
 * 404 Hook
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class my_404 {

	/**
	 * Clears the default 404 event and replace it with Argentum's
	 */
	public function __construct()
	{
		// Hook into routing
		Event::clear('system.404', array('Kohana', 'show_404'));
		Event::add('system.404', array($this, 'show_404'));
	}

	/**
	 * Displays a 404 page
	 */
	public function show_404()
	{
		header('HTTP/1.1 404 File Not Found');

		Kohana::$instance = new Project_Controller();
		$template = new View('template');
		$template->title = 'Page Not Found';
		$template->body = new View('404');
		$template->render(TRUE);
		die();
	}
}

new my_404;