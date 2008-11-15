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
		Event::add('argentum.user_settings_display', array('Email_Controller', '_user_settings_display'));
		Event::add('argentum.user_settings_save', array('Email_Controller', '_user_settings_save'));
	}
}

new send_email;