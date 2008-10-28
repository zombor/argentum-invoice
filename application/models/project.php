<?php

class Project_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'projects';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'client_id' => '',
	                        'notes' => '');

	public function search($term)
	{
		$like = array('name' => $term,
		              'notes' => $term);
		return $this->db->from($this->table_name)->orlike($like)->get()->result(TRUE, 'Project_Model');
	}
}