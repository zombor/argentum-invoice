<?php

class Operation_type_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'operation_types';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'rate' => '');

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'rate' => array('required', 'numeric'));
}