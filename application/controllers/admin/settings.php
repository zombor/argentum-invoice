<?php

class Settings_Controller extends Website_Controller
{
	public function __construct()
	{
		// Make sure the user is an application administrator
		Auth::instance()->logged_in('admin') OR Event::run('system.404');

		parent::__construct();
	}
	public function index()
	{
		$this->template->body = new View('admin/settings/index');
	}

	public function application()
	{
		$settings = new Settings_Model();
		$this->template->body = new View('admin/settings/application');
		$this->template->body->settings = $settings;
		$this->template->body->errors = '';

		if ( ! $_POST)
		{
			$this->template->body->status = NULL;
		}
		else
		{
			$settings->set_fields($this->input->post());
			try
			{
				$settings->save();
				$this->template->body->status = TRUE;
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
				$this->template->body->settings = $settings;
				$this->template->body->status = FALSE;
			}
		}
	}

	// TODO: Find a better way!
	public function modules()
	{
		$settings = new Settings_Model();
		$this->template->body = new View('admin/settings/modules');
		$db = new Database();

		// Update the module list in the database
		$d = dir(MODPATH.'argentum/');
		$directories = array();
		while (($entry = $d->read()) !== FALSE)
		{
			// Set the module to not enabled by default
			if ($entry != '.' AND $entry != '..') $directories[$entry] = FALSE;
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
			{
				$module->delete();
			}
			else
				$directories[$module->name] = $module;

		if ( ! $_POST)
		{
			$this->template->body->status = NULL;
			$this->template->body->modules = $directories;
		}
		else
		{
			unset($_POST['go']);
			try
			{
				// First unset everything
				$db->query('UPDATE `modules` SET `active` = 0');

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
						include Kohana::find_file('libraries', $field.'_install');

						// Run the installer
						$install = new $class;
						$install->run_install();
					}

					$module->active = TRUE;
					$module->installed = TRUE;
					$module->save();
				}

				foreach (Auto_Modeler_ORM::factory('module')->fetch_all() as $module)
					$directories[$module->name] = $module;

				$this->template->body->status = TRUE;
				$this->template->body->modules = $directories;
			}
			catch (Kohana_Database_Exception $e)
			{
				$this->template->body->status = FALSE;
				$this->template->body->modules = ($directories + $_POST);
			}
		}
	}
	
	public function uninstall_module($module)
	{
		Kohana::config_set('core.modules', array_merge(Kohana::config('core.modules'), array(MODPATH.'argentum/'.$module)));
		$class = ucfirst($module).'_Install';
		include Kohana::find_file('libraries', $module.'_install');

		// Run the uninstaller
		$install = new $class;
		$install->uninstall();

		$module = new Module_Model($module);

		$module->installed = FALSE;
		$module->active = FALSE;
		$module->save();

		url::redirect('admin/settings/modules');
	}
}