<?php

class Client_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'clients';
	
	protected $data = array('id' => '',
	                        'company_name' => '',
	                        'short_name' => '',
	                        'contact_first_name' => '',
	                        'contact_last_name' => '',
	                        'mailing_address' => '',
	                        'mailing_city' => '',
	                        'mailing_zip_code' => '',
	                        'email_address' => '',
	                        'phone_number' => '',
	                        'tax_exempt' => FALSE);

	protected $rules = array('company_name' => array('required'),
	                         'contact_first_name' => array('required', 'standard_text'),
	                         'contact_last_name' => array('required'),
	                         'email_address' => array('required', 'email'),
	                         'phone_number' => array('phone'),
	                         'mailing_zip_code' => array('numeric'));

	// Overriding the save method to set the short_name (url::title() of the company_name)
	public function save($extra_data = array(), $extra_validation_methods = array())
	{
		$this->data['short_name'] = url::title($this->data['company_name']);
		return parent::save($extra_data, $extra_validation_methods);
	}
}