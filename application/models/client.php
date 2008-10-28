<?php

class Client_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'clients';
	
	protected $data = array('id' => '',
	                        'company_name' => '',
	                        'contact_first_name' => '',
	                        'contact_last_name' => '',
	                        'mailing_address' => '',
	                        'mailing_city' => '',
	                        'mailing_zip_code' => '',
	                        'email_address' => '',
	                        'phone_number' => '',
	                        'tax_exempt' => FALSE);

}