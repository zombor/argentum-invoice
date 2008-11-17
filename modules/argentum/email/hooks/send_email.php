<?php

class send_email {

	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	public function add()
	{
		Event::add('argentum.project_create', array('Email_Controller', '_project_create'));
		Event::add('argentum.project_close', array('Email_Controller', '_project_close'));
		Event::add('argentum.user_settings_display', array('Email_Controller', '_user_settings_display'));
		Event::add('argentum.user_settings_save', array('Email_Controller', '_user_settings_save'));
		Event::add('argentum.ticket_create', array('Email_Controller', '_ticket_create'));
		Event::add('argentum.ticket_close', array('Email_Controller', '_ticket_close'));
		Event::add('argentum.ticket_time', array('Email_Controller', '_ticket_time'));
		Event::add('argentum.ticket_update', array('Email_Controller', '_ticket_update'));
		Event::add('argentum.ticket_delete', array('Email_Controller', '_ticket_delete'));
	}
}

new send_email;