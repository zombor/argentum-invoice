<?php

class events {

	public function __construct()
	{
		// Hook into routing
		Event::add('system.routing', array($this, 'add'));
	}

	public function add()
	{
		Event::add('argentum.project_add', array('Project_Controller', '_add_email'));
	}
}

new events;