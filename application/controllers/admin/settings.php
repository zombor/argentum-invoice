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
				$db->insert('modules', array('name' => $dir, 'active' => FALSE));
		}

		// Now remove the ones that weren't found from the database
		foreach ($db->get('modules') as $row)
			if ( ! array_key_exists($row->name, $directories))
				$db->delete('modules', array('name', $row->name));
			else if ($row->active)
				$directories[$row->name] = TRUE;
			else
				$directories[$row->name] = FALSE;

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

					$db->update('modules', array('active' => TRUE, 'installed' => TRUE), array('name' => $field));
				}

				foreach ($db->get('modules') as $row)
					if ($row->active)
						$directories[$row->name] = TRUE;
					else
						$directories[$row->name] = FALSE;

				$this->template->body->status = TRUE;
				$this->template->body->modules = ($directories + $_POST);
			}
			catch (Kohana_Database_Exception $e)
			{
				$this->template->body->status = FALSE;
				$this->template->body->modules = ($directories + $_POST);
			}
		}
	}
}