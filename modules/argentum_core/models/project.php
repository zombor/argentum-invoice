<?php
/**
 * Project Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Project_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'projects';
	
	protected $data = array('id' => NULL,
	                        'name' => '',
	                        'client_id' => '',
	                        'notes' => '',
	                        'complete' => FALSE,
	                        'taxable' => FALSE);

	protected $rules = array('name' => array('required', 'standard_text'),
	                         'client_id' => array('required', 'numeric'),
	                         'notes' => array());

	/**
	 * Search projects by term in name and notes field
	 *
	 * @param  string   $term	Search term
	 * @return 
	 */
	public function search($term)
	{
		$like = array('name' => $term,
		              'notes' => $term);
		return $this->db->from($this->table_name)->orlike($like)->get()->result(TRUE, 'Project_Model');
	}

	/**
	 * Retrieves an array of unbilled projects by client ID
	 *
	 * @param   int    $client_id 	Client ID
	 * @return  array
	 */
	public function find_unbilled($client_id)
	{
		$projects = array('tickets' => array(),
		                  'non_hourly' => array());

		$sql = 'SELECT `'.Kohana::config('database.default.table_prefix').'tickets`.* FROM `'.Kohana::config('database.default.table_prefix').'tickets` LEFT JOIN `'.Kohana::config('database.default.table_prefix').'projects` ON `'.Kohana::config('database.default.table_prefix').'tickets`.`project_id` = `'.Kohana::config('database.default.table_prefix').'projects`.`id` WHERE `'.Kohana::config('database.default.table_prefix').'projects`.`client_id` = ? AND `'.Kohana::config('database.default.table_prefix').'projects`.`complete` = 0 AND `'.Kohana::config('database.default.table_prefix').'tickets`.`invoiced` = 0 AND `'.Kohana::config('database.default.table_prefix').'tickets`.`complete` = 1';

		foreach ($this->db->query($sql, array($client_id))->result(TRUE, 'Ticket_Model') as $ticket)
		{
			if ( ! isset($projects['tickets'][$ticket->project_id]))
				$projects['tickets'][$ticket->project_id] = array($ticket->id => $ticket);
			else
				$projects['tickets'][$ticket->project_id][$ticket->id] = $ticket;
		}

		$sql = 'SELECT `'.Kohana::config('database.default.table_prefix').'non_hourly`.* FROM `'.Kohana::config('database.default.table_prefix').'non_hourly` LEFT JOIN `'.Kohana::config('database.default.table_prefix').'projects` ON `'.Kohana::config('database.default.table_prefix').'non_hourly`.`project_id` = `'.Kohana::config('database.default.table_prefix').'projects`.`id` WHERE `'.Kohana::config('database.default.table_prefix').'projects`.`client_id` = ? AND `'.Kohana::config('database.default.table_prefix').'projects`.`complete` = 0 AND `'.Kohana::config('database.default.table_prefix').'non_hourly`.`invoiced` = 0';

		foreach ($this->db->query($sql, array($client_id))->result(TRUE, 'Non_hourly_Model') as $non_hourly)
		{
			if ( ! isset($projects['non_hourly'][$non_hourly->project_id]))
				$projects['non_hourly'][$non_hourly->project_id] = array($non_hourly->id => $non_hourly);
			else
				$projects['non_hourly'][$non_hourly->project_id][$non_hourly->id] = $non_hourly;
		}

		return $projects;
	}

	public function find_top_tickets($limit = 10)
	{
		$sql = 'SELECT p.*, (SELECT COUNT(*) FROM '.Kohana::config('database.default.table_prefix').'tickets AS t WHERE t.project_id = p.id AND t.complete = 0) AS ticket_count FROM '.Kohana::config('database.default.table_prefix').'projects AS p ORDER BY ticket_count DESC LIMIT 5';
		return $this->db->query($sql)->result(TRUE, 'Project_Model');
	}

	// Finds a project's total cost
	public function total_cost($convert = FALSE)
	{
		if ( ! $this->data['id'])
			return 0;

		$total_cost = 0;
		// Find all the tickets and get the total cost of them
		foreach ($this->find_related('tickets') as $ticket)
		{
			$total_cost+=$ticket->operation_type_id ? $ticket->rate*$ticket->total_time : $ticket->rate;

			if ($this->taxable)
				$total_cost+=($ticket->project->client->tax_rate/100)*$ticket->operation_type_id ? $ticket->rate*$ticket->total_time : $ticket->rate;
		}

		// Do a currency conversion if the client has a different currency
		if ($convert AND $this->currency->name != Kohana::config('argentum.default_currency'))
			$total_cost*=$this->conversion_rate;

		return $total_cost;
	}
}