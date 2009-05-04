<?php
/**
 * Performs install/uninstall methods for the live_timer module
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Live_Timer_Install {

	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Creates the required database tables for the email module
	 */
	public function run_install()
	{
		// Create the database tables.
		$this->db->query('CREATE TABLE `'.Kohana::config('database.default.table_prefix').'live_timers` (
		                   `id` mediumint(9) auto_increment,
		                   `user_id` mediumint(9) NOT NULL,
		                   `ticket_id` mediumint(9) NOT NULL,
		                   `start_time` int NOT NULL,
		                   PRIMARY KEY  (`id`)
		                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	/**
	 * Deletes the database tables for the email module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'live_timers`');
	}
}