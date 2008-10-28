<?php

class Client_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'clients';
	
	protected $data = array('id' => '',
	                        'user_id' => '',
	                        'project_id' => '',
	                        'description' => '',
	                        'creation_date' => '',
	                        'close_date' => '',
	                        'complete' => '',
	                        'billable' => '',
	                        'invoiced' => '',
	                        'invoice_id' => '');

}