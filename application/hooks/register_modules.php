<?php

class register_modules {

	public function __construct()
	{
		// Hook into routing
		Event::add('system.routing', array($this, 'register'));
	}

	public function register()
	{
		$db = Database::instance();
		$modules = array();
		// Get the list of modules from the db
		foreach ($db->get('modules', array('active' => TRUE, 'installed' => TRUE)) as $module)
		{
			$modules[] = MODPATH.'argentum/'.$module->name;
		}

		// Now set the modules
		Kohana::config_set('core.modules', array_merge(Kohana::config('core.modules'), $modules));

		// We need to manually include the hook file for each module,
		// because the additional modules aren't loaded until after the application hooks are loaded.
		foreach ($modules as $module)
		{
			$d = dir($module.'/hooks'); // Load all the hooks
			while (($entry = $d->read()) !== FALSE)
				if ($entry != '.' AND $entry != '..')
					include $module.'/hooks/'.$entry;
		}
	}
}

new register_modules;