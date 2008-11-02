<?php

/*
*  class:       Time_Controller
*  description: Provides application support for time including adding, editing and deleting
*/
class Time_Controller extends Website_Controller {

	/*
	*  function:     add
	*  description:  Creates a new time netry
	*  parameters:   $_POST: Contains the post data to create the time entry
	*/
	public function add($ticket_id)
	{
		$time = new Time_Model();
		$time->ticket_id = $ticket_id;

		if ( ! $_POST) // Display the form
		{
			$this->template->body = new View('admin/time/add');
			$this->template->body->errors = '';
			$this->template->body->time = $time;
		}
		else
		{
			$time->set_fields($this->input->post());

			try
			{
				$time->save();

				if ($this->input->post('ticket_complete'))
				{
					$ticket = new Ticket_Model($time->ticket_id);
					$ticket->complete= TRUE;
					$ticket->close_date = time();
					$ticket->save();
				}

				url::redirect('ticket/'.($time->ticket->complete ? 'closed' : 'active').'/'.$time->ticket->project->id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body = new View('admin/time/add');
				$this->template->body->time = $time;
				$this->template->body->errors = $e;
				$this->template->body->set($this->input->post());
			}
		}
	}

	/*
	*  function:     delete
	*  description:  Deletes an existing time entry
	*  parameters:   $_POST['id']: ID of the time entry to delete
	*/
	public function delete()
	{
		$time = new Time_Model($this->input->post('id'));
		$time->delete();
		url::redirect('ticket/'.($time->ticket->complete ? 'closed' : 'active').'/'.$time->ticket->project->id);
	}
}