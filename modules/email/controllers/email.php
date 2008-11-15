<?php

class Email_Controller extends Controller {

	public function project_add()
	{
		// Send an email to all users who are set to receive emails on new projects
		$swift = email::connect();
		$message = new Swift_Message('New Project Created- ID:'.Event::$data->id.', '.Event::$data->name, View::factory('emails/project_creation')->set(array('project' => Event::$data)), 'text/html');
		$recipients = new Swift_RecipientList();

		foreach (Auto_Modeler_ORM::factory('user')->fetch_some(array('email_project_creation' => TRUE)) as $user)
		{
			$recipients->addTo($user->email, $user->first_name.' '.$user->last_name);
		}

		try
		{
			$swift->send($message, $recipients, $_SESSION['auth_user']->email);
			url::redirect('project/view/'.Event::$data->id);
		}
		catch (Swift_ConnectionException $e)
		{
			throw new Kohana_User_Exception('swift.general_error', $e->getMessage());
		}
	}
}