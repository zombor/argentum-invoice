<?php
/**
 * Performs install/uninstall methods for the email module
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
class Budget_Install {

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
		$this->db->query('CREATE TABLE `'.Kohana::config('database.default.table_prefix').'project_budgets` (
		                   `id` mediumint(9) auto_increment,
		                   `project_id` mediumint(9) NOT NULL,
		                   `amount` decimal(10,2) NOT NULL,
		                   PRIMARY KEY  (`id`)
		                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

		// Make a row for each project
		foreach (Auto_Modeler_ORM::factory('project')->fetch_all() as $project)
		{
			$budget = new Project_Budget_Model;
			$budget->project_id = $project->id;
			$budget->save();
		}
	}

	/**
	 * Deletes the database tables for the email module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'project_budgets`');
	}
}