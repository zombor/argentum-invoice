<?php
/**
 * Admin Contact Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Contact_Controller extends Website_Controller {

	public function create()
	{
		$contact = new Contact_Model();
		$contact->set_fields($this->input->post());

		try
		{
			$contact->save(array('client' => $this->input->post('client', array())), // Additional data to validate with the form
			               array('check_clients') );

			// Relate the clients to this contact
			$contact->remove_all('clients');
			foreach ($this->input->post('client') as $client)
				$contact->clients = $client;

			url::redirect('client');
		}
		catch (Kohana_User_Exception $e)
		{
			$this->template->body = new View('admin/contact/form');
			$this->template->body->contact = $contact;
			$this->template->body->errors = ! $_POST ? NULL : $e;
			$this->template->body->title = 'Create';
			$this->template->body->clients = Auto_Modeler_ORM::factory('client')->fetch_all();
		}
	}

	public function edit($id)
	{
		$contact = new Contact_Model($id);

		try
		{
			if ($_POST)
				$contact->set_fields($this->input->post());
			else
				throw new Kohana_User_Exception('argentum.no_error', 'blah');

			$contact->save();

			// Relate the clients to this contact
			$contact->remove_all('clients');
			foreach ($this->input->post('client') as $client)
				$contact->clients = $client;

			url::redirect('contact/view/'.$contact->id);
		}
		catch (Kohana_User_Exception $e)
		{
			$this->template->body = new View('admin/contact/form');
			$this->template->body->contact = $contact;
			$this->template->body->errors = ! $_POST ? NULL : $e;
			$this->template->body->title = 'Update';
			$this->template->body->clients = Auto_Modeler_ORM::factory('client')->fetch_all();
		}
	}
}