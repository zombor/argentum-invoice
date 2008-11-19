<?php
/**
 * Ticket model
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Ticket_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'tickets';
	
	protected $data = array('id' => '',
	                        'user_id' => NULL,
	                        'created_by' => '',
	                        'project_id' => '',
	                        'description' => '',
	                        'creation_date' => '',
	                        'close_date' => '',
	                        'complete' => FALSE,
	                        'billable' => TRUE,
	                        'invoiced' => FALSE,
	                        'invoice_id' => NULL,
	                        'operation_type_id' => 1,
	                        'rate' => 0);

	protected $rules = array('project_id' => array('required', 'numeric'),
	                         'description' => array('required'),
	                         'billable' => array('numeric'));

	public function __get($key)
	{
		if ($key == 'total_time')
		{
			$total = 0;
			foreach ($this->find_related('time') as $time)
			{
				$total+=($time->end_time-$time->start_time)/60/60;
			}
			return $total;
		}
		else
			return parent::__get($key);
	}
}