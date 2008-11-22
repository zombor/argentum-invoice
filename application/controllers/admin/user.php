<?php
/**
 * User Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class User_Controller extends Website_Controller
{
	/**
	 * lists all users
	 */
	public function all()
	{
		$this->template->bind('body', $view = View::factory('admin/user/all'));
		$view->users = Auto_Modeler_ORM::factory('user')->fetch_all();
	}

	/**
	 * Create a new user
	 */
	public function add()
	{
		$this->template->body = View::factory('admin/user/form')
			->set('title', 'Add User')
			->set('roles', Auto_Modeler_ORM::factory('role')->fetch_all('name'))
			->set('errors', '')
			->set('user', $user = new User_Model)
			->set('user_roles', array());

		if (request::method() == 'post')
		{
			$user->set_fields($this->input->post());
			$user->password = $this->input->post('password');
			try 
			{
				$user->save();

				foreach ($this->input->post('roles') as $role_id) 
					$user->roles = $role_id;

				url::redirect('admin/user/all');
			} 
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
				$this->template->body->user_roles = $this->input->post('roles');
			}
		}
	}

	/**
	 * Edit user
	 * expects GET id as url param
	 */
	public function edit()
	{
		$user = new User_Model($this->input->get('id', FALSE));

		if ( ! $user->id)
			Event::run('system.404');

		$this->template->body = $view = View::factory('admin/user/form')
			->set('title', 'Edit User: '.$user->username)
			->set('errors', '')
			->set('roles', $roles = Auto_Modeler_ORM::factory('role')->fetch_all('name'))
			->set('user', $user)
			->bind('user_roles', $user_roles);

		$user_roles = array();

		foreach ($user->find_related('roles') as $user_role)
			$user_roles[] = $user_role->id;

		if (request::method() == 'post')
		{
			$user->set_fields($this->input->post());
			$user->password = $this->input->post('password');

			try
			{
				$user->save(array('role' => $this->input->post('roles', array())),
				            array('check_roles'));
				$user->remove_all('roles');

				foreach ($this->input->post('roles') as $role_id)
					$user->roles = $role_id;

				url::redirect('admin/user/all');
			} 
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
				$this->template->body->user_roles = $this->input->post('roles', array());
			}
		}
	}

	/**
	 * Updates user preferences
	 */
	public function settings()
	{
		$user = $_SESSION['auth_user'];
		$this->template->body = new View('admin/user/settings');

		if ( ! $_POST)
		{
			$this->template->body->user = $user;
			$this->template->body->errors = '';
			$this->template->body->status = NULL;
		}
		else
		{
			$user->set_fields($this->input->post('user'));

			try
			{
				$user->save();
				$_SESSION['auth_user'] = $user;
				$this->template->body->user = $user;
				$this->template->body->errors = '';
				$this->template->body->status = TRUE;

				$email_settings = $this->input->post('email');
				$data = array('user' => $user, 'settings' => $email_settings);
				Event::run('argentum.user_settings_save', $data);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->errors = $e;
				$this->template->body->user = $user;
				$this->template->body->status = FALSE;
			}
		}
	}
}