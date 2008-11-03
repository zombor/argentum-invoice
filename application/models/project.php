<?php

class Project_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'projects';
	
	protected $data = array('id' => '',
	                        'name' => '',
	                        'client_id' => '',
	                        'notes' => '',
	                        'complete' => FALSE,
	                        'taxable' => FALSE);

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'client_id' => array('required', 'numeric'),
	                         'notes' => array());

	public function search($term)
	{
		$like = array('name' => $term,
		              'notes' => $term);
		return $this->db->from($this->table_name)->orlike($like)->get()->result(TRUE, 'Project_Model');
	}

	public function find_unbilled($client_id)
	{
		$projects = array('tickets' => array(),
		                  'non_hourly' => array());

		$sql = 'SELECT `tickets`.* FROM `tickets` LEFT JOIN `projects` ON `tickets`.`project_id` = `projects`.`id` WHERE `projects`.`client_id` = ? AND `projects`.`complete` = 0 AND `tickets`.`invoiced` = 0';

		foreach ($this->db->query($sql, array($client_id))->result(TRUE, 'Ticket_Model') as $ticket)
		{
			if ( ! isset($projects['tickets'][$ticket->project_id]))
				$projects['tickets'][$ticket->project_id] = array($ticket->id => $ticket);
			else
				$projects['tickets'][$ticket->project_id][$ticket->id] = $ticket;
		}

		$sql = 'SELECT `non_hourly`.* FROM `non_hourly` LEFT JOIN `projects` ON `non_hourly`.`project_id` = `projects`.`id` WHERE `projects`.`client_id` = ? AND `projects`.`complete` = 0 AND `non_hourly`.`invoiced` = 0';

		foreach ($this->db->query($sql, array($client_id))->result(TRUE, 'Non_hourly_Model') as $non_hourly)
		{
			if ( ! isset($projects['non_hourly'][$non_hourly->project_id]))
				$projects['non_hourly'][$non_hourly->project_id] = array($non_hourly->id => $non_hourly);
			else
				$projects['non_hourly'][$non_hourly->project_id][$non_hourly->id] = $non_hourly;
		}

		return $projects;
	}
}