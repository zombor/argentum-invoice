<?php
/**
 * Operation Type Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Operation_type_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'operation_types';
	
	protected $data = array('id' => NULL,
	                        'name' => '',
	                        'rate' => '');

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'rate' => array('required', 'numeric'));
}