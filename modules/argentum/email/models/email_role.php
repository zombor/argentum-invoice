<?php

class Email_Role_Model extends Auto_Modeler_ORM {

	protected $table_name = 'email_roles';

	protected $data = array('id' => '',
	                        'user_id' => '',
	                        'ticket_create' => FALSE,
	                        'ticket_close' => FALSE,
	                        'ticket_update' => FALSE,
	                        'ticket_time' => FALSE,
	                        'project_create' => FALSE,
	                        'project_close' => FALSE);

	protected $rules = array('user_id' => array('required'));

	// Overloading constructor to load by a second column
	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL)
		{
			// try and get a row with this ID
			$data = $this->db->from($this->table_name)->orwhere(array('id' => $id, 'user_id' => $id))->get()->result(FALSE);

			// try and assign the data
			if (count($data) == 1 AND $data = $data->current())
			{
				foreach ($data as $key => $value)
					$this->data[$key] = $value;
			}
		}
	}
}