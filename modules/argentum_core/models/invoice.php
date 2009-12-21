<?php
/**
 * Invoice Model
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Invoice_Model extends Auto_Modeler_ORM
{
	protected $table_name = 'invoices';
	
	protected $data = array('id' => NULL,
	                        'title' => '',
	                        'date' => '',
	                        'comments' => '',
	                        'client_id' => '',
	                        'currency_id' => '',
	                        'conversion_rate' => '',
	                        'due_date' => 0);

	/**
	 * Calculates the total income for this invoice
	 * @return double
	 */
	public function subtotal($convert = FALSE)
	{
		if ( ! $this->data['id'])
			return 0;

		$total_income = 0;
		// Find all the tickets and get the total cost of them
		foreach ($this->find_related('tickets') as $ticket)
			$total_income+=$ticket->operation_type_id ? $ticket->rate*$ticket->total_time : $ticket->rate;

		// Do a currency conversion if the client has a different currency
		if ($convert AND $this->currency->name != Kohana::config('argentum.default_currency'))
			$total_income*=$this->conversion_rate;

		return $total_income;
	}

	/**
	 * Finds all invoices created between a start and end date
	 * @return float
	 */
	public function find_sales_tax($convert = FALSE)
	{
		$total = 0;

		foreach ($this->find_related('tickets') as $ticket)
		{
			if ($ticket->project->taxable)
				$total+=($ticket->project->client->tax_rate/100)*$ticket->operation_type_id ? $ticket->rate*$ticket->total_time : $ticket->rate;
		}

		// Do a currency conversion if the client has a different currency
		if ($convert AND $this->client->currency->name != Kohana::config('argentum.default_currency'))
			$total*=$this->conversion_rate;

		return $total;
	}

	/**
	 * Calculates the total income for this invoice
	 * @return double
	 */
	public function total_income($convert = FALSE)
	{
		return $this->subtotal($convert)+$this->find_sales_tax($convert);
	}

	/**
	 * Calculates the total amount paid for this invoice
	 * @return double
	 */
	public function total_paid()
	{
		$total_paid = 0;

		foreach (Auto_Modeler_ORM::factory('invoice_payment')->fetch_where(array('invoice_id' => $this->data['id'])) as $payment)
			$total_paid+=$payment->amount;

		return $total_paid;
	}

	/**
	 * Finds the operation types for this invoice
	 * @return array operation type id with values as the total data for that operation
	 * @todo Fix bug if ticket rate is different than operation type rate.
	 */
	public function find_operation_types()
	{
		if ( ! $this->data['id'])
			return array('name' => '', 'rate' => 0, 'time' => 0);

		$return = array();

		foreach ($this->find_related('tickets') as $ticket)
		{
			if ($ticket->operation_type_id)
			{
				if ( ! isset($return[$ticket->operation_type->id.'_'.$ticket->rate]))
					$return[$ticket->operation_type->id.'_'.$ticket->rate] = array('id'   => $ticket->operation_type->id,
					                                                               'name' => $ticket->operation_type->name,
					                                                               'rate' => $ticket->rate,
					                                                               'time' => $ticket->total_time);
				else
					$return[$ticket->operation_type->id.'_'.$ticket->rate]['time']+=$ticket->total_time;
			}
			else
			{
				$return['physical'][] = array('id'   => NULL,
					                          'name' => $ticket->description,
					                          'rate' => $ticket->rate,
					                          'time' => NULL);
			}
		}

		return $return;
	}

	/**
	 * Finds all invoices created between a start and end date
	 * @param $start_date
	 * @param $end_date
	 * @return object
	 */
	public function find_invoices_by_date($start_date, $end_date)
	{
		$sql = 'SELECT * FROM `'.Kohana::config('database.default.table_prefix').'invoices` WHERE `date` >= ? AND `date` < ? ORDER BY `id` DESC';
		return $this->db->query($sql, array($start_date, $end_date))->result(TRUE, 'Invoice_Model');
	}
}