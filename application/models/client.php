<?php
/**
 * Client model
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Client_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'clients';
	
	protected $data = array('id' => NULL,
	                        'company_name' => '',
	                        'short_name' => '',
	                        'contact_first_name' => '',
	                        'contact_last_name' => '',
	                        'mailing_address' => '',
	                        'mailing_city' => '',
	                        'mailing_state' => '',
	                        'mailing_zip_code' => '',
	                        'email_address' => '',
	                        'phone_number' => '',
	                        'tax_rate' => 0.0);

	protected $rules = array('company_name' => array('required'),
	                         'contact_first_name' => array('required', 'standard_text'),
	                         'contact_last_name' => array('required'),
	                         'email_address' => array('required', 'email'),
	                         'phone_number' => array('phone'),
	                         'mailing_zip_code' => array('numeric'),
	                         'tax_rate' => array('numeric'),
	                         'mailing_address' => array('required'),
	                         'mailing_city' => array('required'),
	                         'mailing_state' => array('required'),
	                         'mailing_zip_code' => array('numeric'));

	// Overloading constructor to load by a second column
	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL)
		{
			// try and get a row with this ID
			$data = $this->db->from($this->table_name)->orwhere(array('id' => $id, 'short_name' => $id))->get()->result(FALSE);

			// try and assign the data
			if (count($data) == 1 AND $data = $data->current())
			{
				foreach ($data as $key => $value)
					$this->data[$key] = $value;
			}
		}
	}

	// Overloading the save method to set the short_name (url::title() of the company_name)
	public function save($extra_data = array(), $extra_validation_methods = array())
	{
		$this->data['short_name'] = url::title($this->data['company_name']);
		return parent::save($extra_data, $extra_validation_methods);
	}

	/**
	 * Searches for a client
	 *
	 * @return object
	 */
	public function search($term)
	{
		$like = array('company_name' => $term,
		              'contact_first_name' => $term,
		              'contact_last_name' => $term,
		              'mailing_city' => $term,
		              'mailing_zip_code' => $term,
		              'email_address' => $term);
		return $this->db->from($this->table_name)->orlike($like)->get()->result(TRUE, 'Client_Model');
	}
	
	/**
	 * Returns the company's contact full name in the format of: First Last
	 *
	 * @return string full name
	 */
	public function contact_full_name()
	{
		return $this->contact_first_name.' '.$this->contact_last_name;
	}
}