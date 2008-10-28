<?php

class Non_hourly_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'non_hourly';
	
	protected $data = array('id' => '',
	                        'project_id' => '',
	                        'amount' => '',
	                        'description' => '',
	                        'cost' => '');

}