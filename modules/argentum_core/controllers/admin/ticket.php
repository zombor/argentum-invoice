<?php
/**
 * Admin Ticket Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Ticket_Controller extends Website_Controller {

	/**
	 *  Creates a new ticket for a project
	 */
	public function add($project_id, $ajax = FALSE)
	{
		$ticket = new Ticket_Model();
		$ticket->project_id = $project_id;

		$this->template->body = new View('admin/ticket/add');
		$this->template->body->errors = '';
		$this->template->body->ticket = $ticket;

		// If we have post data, make a ticket
		if ($_POST)
		{
			$ticket->set_fields($this->input->post());
			$ticket->creation_date = time();
			$ticket->user_id = $_POST['user_id'] == '' ? NULL : $this->input->post('user_id');
			$ticket->created_by = $_SESSION['auth_user']->id;

			try
			{
				if ( ! $ticket->rate)
					$ticket->rate = $ticket->operation_type->rate;
				else
					$ticket->operation_type_id = NULL;
				$ticket->save();

				// Run any ticket creation events
				Event::run('argentum.ticket_create', $ticket);

				if (request::is_ajax())
					$this->template->body = View::factory('ticket/view')->bind('ticket', $ticket);
				else
					url::redirect('ticket/active/'.$ticket->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->ticket = $ticket;
				$this->template->body->errors = $e;
			}
		}
	}

	/**
	 *  Updates a ticket for a project
	 */
	public function edit($id)
	{
		$ticket = new Ticket_Model($id);
		
		$this->template->body = new View('admin/ticket/edit'.($ticket->operation_type_id ? '' : '_physical'));
		$this->template->body->errors = '';
		$this->template->body->ticket = $ticket;

		if ($_POST)
		{
			$ticket->set_fields($this->input->post());
			$ticket->user_id = $_POST['user_id'] == '' ? NULL : $this->input->post('user_id');
			$ticket->complete = $this->input->post('complete', FALSE);
			$ticket->billable = $this->input->post('billable', FALSE);

			if ($ticket->complete)
			{
				$ticket->close_date = time();

				// Run any events for closing tickets
				Event::run('argentum.ticket_close', $ticket);
			}

			try
			{
				$ticket->save();

				// Run any ticekt update events
				Event::run('argentum.ticket_update', $ticket);

				if (request::is_ajax())
					$this->template->body = View::factory('ticket/view')->bind('ticket', $ticket);
				else
					url::redirect('ticket/'.($ticket->complete ? 'closed' : 'active').'/'.$ticket->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->ticket = $ticket;
				$this->template->body->errors = $e;
			}
		}
	}

	/**
	 *  Deletes a ticket
	 */
	public function delete($ticket_id)
	{
		$ticket = new Ticket_Model($ticket_id);

		if ( ! $ticket->id)
			Event::run('system.404');

		if (isset($_POST['confirm']))
		{
			$ticket->delete();
			Event::run('argentum.ticket_delete', $ticket);
			url::redirect('ticket/'.($ticket->complete ? 'closed' : 'active').'/'.$ticket->project_id);
		}
		elseif(isset($_POST['cancel']))
			url::redirect('ticket/'.($ticket->complete ? 'closed' : 'active').'/'.$ticket->project_id);

		$this->template->body = new View('admin/confirm');
	}
}