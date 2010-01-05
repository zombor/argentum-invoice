<?php
/**
 * Email Role Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Email_Role_Model extends Auto_Modeler_ORM {

	// Table name for the model
	protected $table_name = 'email_roles';

	// Data array for the model
	protected $data = array('id' => '',
	                        'user_id' => '',
	                        'ticket_create' => FALSE,
	                        'ticket_close' => FALSE,
	                        'ticket_update' => FALSE,
	                        'ticket_delete' => FALSE,
	                        'ticket_time' => FALSE,
	                        'project_create' => FALSE,
	                        'project_close' => FALSE);

	// Rules array for the model
	protected $rules = array('user_id' => array('required'));

	/**
	 * Overloading the constructor to load by a user_id
	 */
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