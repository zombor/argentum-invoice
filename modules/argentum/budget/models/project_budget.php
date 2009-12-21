<?php
/**
 * Email Role Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Project_Budget_Model extends Auto_Modeler_ORM {

	// Table name for the model
	protected $table_name = 'project_budgets';

	// Data array for the model
	protected $data = array('id' => '',
	                        'project_id' => '',
	                        'amount' => 0);

	// Rules array for the model
	protected $rules = array('project_id' => array('required'));

	/**
	 * Overloading the constructor to load by a user_id
	 */
	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL)
		{
			// try and get a row with this ID
			$data = $this->db->from($this->table_name)->where(array('project_id' => $id))->get()->result(FALSE);

			// try and assign the data
			if (count($data) == 1 AND $data = $data->current())
			{
				foreach ($data as $key => $value)
					$this->data[$key] = $value;
			}
		}
	}
}