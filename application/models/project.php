<?php

class Project_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'projects';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'client_id' => '',
	                        'notes' => '');

}