<?php

class send_email {

	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	public function add()
	{
		Event::add('argentum.project_add', array('Email_Controller', '_project_add'));
	}
}

new send_email;