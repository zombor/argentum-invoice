<?php

class Ticket_Controller extends Website_Controller {

	public function add($project_id)
	{
		$ticket = new Ticket_Model();
		$ticket->project_id = $project_id;

		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/ticket/add');
			$this->template->body->errors = '';
			$this->template->body->ticket = $ticket;
		}
		else
		{
			$ticket->set_fields($this->input->post());
			$ticket->creation_date = time();

			try
			{
				$ticket->save();
				url::redirect('ticket/active/'.$ticket->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/ticket/add');
				$this->template->body->ticket = $ticket;
				$this->template->body->errors = $e;
				$this->template->body->set($this->input->post());
			}
		}
	}
	
	public function edit($id)
	{
		$ticket = new Ticket_Model($id);
		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/ticket/edit');
			$this->template->body->errors = '';
			$this->template->body->ticket = $ticket;
		}
		else
		{
			$ticket->set_fields($this->input->post());
			$ticket->complete = $this->input->post('complete', FALSE);

			if ($ticket->complete)
				$ticket->close_date = time();

			try
			{
				$ticket->save();
				url::redirect('ticket/'.($ticket->complete ? 'closed' : 'active').'/'.$ticket->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/ticket/edit');
				$this->template->body->ticket = $ticket;
				$this->template->body->errors = $e;
				$this->template->body->set($this->input->post());
			}
		}
	}
	
	public function delete()
	{
		Auto_Modeler_ORM::factory('ticket', $this->input->post('id'))->delete();
		url::redirect('ticket/view_project/');
	}
}