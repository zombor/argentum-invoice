<?php
/**
 * Contact Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Contact_Model extends Auto_Modeler_ORM {

	protected $table_name = 'contacts';

	protected $data = array('id' => NULL,
	                        'first_name' => '',
	                        'last_name' => '',
	                        'email' => '');

	protected $belongs_to = array('clients');

	protected $rules = array('first_name' => array('required', 'standard_text'),
	                         'last_name' => array('required', 'standard_text'),
	                         'email' => array('required', 'email'));

	protected function check_clients(Validation &$validation)
	{
		$validation->add_rules('client', 'required');
	}
}