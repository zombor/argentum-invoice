<?php

class Time_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'time';
	
	protected $data = array('id' => '',
	                        'ticket_id' => '',
	                        'start_time' => '',
	                        'end_time' => '');

	protected $rules = array('ticket_id' => array('required', 'numeric'),
	                         'start_time' => array('required', 'numeric'),
	                         'end_time' => array('required', 'numeric'));
}