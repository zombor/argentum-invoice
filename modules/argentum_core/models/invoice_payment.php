<?php
/**
 * Invoice Payment Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Invoice_Payment_Model extends Auto_Modeler_ORM {

	protected $table_name = 'invoice_payments';

	protected $data = array('id' => NULL,
	                        'invoice_id' => '',
	                        'amount' => '',
	                        'date' => 0);

	protected $belongs_to = array('users');

	protected $rules = array('invoice_id' => array('required', 'numeric'),
	                         'amount' => array('required', 'numeric'),
	                         'date' => array('required', 'numeric'));

	public function __set($key, $value)
	{
		if ($key == 'date')
			$this->data[$key] = strtotime($value);
		else
			parent::__set($key, $value);
	}

	public function __get($key)
	{
		if ($key == 'date')
			return date('Y/m/d', $this->data['date'] == 0 ? time() : $this->data['date']);
		else
			return parent::__get($key);
	}
} // End Invoice_Payment_Model