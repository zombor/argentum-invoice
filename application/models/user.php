<?php defined('SYSPATH') or die('No direct script access.');

class User_Model extends Auto_Modeler_ORM {

	protected $table_name = 'users';

	protected $data = array('id' => '',
	                        'username' => '',
	                        'password' => '',
	                        'email' => '',
	                        'last_login' => '',
	                        'logins' => '');

	protected $rules = array('username' => array('required'),
	                         'email' => array('required', 'email'));

	protected $callbacks = array('username' => 'check_username');
	
	// Relationships
	protected $has_many = array('tokens', 'roles');
	protected $belongs_to = array();

	// User roles
	protected $roles = NULL;

	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL AND ctype_digit($id))
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
		else if ($id != NULL AND is_string($id))
		{
			// try and get a row with this username/email
			$data = $this->db->orwhere(array('username' => $id, 'email' => $id))->get($this->table_name)->result(FALSE);

			// try and assign the data
			if (count($data) == 1 AND $data = $data->current())
			{
				foreach ($data as $key => $value)
					$this->data[$key] = $value;
			}
		}
	}

	public function __set($key, $value)
	{
		if ($key === 'password')
		{
			// Use Auth to hash the password
			$value = Auth::instance()->hash_password($value);
		}

		parent::__set($key, $value);
	}

	/**
	 * Overloading the has method, to check for roles by name
	 */
	public function has($key, $value)
	{
		$f_key = inflector::singular($key).'_id';
		$this_key = inflector::singular($this->table_name).'_id';
		$key = inflector::plural($key);
		$join_table = $this->table_name.'_'.$key;

		if (in_array($key, $this->has_many))
		{
			if ($key == 'roles' AND is_string($value))
				return (bool) $this->db->select($key.'.id')->from($key)->where(array($join_table.'.'.$this_key => $this->data['id'], 'roles.name' => $value))->join($join_table, $join_table.'.'.$f_key, $key.'.id')->get()->count();
			else
				return (bool) $this->db->select($key.'.id')->from($key)->where(array($join_table.'.'.$this_key => $this->data['id'], $join_table.'.'.$f_key => $value))->join($join_table, $join_table.'.'.$f_key, $key.'.id')->get()->count();
		}
		return FALSE;
	}

	/**
	 * Tests if a username exists in the database.
	 *
	 * @param	string	 username to check
	 * @return	bool
	 */
	public function username_exists($name)
	{
		return (bool) $this->db->where('username', $name)->count_records('users');
	}
	
	/**
	 * validation callback for checking uniqueness of username
	 */
	public function check_username(Validation $validation, $input)
	{
		if ( ! $this->data['id'] AND count($this->db->from('users')->where('username', $validation[$input])->get()))
			$validation->add_error($input, 'duplicate_username');
	}
	
	
	/**
	 * validation callback for checking roles
	 */
	protected function check_roles(Validation &$validation)
	{
		$validation->add_rules('role', 'required');
	}
} // End User_Model