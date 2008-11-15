<?php

class Email_Controller extends Controller {

	public function _project_add()
	{
		// Send an email to all users who are set to receive emails on new projects
		$swift = email::connect();
		$message = new Swift_Message('New Project Created- ID:'.Event::$data->id.', '.Event::$data->name, View::factory('emails/project_creation')->set(array('project' => Event::$data)), 'text/html');
		$recipients = new Swift_RecipientList();

		foreach (Auto_Modeler_ORM::factory('email_role')->fetch_some(array('project_create' => TRUE)) as $role)
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

	public function _user_settings_save()
	{
		$roles = Auto_Modeler_ORM::factory('email_role')->fetch_some(array('user_id' => Event::$data['user']->id))->current();
		$roles->ticket_create = isset(Event::$data['settings']['ticket_create']);
		$roles->ticket_close = isset(Event::$data['settings']['ticket_close']);
		$roles->ticket_time = isset(Event::$data['settings']['ticket_time']);
		$roles->project_create = isset(Event::$data['settings']['project_create']);
		$roles->project_close = isset(Event::$data['settings']['project_close']);
		$roles->save();
	}

	public function _user_settings_display()
	{
		$roles = Auto_Modeler_ORM::factory('email_role')->fetch_some(array('user_id' => $_SESSION['auth_user']->id));

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
}