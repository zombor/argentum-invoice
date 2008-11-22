<?php
/**
 * Settings model
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Settings_Model extends Auto_Modeler
{
	protected $table_name = 'settings';
	
	protected $data = array('id' => NULL,
	                        'company_name' => '',
	                        'company_address' => '',
	                        'company_city' => '',
	                        'company_state' => '',
	                        'company_zip' => '',
	                        'default_currency' => '');

	protected $rules = array('company_name' => array('required', 'standard_text'),
	                         'company_address' => array('required', 'standard_text'),
	                         'company_city' => array('required', 'standard_text'),
	                         'company_state' => array('required', 'standard_text'),
	                         'company_zip' => array('required', 'numeric'),
	                         'default_currency' => array('required'));

	// Overloading the constructor to load from the config file
	public function __construct()
	{
		$this->data['company_name'] = Kohana::config('argentum.company_name');
		$this->data['company_address'] = Kohana::config('argentum.company_address');
		$this->data['company_city'] = Kohana::config('argentum.company_city');
		$this->data['company_state'] = Kohana::config('argentum.company_state');
		$this->data['company_zip'] = Kohana::config('argentum.company_zip');
		$this->data['default_currency'] = Kohana::config('argentum.default_currency');
	}

	// Overload the save method to save to a file instead of the database
	public function save()
	{
		$data = Validation::factory($this->data)->pre_filter('trim');

		// Process the rules
		foreach ($this->rules as $field => $rule)
			foreach ($rule as $sub_rule)
				$data->add_rules($field, $sub_rule);

		if ($data->validate())
		{
			// Save the settings
			$settings = new View('admin/settings/argentum_config');
			$settings->set($this->data);

			$handle = fopen(APPPATH.'config/argentum.php', 'w');
			fwrite($handle, $settings->render());

			fclose($handle);

			return TRUE;
		}

		// Throw an exception because there is bad data
		$errors = View::factory('form_errors')->set(array('errors' => $data->errors('form_errors')));
		throw new Kohana_User_Exception('auto_modeler.validation_error', $errors->render());
	}
}