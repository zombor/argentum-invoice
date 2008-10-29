<?php

class Project_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'projects';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'client_id' => '',
	                        'notes' => '');

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'client_id' => array('required', 'numeric'),
	                         'notes' => array('standard_text'));

	public function search($term)
	{
		$like = array('name' => $term,
		              'notes' => $term);
		return $this->db->from($this->table_name)->orlike($like)->get()->result(TRUE, 'Project_Model');
	}
}