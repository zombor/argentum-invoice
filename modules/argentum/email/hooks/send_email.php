<?php
/**
 * Loads all email events throughout the application
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class send_email {

	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	/**
	 * Adds all the events to the main Argentum application
	 */
	public function add()
	{
		// Only add the events if we are on that controller
		if (Router::$controller == 'project')
		{
			Event::add('argentum.project_create', array('Email_Controller', '_project_create'));
			Event::add('argentum.project_close', array('Email_Controller', '_project_close'));
		}
		elseif (Router::$controller == 'user')
		{
			Event::add('argentum.user_settings_display', array('Email_Controller', '_user_settings_display'));
			Event::add('argentum.user_settings_save', array('Email_Controller', '_user_settings_save'));
		}
		elseif (Router::$controller == 'settings')
		{
			Event::add('argentum.system_settings_display', array('Email_Controller', '_system_settings_display'));
		}
		elseif (Router::$controller == 'ticket')
		{
			Event::add('argentum.ticket_create', array('Email_Controller', '_ticket_create'));
			Event::add('argentum.ticket_close', array('Email_Controller', '_ticket_close'));
			Event::add('argentum.ticket_time', array('Email_Controller', '_ticket_time'));
			Event::add('argentum.ticket_update', array('Email_Controller', '_ticket_update'));
			Event::add('argentum.ticket_delete', array('Email_Controller', '_ticket_delete'));
		}
	}
}

new send_email;