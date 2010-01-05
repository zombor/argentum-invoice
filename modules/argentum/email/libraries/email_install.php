<?php
/**
 * Performs install/uninstall methods for the email module
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
class Email_Install {

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
		$this->db->query('CREATE TABLE `'.Kohana::config('database.default.table_prefix').'email_roles` (
		                   `id` mediumint(9) auto_increment,
		                   `user_id` mediumint(9) NOT NULL,
		                   `ticket_create` binary(1) NOT NULL,
		                   `ticket_close` binary(1) NOT NULL,
		                   `ticket_delete` binary(1) NOT NULL,
		                   `ticket_update` binary(1) NOT NULL,
		                   `ticket_time` binary(1) NOT NULL,
		                   `project_create` binary(1) NOT NULL,
		                   `project_close` binary(1) NOT NULL,
		                   PRIMARY KEY  (`id`)
		                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	/**
	 * Deletes the database tables for the email module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'email_roles`');
	}
}