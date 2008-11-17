<?php

class Email_Install {

	public function __construct()
	{
		$this->db = Database::instance();
	}

	public function run_install()
	{
		// Create the database tables. We need a roles table, and a join table
		$this->db->query('CREATE TABLE `email_roles` (
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

	public function uninstall()
	{
		$this->db->query('DROP TABLE `email_roles`');
	}
}