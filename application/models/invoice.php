<?php

class Invoice_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'invoices';
	
	protected $data = array('id' => '',
	                        'title' => '',
	                        'date' => '',
	                        'comments' => '',
	                        'client_id' => '');

}