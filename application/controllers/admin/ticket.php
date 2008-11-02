<?php

/*
*  class:       Ticket_Controller
*  description: Provides application support for adding, editing and deleting tickets
*/
class Ticket_Controller extends Website_Controller {

	/*
	*  function:     add
	*  description:  Creates a new ticket
	*  parameters:   $project_id: The project to add the ticket to
	*                $_POST: Contains the post data to create the ticket
	*/
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
			}
		}
	}

	/*
	*  function:     edit
	*  description:  Updates an existing ticket
	*  parameters:   $id: The ticket ID
	*                $_POST: Contains the post data to update the ticket
	*/
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
			}
		}
	}

	/*
	*  function:     delete
	*  description:  Deletes a ticket
	*  parameters:   $_POST['id']: ID of the ticket to delete
	*/
	public function delete()
	{
		Auto_Modeler_ORM::factory('ticket', $this->input->post('id'))->delete();
		url::redirect('ticket/view_project/');
	}
}