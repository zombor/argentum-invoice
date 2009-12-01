<?php
/**
 * Role Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Role_Model extends Auto_Modeler_ORM {

	protected $table_name = 'roles';

	protected $data = array('id' => NULL,
	                        'name' => '');

	protected $belongs_to = array('users');

} // End Role_Model