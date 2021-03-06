<?php
/**
 * Admin Settings Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
include Kohana::find_file('controllers', 'admin/admin_website');
class Settings_Controller extends Admin_Website_Controller
{
	/**
	 * Custom constructor so we can make sure only admins can make changes
	 */
	public function __construct()
	{
		// Make sure the user is an application administrator
		if (Kohana::config('argentum.installed'))
			Auth::instance()->logged_in('admin') OR Event::run('system.404');

		parent::__construct();
	}

	/**
	 * Displays the application settings list
	 */
	public function index() {}

	/**
	 * Updates main application settings
	 */
	public function application()
	{
		$settings = new Settings_Model();
		$this->view->settings = $settings;
		$this->view->errors = '';

		if ( ! $_POST)
		{
			$this->view->status = NULL;
		}
		else
		{
			$settings->set_fields($this->input->post());
			$settings->installed = TRUE;
			try
			{
				$settings->save();
				$this->template->body->status = TRUE;
			}
			catch (Kohana_User_Exception $e)
			{
				$this->view->errors = $e;
				$this->view->settings = $settings;
				$this->view->status = FALSE;
			}
		}
	}

	/**
	 * Updates installed/activated modules
	 */
	public function modules()
	{
		$settings = new Settings_Model();
		$db = new Database();

		// Update the module list in the database
		$d = dir(MODPATH.'argentum/');
		$directories = array();
		while (($entry = $d->read()) !== FALSE)
		{
			// Set the module to not enabled by default
			// Don't include hidden folders
			if ($entry[0] != '.') $directories[$entry] = FALSE;
		}

		// Sync the folder with the database
		foreach ($directories as $dir => $found)
		{
			if ( ! count($db->from('modules')->where('name', $dir)->limit(1)->get()))
			{
				$module = new Module_Model();
				$module->name = $dir;
				$module->save();
			}
		}

		// Now remove the ones that weren't found from the database
		foreach (Auto_Modeler_ORM::factory('module')->fetch_all() as $module)
			if ( ! array_key_exists($module->name, $directories))
				$module->delete();
			else
				$directories[$module->name] = $module;

		if ( ! $_POST)
		{
			$this->view->status = NULL;
			$this->view->modules = $directories;
		}
		else
		{
			try
			{
				unset($_POST['go']);
				// First unset everything
				$db->query('UPDATE `'.Kohana::config('database.default.table_prefix').'modules` SET `active` = 0');

				// Then set all the applicable modules
				foreach ($this->input->post() as $field => $active)
				{
					$module = new Module_Model($field);
					// Make sure we run the installer if it hasnt been installed yet.
					// Then mark it as installed
					if (count($db->getwhere('modules', array('installed' => FALSE, 'name' => $field))))
					{
						Kohana::config_set('core.modules', array_merge(Kohana::config('core.modules'), array(MODPATH.'argentum/'.$field)));
						$class = ucfirst($field).'_Install';
						if ($path = Kohana::find_file('libraries', $field.'_install'))
						{
							include $path;

							// Run the installer
							$install = new $class;
							$install->run_install();
						}
					}

					$module->active = TRUE;
					$module->installed = TRUE;
					$module->save();
				}

				Database::instance()->clear_cache();
				foreach (Auto_Modeler_ORM::factory('module')->fetch_all() as $module)
					$directories[$module->name] = $module;

				$this->view->status = TRUE;
				$this->view->modules = $directories;
			}
			catch (Kohana_Database_Exception $e)
			{
				$this->view->status = FALSE;
				$this->view->modules = $directories;
			}
		}
	}

	/**
	 * Uninstalls a module, and runs the module uninstaller
	 */
	public function uninstall_module($module)
	{
		Kohana::config_set('core.modules', array_merge(Kohana::config('core.modules'), array(MODPATH.'argentum/'.$module)));
		if ($path = Kohana::find_file('libraries', $module.'_install'))
		{
			include $path;

			// Run the uninstaller
			$class = ucfirst($module).'_Install';
			$install = new $class;
			$install->uninstall();
		}

		$module = new Module_Model($module);

		$module->installed = FALSE;
		$module->active = FALSE;
		$module->save();

		url::redirect('admin/settings/modules');
	}

	public function install($step = 1)
	{
		switch ($step)
		{
			case 1:
				$this->template->content = $this->view = new View('admin/settings/install/1');

				// Check for writable files
				$configs = array('database.php' => is_writable(APPPATH.'config/database.php'),
				                 'argentum.php' => is_writable(APPPATH.'config/argentum.php'));
				$this->view->configs = $configs;
				break;
			case 2:
				// Validate the input
				$post = Validation::factory($_POST)
				                    ->pre_filter('trim')
				                    ->add_rules('host', 'required')
				                    ->add_rules('database', 'required', 'alpha_dash')
				                    ->add_rules('username', 'required', 'alpha_dash')
				                    ->add_rules('password', 'required');
				if ( ! $post->validate())
				{
					$this->install(1);
					$this->view->set($this->input->post());
					$this->view->errors = View::factory('form_errors')->set(array('errors' => $post->errors('form_errors')));
					return;
				}

				// Create the database config file
				$database = new View('admin/settings/database_config');
				$database->set($this->input->post());

				// Write the new file
				$handle = fopen(APPPATH.'config/database.php', 'w');
				fwrite($handle, $database->render());

				fclose($handle);

				// Try a database query to make sure the settings are valid
				try
				{
					// Suppress warnings for this test
					error_reporting(0);
					$db = new Database;
					$result = $db->query('CREATE TABLE `argentum_test` (`id` INT NOT NULL)');

					if ($error = mysql_error())
					{
						$post->add_error('database', 'invalid_settings');
						$this->install(1);
						$this->view->set($this->input->post());
						$this->view->errors = View::factory('form_errors')->set(array('errors' => $post->errors('form_errors')));
						return;
					}
					$db->query('DROP TABLE `argentum_test`');
					error_reporting(E_ALL ^ E_NOTICE);
				}
				catch (Kohana_Database_Exception $e)
				{
					Kohana::log('error', $e);
					$post->add_error('database', 'invalid_settings');
					$this->install(1);
					$this->view->set($this->input->post());
					$this->view->errors = View::factory('form_errors')->set(array('errors' => $post->errors('form_errors')));
					return;
				}

				$this->template->content = $this->view = new View('admin/settings/install/2');
				$this->view->user = new User_Model();
				break;
			case 3:
				// Install the Databases
				$db = Database::instance();

				// Only run the schema files if the tables don't exist
				// Inspired by http://us2.php.net/manual/en/function.mysql-query.php#85876
				if ( ! $db->table_exists('users'))
				{
					$tables = View::factory('admin/settings/schema/tables')->render();
					$query = '';
					foreach (explode("\n", $tables) as $sql)
					{
						if (trim($sql) != "" AND strpos($sql, "--") === FALSE)
						{
							$query .= $sql;
							if (preg_match("/;[\040]*\$/", $sql))
							{
								$db->query($query);
								$query = '';
							}
						}
					}

					$constriants = View::factory('admin/settings/schema/constraints')->render();
					$query = '';
					foreach (explode("\n", $constriants) as $sql)
					{
						if (trim($sql) != "" AND strpos($sql, "--") === false)
						{
							$query .= $sql;
							if (preg_match("/;[\040]*\$/", $sql))
							{
								$db->query($query);
								$query = '';
							}
						}
					}

					$data = View::factory('admin/settings/schema/data')->render();
					$query = '';
					foreach (explode("\n", $data) as $sql)
					{
						if (trim($sql) != "" AND strpos($sql, "--") === false)
						{
							$query .= $sql;
							if (preg_match("/;[\040]*\$/", $sql))
							{
								$db->query($query);
								$query = '';
							}
						}
					}
				}

				$admin_user = new User_Model();
				$admin_user->username = $this->input->post('username');
				$admin_user->password = $this->input->post('password');
				$admin_user->email = $this->input->post('email');
				$admin_user->first_name = $this->input->post('first_name');
				$admin_user->last_name = $this->input->post('last_name');

				try
				{
					$admin_user->save();
					$admin_user->roles = 1;
					$admin_user->roles = 2;
				}
				catch (Kohana_User_Exception $e)
				{
					$this->install(2);
					$this->template->body->user = new User_Model();
				}

				$this->template->content = $this->view = new View('admin/settings/install/3');

				break;
			case 4:
				$settings = new Settings_Model();
				$settings->set_fields($this->input->post());
				$settings->installed = TRUE;
				try
				{
					$settings->save();
					$this->template->content = $this->view = new View('admin/settings/install/4');
				}
				catch (Kohana_User_Exception $e)
				{
					$this->install(3);
					$this->view->errors = $e;
					$this->view->set($this->input->post());
				}
				break;
		}
	}

	/**
	 * Backups the database as a file the user can download
	 */
	public function backup_database()
	{
		$db = Database::instance();

		$tables_to_dump = array('client', 'contact', 'currency', 'invoice', 'invoice_payment', 'module', 'operation_type', 'project', 'role', 'ticket', 'time', 'user');

		// Add the table structure
		$sql = View::factory('admin/settings/schema/tables')->render()."\n";
		// Add the constraints
		$sql.= View::factory('admin/settings/schema/constraints')->render()."\n";

		// Dump the data
		foreach ($tables_to_dump as $model)
		{
			$model_name = $model.'_Model';
			$old = $model;
			$model = new $model_name;

			$rows = $model->fetch_all();
			foreach ($rows as $row)
			{
				$row = $row->as_array();
				$sql.= 'INSERT INTO `'.inflector::plural($old).'` ('.implode(',', array_keys($row)).') VALUES ('.implode(',', array_values($row)).')'."\n";
			}
		}

		header('Content-Description: File Transfer');
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename=schema.sql');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: '.strlen($sql));
		ob_clean();
		flush();
		echo $sql;
		exit;
	}
}