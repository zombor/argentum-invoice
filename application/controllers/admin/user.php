<?php

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
			$user->active = $this->input->post('active', FALSE);
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
			$user->active = $this->input->post('active', FALSE);

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
}