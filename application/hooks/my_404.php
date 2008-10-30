<?php

class my_404 {

	public function __construct()
	{
		// Hook into routing
		Event::clear('system.404', array('Kohana', 'show_404'));
		Event::add('system.404', array($this, 'show_404'));
	}

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