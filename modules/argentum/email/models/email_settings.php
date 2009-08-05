<?php
/**
 * Model for email config files
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Email_Settings_Model extends Auto_Modeler {

	// Table name for model
	protected $table_name = 'settings';

	// Data array for model
	protected $data = array('id' => '',
	                        'driver' => '',
	                        'hostname' => '',
	                        'username' => '',
	                        'password' => '',
	                        'sendmail_path' => '');

	// Rules array for model
	protected $rules = array('driver' => array('required', 'alpha_numeric'));

	/**
	 * Overloading the constructor to load from the config file
	 */
	public function __construct()
	{
		$this->data['driver'] = Kohana::config('email.driver');

		if ($this->data['driver'] == 'smtp')
		{
			$this->data['hostname'] = Kohana::config('email.options.hostname');
			$this->data['username'] = Kohana::config('email.options.username');
			$this->data['password'] = Kohana::config('email.options.password');
		}
		elseif ($this->data['driver'] == 'sendmail')
			$this->data['sendmail_path'] = Kohana::config('email.options');
	}

	/**
	 * Overload the save method to save to a file instead of the database
	 */
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
			$settings = new View('admin/settings/email');
			$settings->set($this->data);

			$handle = fopen(MODPATH.'argentum/email/config/email.php', 'w');
			fwrite($handle, $settings->render());

			fclose($handle);

			return TRUE;
		}

		// Throw an exception because there is bad data
		$errors = View::factory('form_errors')->set(array('errors' => $data->errors('form_errors')));
		throw new Kohana_User_Exception('auto_modeler.validation_error', $errors->render());
	}
}