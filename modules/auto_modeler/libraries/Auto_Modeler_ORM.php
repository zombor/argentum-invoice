<?php

class Auto_Modeler_ORM extends Auto_Modeler
{
	protected $has_many = array();
	protected $belongs_to = array();

	public function __get($key)
	{
		// See if we are requesting a forgien key
		if (isset($this->data[$key.'_id']))
		{
			// Get the row from the forgien table
			return $this->db->from($key.'s')->where('id', $this->data[$key.'_id'])->get()->current();
		}
		else if (isset($this->data[$key]))
			return $this->data[$key];
	}

	public function __set($key, $value)
	{
		if (in_array($key, $this->has_many))
		{
			$this_key = inflector::singular($this->table_name).'_id';
			$f_key = inflector::singular($key).'_id';
			// See if this is already in the join table
			if (!count($this->db->getwhere($this->table_name.'_'.$key, array($f_key => $value, $this_key => $this->data['id']))))
			{
				// Insert
				$this->db->insert($this->table_name.'_'.$key, array($f_key => $value, $this_key => $this->data['id']));
			}
		}
		else if (in_array($key, $this->belongs_to))
		{
			$this_key = inflector::singular($this->table_name).'_id';
			$f_key = inflector::singular($key).'_id';
			// See if this is already in the join table
			if (!count($this->db->getwhere($key.'_'.$this->table_name, array($this_key => $value, $f_key => $this->data['id']))))
			{
				// Insert
				$this->db->insert($key.'_'.$this->table_name, array($f_key => $value, $this_key => $this->data['id']));
			}
		}
		else if (empty($this->data[$key]) OR $this->data[$key] !== $value)
			$this->data[$key] = $value;
	}

	public function relate($key, array $values, $overwrite = FALSE)
	{
		if (in_array($key, $this->has_many))
		{
			$this_key = inflector::singular($this->table_name).'_id';
			$f_key = inflector::singular($key).'_id';
			// See if this is already in the join table
			if (!count($this->db->getwhere($this->table_name.'_'.$key, array($f_key => $value, $this_key => $this->data['id']))))
			{
				// Insert
				$this->db->insert($this->table_name.'_'.$key, array($f_key => $value, $this_key => $this->data['id']));
			}
		}
	}

	public function find_related($key)
	{
		$model = inflector::singular($key).'_Model';
		$temp = new $model();
		if ($temp->has_attribute(inflector::singular($this->table_name).'_id')) // Look for a one to many relationship
		{
			return $this->db->from($key)->where(inflector::singular($this->table_name).'_id', $this->data['id'])->get()->result(TRUE, inflector::singular(ucwords($key)).'_Model');
		}
		else // Get a many to many relationship
		{
			$join_table = $this->table_name.'_'.$key;
			$this_key = inflector::singular($this->table_name).'_id';
			$f_key = inflector::singular($key).'_id';
	
			return $this->db->select($key.'.*')->from($key)->where($join_table.'.'.$this_key, $this->data['id'])->join($join_table, $join_table.'.'.$f_key, $key.'.id')->get()->result(TRUE, inflector::singular(ucwords($key)).'_Model');
		}
	}

	public function find_parent($key = NULL)
	{
		if ($this->has_attribute($key.'_id')) // Look for a one to many relationship
		{
			return $this->db->from(inflector::plural($key))->where('id', $this->data['id'])->get()->result(TRUE, ucwords($key).'_Model');
		}
		else
		{
			$join_table = $key.'_'.$this->table_name;
			$f_key = inflector::singular($this->table_name).'_id';
			$this_key = inflector::singular($key).'_id';

			return $this->db->select($key.'.*')->from($key)->where($join_table.'.'.$f_key, $this->data['id'])->join($join_table, $join_table.'.'.$this_key, $key.'.id')->get()->result(TRUE, inflector::singular(ucwords($key)).'_Model');
		}
	}

	// Value is an ID
	public function has($key, $value)
	{
		$join_table = $this->table_name.'_'.$key;
		$f_key = inflector::singular($key).'_id';
		$this_key = inflector::singular($this->table_name).'_id';

		if (in_array($key, $this->has_many))
		{
			return (bool) $this->db->select($key.'.id')->from($key)->where(array($join_table.'.'.$this_key => $this->data['id'], $join_table.'.'.$f_key => $value))->join($join_table, $join_table.'.'.$f_key, $key.'.id')->get()->count();
		}
		return FALSE;
	}

	public function remove($key, $id)
	{
		$f_table = inflector::plural($key);
		$this->db->delete($this->table_name.'_'.$f_table, array($key.'_id' => $id));
	}

	// Removes all child relationships of $key in the join table
	public function remove_all($key)
	{
		$f_table = $key;
		$this->db->delete($this->table_name.'_'.$f_table, array(inflector::singular($this->table_name).'_id' => $this->id));
	}

	// Removes all parent relationships of $key in the join table
	public function remove_parent($key)
	{
		$f_table = $key;
		$this->db->delete($f_table.'_'.$this->table_name, array(inflector::singular($this->table_name).'_id' => $this->id));
	}

	public function delete()
	{
		if ($this->data['id'])
		{
			$this->db->delete($this->table_name, array('id' => $this->data['id']));

			foreach ($this->has_many as $table)
			{
				$model = inflector::singular($table).'_Model';
				$temp = new $model();
				if ($temp->has_attribute(inflector::singular($this->table_name).'_id')) // one to many relationship
				{
					$this->db->from($table)->where(inflector::singular($this->table_name).'_id', $this->data['id'])->delete();
				}
				else // many to many relationship
				{
					// Now delete everything from the join tables
					$join_table = $this->table_name.'_'.$table;
					$this_key = inflector::singular($this->table_name).'_id';
					$this->db->delete($join_table, array($this_key => $this->data['id']));
				}
			}
		}
	}

	public function has_attribute($key)
	{
		return array_key_exists($key, $this->data);
	}
}