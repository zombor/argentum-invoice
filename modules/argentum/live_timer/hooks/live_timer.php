<?php
/**
 * Loads all live timer events throughout the application
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class live_timer {

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
		page::add_javascript('live_timer/effects');
		page::add_stylesheet('live_timer/style');
		Event::add('argentum.nav_links_display', array('Live_Timer_Controller', '_nav_links_display'));
	}
}

new live_timer;