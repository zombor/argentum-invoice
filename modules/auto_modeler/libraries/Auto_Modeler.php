<?php

class Auto_Modeler extends Model
{
	// The database table name
	protected $table_name = '';

	// The database fields
	protected $data = array();

	// Validation rules in a 'field' => 'rules' array
	protected $rules = array();
	protected $callbacks = array();

	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL)
		{
			// try and get a row with this ID
			$data = $this->db->getwhere($this->table_name, array('id' => $id))->result(FALSE);

			// try and assign the data
			if (count($data) == 1 AND $data = $data->current())
			{
				foreach ($data as $key => $value)
					$this->data[$key] = $value;
			}
		}
	}

	public function __destruct()
	{
		return TRUE;
	}

	// Magic __get() method
	public function __get($key)
	{
		if (isset($this->data[$key]))
			return $this->data[$key];
	}

	// Magic __set() method
	public function __set($key, $value)
	{
		if (empty($this->data[$key]) OR $this->data[$key] !== $value)
			$this->data[$key] = $value;
	}

	public function as_array()
	{
		return $this->data;
	}

	// Useful for one line method chaining
	// $model - The model name to make
	// $id - an id to create the model with
	public static function factory($model = FALSE, $id = FALSE)
	{
		$model = empty($model) ? __CLASS__ : ucfirst($model).'_Model';
		return new $model($id);
	}

	// Allows for setting data fields in bulk
	// $data - associative array to set $this->data to
	public function set_fields($data)
	{
		foreach ($data as $key => $value)
			if (isset($this->data[$key]))
				$this->data[$key] = $value;
	}

	// Saves the current object
	// $extra_data - additional methods to pass validation with
	public function save($extra_data = array(), $extra_validation_methods = array())
	{
		$data = Validation::factory(array_merge($extra_data, $this->data))->pre_filter('trim');

		foreach ($this->rules as $field => $rule)
		{
			foreach ($rule as $sub_rule)
				$data->add_rules($field, $sub_rule);
		}

		foreach ($this->callbacks as $field => $callback)
			$data->add_callbacks($field, array($this, $callback));

		// Process any custom user defined rules. Non-model field validation would go here.
		foreach ($extra_validation_methods as $validation_function)
			$this->$validation_function($data);

		if ($data->validate())
		{
			if ($this->data['id']) // Do an update
				return count($this->db->update($this->table_name, $this->data, array('id' => $this->data['id'])));
			else // Do an insert
			{
				$id = $this->db->insert($this->table_name, $this->data)->insert_id();
				return ($this->data['id'] = $id);
			}
		}

		$errors = View::factory('form_errors')->set(array('errors' => $data->errors('form_errors')));
		throw new Kohana_User_Exception('auto_modeler.validation_error', $errors->render());
	}

	// Deletes the current record and destroys the object
	public function delete()
	{
		if ($this->data['id'])
		{
			$this->db->delete($this->table_name, array('id' => $this->data['id']));
			return $this->__destruct();
		}
	}

	// Fetches all rows in the table
	// $order_by - the ORDER BY value to sort by
	// $direction - the direction to sort
	public function fetch_all($order_by = 'id', $direction = 'ASC')
	{
		return $this->db->orderby($order_by, $direction)->get($this->table_name)->result(TRUE, inflector::singular(ucwords($this->table_name)).'_Model');
	}

	// Does a basic search on the table.
	// $where - the where clause to search on
	// $order_by - the ORDER BY value to sort by
	// $direction - the direction to sort
	// $type - pass 'or' here to do a orwhere
	public function fetch_some($where = array(), $order_by = 'id', $direction = 'ASC', $type = '')
	{
		$function = $type.'where';
		return $this->db->$function($where)->orderby($order_by, $direction)->get($this->table_name)->result(TRUE, inflector::singular(ucwords($this->table_name)).'_Model');
	}

	// Returns an associative array to use in dropdowns and other widgets
	// $key - the key column of the array
	// $display - the value column of the array
	// $order_by - the direction to sort
	// $where - an optional where array to be passed if you don't want every record
	public function select_list($key, $display, $order_by = 'id', $where = array())
	{
		$rows = array();

		if (empty($where))
			foreach ($this->fetch_all($order_by) as $row)
				if (is_array($display))
				{
					$display_str = array();
					foreach ($display as $text)
						$display_str[] = $row->$text;
					$rows[$row->$key] = implode(' - ', $display_str);
				}
				else
					$rows[$row->$key] = $row->$display;
		else
			foreach ($this->db->where($where)->orderby($order_by)->get($this->table_name)->result(TRUE, inflector::singular(ucwords($this->table_name)).'_Model') as $row)
				if (is_array($display))
				{
					$display_str = array();
					foreach ($display as $text)
						$display_str[] = $row->$text;
					$rows[$row->$key] = implode(' - ', $display_str);
				}
				else
					$rows[$row->$key] = $row->$display;

		return $rows;
	}
}