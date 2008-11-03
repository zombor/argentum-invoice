<?php

class Time_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'time';
	
	protected $data = array('id' => '',
	                        'ticket_id' => '',
	                        'user_id' => '',
	                        'start_time' => '',
	                        'end_time' => '');

	protected $rules = array('ticket_id' => array('required', 'numeric'),
	                         'start_time' => array('required', 'numeric'),
	                         'end_time' => array('required', 'numeric'));

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
}