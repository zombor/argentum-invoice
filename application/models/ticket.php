<?php

class Ticket_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'tickets';
	
	protected $data = array('id' => '',
	                        'user_id' => '',
	                        'project_id' => '',
	                        'description' => '',
	                        'creation_date' => '',
	                        'close_date' => '',
	                        'complete' => FALSE,
	                        'billable' => TRUE,
	                        'invoiced' => FALSE,
	                        'invoice_id' => NULL);

	protected $rules = array('project_id' => array('required', 'numeric'),
	                         'user_id' => array('required', 'numeric'),
	                         'description' => array('required'),
	                         'billable' => array('numeric'));
}