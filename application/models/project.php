<?php

class Project_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'projects';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'client_id' => '',
	                        'notes' => '',
	                        'complete' => FALSE);

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'client_id' => array('required', 'numeric'),
	                         'notes' => array());

	public function search($term)
	{
		$like = array('name' => $term,
		              'notes' => $term);
		return $this->db->from($this->table_name)->orlike($like)->get()->result(TRUE, 'Project_Model');
	}
	
	public function find_unbilled_tickets($client_id)
	{
		$projects = array();
		$sql = 'SELECT `tickets`.* FROM `tickets` LEFT JOIN `projects` ON `tickets`.`project_id` = `projects`.`id` WHERE `projects`.`client_id` = ? AND `projects`.`complete` = 0';
		
		foreach ($this->db->query($sql, array($client_id))->result(TRUE, 'Ticket_Model') as $ticket)
		{
			if ( ! isset($projects[$ticket->project_id]))
				$projects[$ticket->project_id] = array($ticket->id => $ticket);
			else
				$projects[$ticket->project_id][$ticket->id] = $ticket;
		}

		return $projects;
	}
}