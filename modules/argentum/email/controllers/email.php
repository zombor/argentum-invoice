<?php
/**
 * Controller actions for the email events
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Email_Controller extends Website_Controller {

	/**
	 * Sends an email when a project is created
	 */
	public function _project_create()
	{
		Email_Controller::send_mail('Project Created - ID:'.Event::$data->id.', '.Event::$data->name,
		                 View::factory('emails/project_create')->set(array('project' => Event::$data)),
		                 'project_create');
	}

	/**
	 * Sends an email when a project is closed
	 */
	public function _project_close()
	{
		Email_Controller::send_mail('Project Closed - ID:'.Event::$data->id.', '.Event::$data->name,
		                 View::factory('emails/project_close')->set(array('project' => Event::$data)),
		                 'project_close');
	}

	/**
	 * Sends an email when a ticket is created
	 */
	public function _ticket_create()
	{
		$swift = email::connect();
		$message = new Swift_Message('Ticket Created For Project #'.Event::$data->project->id.' - ID:'.Event::$data->id,
		                             View::factory('emails/ticket_create')->set(array('ticket' => Event::$data)),
		                             'text/html');
		$recipients = new Swift_RecipientList();

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->user_id));
		if (count($role) AND $role->current()->ticket_create)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->user_id);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->created_by));
		if (count($role) AND $role->current()->ticket_create)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->created_by);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}

	/**
	 * Sends an email when a ticket is closed
	 */
	public function _ticket_close()
	{
		$swift = email::connect();
		$message = new Swift_Message('Ticket Closed For Project #'.Event::$data->project->id.' - ID:'.Event::$data->id,
		                             View::factory('emails/ticket_close')->set(array('ticket' => Event::$data)),
		                             'text/html');
		$recipients = new Swift_RecipientList();

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->user_id));
		if (count($role) AND $role->current()->ticket_close)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->user_id);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->created_by));
		if (count($role) AND $role->current()->ticket_close)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->created_by);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}

	/**
	 * Sends an email when a ticket is updated
	 */
	public function _ticket_update()
	{
		$swift = email::connect();
		$message = new Swift_Message('Ticket Updated For Project #'.Event::$data->project->id.' - ID:'.Event::$data->id,
		                             View::factory('emails/ticket_update')->set(array('ticket' => Event::$data)),
		                             'text/html');
		$recipients = new Swift_RecipientList();

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->user_id));
		if (count($role) AND $role->current()->ticket_update)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->user_id);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->created_by));
		if (count($role) AND $role->current()->ticket_update)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->created_by);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}

	/**
	 * Sends an email when a ticket is deleted
	 */
	public function _ticket_delete()
	{
		$swift = email::connect();
		$message = new Swift_Message('Ticket Deleted For Project #'.Event::$data->project->id.' - ID:'.Event::$data->id,
		                             View::factory('emails/ticket_delete')->set(array('ticket' => Event::$data)),
		                             'text/html');
		$recipients = new Swift_RecipientList();

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->user_id));
		if (count($role) AND $role->current()->ticket_delete)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->user_id);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->created_by));
		if (count($role) AND $role->current()->ticket_delete)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->created_by);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}

	/**
	 * Sends an email when a tickethas time added to it
	 */
	public function _ticket_time()
	{
		$swift = email::connect();
		$message = new Swift_Message('Time Added On Ticket #'.Event::$data->ticket->id,
		                             View::factory('emails/ticket_time')->set(array('time' => Event::$data)),
		                             'text/html');
		$recipients = new Swift_RecipientList();

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->user_id));
		if (count($role) AND $role->current()->ticket_time)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->ticket->user_id);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		$role = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data->created_by));
		if (count($role) AND $role->current()->ticket_time)
		{
			$user = Auto_Modeler_ORM::factory('user', Event::$data->ticket->created_by);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}

	/**
	 * DRY method for project creation email
	 * @param string $title
	 * @param string body
	 * @param string column
	 */
	protected function send_mail($title, $body, $column)
	{
		// Send an email to all users who are set to receive emails on new projects
		$swift = email::connect();
		$message = new Swift_Message($title, $body, 'text/html');
		$recipients = new Swift_RecipientList();

		foreach (Auto_Modeler_ORM::factory('email_role')->fetch_where(array($column => TRUE)) as $role)
		{
			$user = new User_Model($role->user_id);
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}

	/**
	 * Saves the email role preferences for a user account
	 */
	public function _user_settings_save()
	{
		$roles = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => Event::$data['user']->id))->current();
		$roles->ticket_create = isset(Event::$data['settings']['ticket_create']);
		$roles->ticket_close = isset(Event::$data['settings']['ticket_close']);
		$roles->ticket_update = isset(Event::$data['settings']['ticket_update']);
		$roles->ticket_delete = isset(Event::$data['settings']['ticket_delete']);
		$roles->ticket_time = isset(Event::$data['settings']['ticket_time']);
		$roles->project_create = isset(Event::$data['settings']['project_create']);
		$roles->project_close = isset(Event::$data['settings']['project_close']);
		$roles->save();
	}

	/**
	 * Displays the email preferences screen for a user account
	 */
	public function _user_settings_display()
	{
		$roles = Auto_Modeler_ORM::factory('email_role')->fetch_where(array('user_id' => $_SESSION['auth_user']->id));

		// If the user doesn't have any roles, create an empty role row
		if ( ! count($roles))
		{
			$roles = new Email_Role_Model();
			$roles->user_id = $_SESSION['auth_user']->id;
			$roles->save();
		}
		else
			$roles = $roles->current();

		View::factory('user_settings_display')->set(array('roles' => $roles))->render(TRUE);
	}

	/**
	 * Displays the system settings link
	 */
	public function _system_settings_display()
	{
		View::factory('system_settings_display')->render(TRUE);
	}

	/**
	 * Form for processing general application email preferences
	 */
	public function settings()
	{
		$settings = new Email_Settings_Model();
		$this->template->body = new View('admin/settings/email_form');
		$this->template->body->settings = $settings;
		$this->template->body->errors = '';

		if ( ! $_POST)
		{
			$this->template->body->status = NULL;
		}
		else
		{
			$settings->set_fields($this->input->post());

			try
			{
				$settings->save();
				Kohana::config_clear('email');
				$this->template->body->status = TRUE;
				$this->template->body->settings = $settings;
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
				$this->template->body->settings = $settings;
				$this->template->body->status = FALSE;
			}
		}
	}
}