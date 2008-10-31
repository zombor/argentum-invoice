<?php defined('SYSPATH') or die('No direct script access.');

class Invoice_Payment_Model extends Auto_Modeler_ORM {

	protected $table_name = 'invoice_payments';

	protected $data = array('id' => '',
	                        'invoice_id' => '',
	                        'amount' => '',
	                        'date' => '');

	protected $belongs_to = array('users');

	protected $rules = array('invoice_id' => array('required', 'numeric'),
	                         'amount' => array('required', 'numeric'),
	                         'date' => array('required', 'numeric'));

} // End Invoice_Payment_Model