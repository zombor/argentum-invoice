<?php
/**
 * Operation type model
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Operation_type_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'operation_types';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'rate' => '');

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'rate' => array('required', 'numeric'));
}