<?php
/**
 * Model for live timer
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Live_Timer_Model extends Auto_Modeler_ORM {

	protected $table_name = 'live_timers';

	protected $data = array('id' => NULL,
	                        'user_id' => NULL,
	                        'ticket_id' => NULL,
	                        'start_time' => '');

	protected $rules = array('user_id' => array('required', 'numeric'),
	                         'ticket_id' => array('required', 'numeric'),
	                         'start_time' => array('numeric'));

	public function __set($key, $val)
	{
		// Convert a string time to a unix time stamp
		if ($key == 'start_time' AND ! valid::digit($val))
		{
			$this->data[$key] = strtotime($val);
		}
		else
			parent::__set($key, $val);
	}

	public function set_fields($data = array())
	{
		foreach ($data as $key => $value)
		{
			// Convert a string time to a unix time stamp
			if (in_array($key, array('start_time', 'end_time')) AND ! is_int($value))
			{
				$this->data[$key] = strtotime($value);
			}
			else if (array_key_exists($key, $this->data))
				$this->data[$key] = $value;
		}
	}

	/**
	 * Determines if a ticket has a current live timer on it
	 * @param int $ticket_id
	 * @param int $user_id
	 */
	public function is_ticket_active($ticket_id, $user_id)
	{
		return (bool) $this->db->where(array('ticket_id' => $ticket_id, 'user_id' => $user_id))->count_records($this->table_name);
	}
}