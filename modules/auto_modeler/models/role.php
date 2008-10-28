<?php defined('SYSPATH') or die('No direct script access.');

class Role_Model extends Auto_Modeler_ORM {

	protected $table_name = 'roles';

	protected $data = array('id' => '',
	                        'name' => '');

	protected $belongs_to = array('users');

} // End Role_Model