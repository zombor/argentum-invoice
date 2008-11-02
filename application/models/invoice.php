<?php

class Invoice_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'invoices';
	
	protected $data = array('id' => '',
	                        'title' => '',
	                        'date' => '',
	                        'comments' => '',
	                        'client_id' => '');

	public function total_income()
	{
		if ( ! $this->data['id'])
			return 0;

		$total_income = 0;
		// Find all the tickets and get the total cost of them
		foreach ($this->find_related('tickets') as $ticket)
			$total_income+=$ticket->operation_type->rate*$ticket->total_time;

		return $total_income;
	}

	public function total_paid()
	{
		$total_paid = 0;

		foreach (Auto_Modeler_ORM::factory('invoice_payment')->fetch_some(array('invoice_id' => $this->data['id'])) as $payment)
			$total_paid+=$payment->amount;

		return $total_paid;
	}

	public function find_operation_types()
	{
		if ( ! $this->data['id'])
			return array('name' => '', 'rate' => 0, 'time' => 0);

		$return = array();

		foreach ($this->find_related('tickets') as $ticket)
		{
			if ( ! isset($return[$ticket->operation_type->id]))
				$return[$ticket->operation_type->id] = array('name' => $ticket->operation_type->name,
				                                             'rate' => $ticket->operation_type->rate,
				                                             'time' => $ticket->total_time);
			else
				$return[$ticket->operation_type->id]['time']+=$ticket->total_time;
		}

		return $return;
	}

	public function find_invoices_by_date($start_date, $end_date)
	{
		$sql = 'SELECT * FROM `invoices` WHERE `date` >= ? AND `date` < ? ORDER BY `id` DESC';
		return $this->db->query($sql, array($start_date, $end_date))->result(TRUE, 'Invoice_Model');
	}
}