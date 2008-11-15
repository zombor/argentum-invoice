<?php

class send_email {

	public function __construct()
	{
		// Hook into routing
		Event::add('system.routing', array($this, 'add'));
	}

	public function add()
	{
		Event::add('argentum.project_add', array('Email_Controller', 'project_add'));
	}
}

new send_email;