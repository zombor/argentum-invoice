<?php
/**
 * Currency Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Currency_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'currencies';

	protected $data = array('id' => NULL,
	                        'name' => '',
	                        'symbol' => '');
}