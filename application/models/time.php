<?php
/**
 * Time Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Time_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'time';

	protected $data = array('id' => NULL,
	                        'ticket_id' => '',
	                        'user_id' => '',
	                        'start_time' => '',
	                        'end_time' => '');

	protected $rules = array('ticket_id' => array('required', 'numeric'),
	                         'start_time' => array('required', 'numeric'),
	                         'end_time' => array('required', 'numeric'));

	protected $callbacks = array('end_time' => 'check_entered_time');

	public function __set($key, $val)
	{
		// Convert a string time to a unix time stamp
		if (($key == 'start_time' OR $key == 'end_time') AND ! valid::digit($val))
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
	 * Checks to see if a time block is valid
	 */
	public function check_entered_time(Validation $validation, $input)
	{
		if ($this->data['start_time'] > $validation[$input] OR $this->data['start_time'] == $validation[$input])
			$validation->add_error($input, 'invalid_time_input');
	}
}