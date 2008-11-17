<?php defined('SYSPATH') or die('No direct script access.');

class Module_Model extends Auto_Modeler_ORM {

	protected $table_name = 'modules';

	protected $data = array('id' => '',
	                        'name' => '',
	                        'active' => FALSE,
	                        'installed' => FALSE);

	protected $rules = array('name' => array('required'));

	// Overloading constructor to load by a second column
	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL)
		{
			// try and get a row with this ID
			$data = $this->db->from($this->table_name)->orwhere(array('id' => $id, 'name' => $id))->get()->result(FALSE);

			// try and assign the data
			if (count($data) == 1 AND $data = $data->current())
			{
				foreach ($data as $key => $value)
					$this->data[$key] = $value;
			}
		}
	}
}