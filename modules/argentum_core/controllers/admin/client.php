<?php
/**
 * Admin Client Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */
include Kohana::find_file('controllers', 'admin/admin_website');
class Client_Controller extends Admin_Website_Controller {

	/**
	 *  Creates a new client in the database
	 */
	public function add()
	{
		$client = new Client_Model();
		$client->currency_id = Kohana::config('argentum.default_currency');
		$client->mailing_country = Kohana::config('argentum.default_country');

		$this->template->content = $this->view = new View('admin/client/form');
		$this->view->errors = '';
		$this->view->client = $client;
		$this->view->title = 'Add';

		if ($_POST)
		{
			$client->set_fields($this->input->post());

			try
			{
				$client->save();
				url::redirect('client/view/'.$client->short_name);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->view->errors = $e;
				$this->view->client = $client;
			}
		}
	}

	/**
	 *  Edits an existing client
	 */
	public function edit($short_name)
	{
		$client = new Client_Model($short_name);

		$this->template->content = $this->view = new View('admin/client/form');
		$this->view->errors = '';
		$this->view->client = $client;
		$this->view->title = 'Update';

		if ($_POST)
		{
			$client->set_fields($this->input->post());

			try
			{
				$client->save();
				url::redirect('client/view/'.$client->short_name);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->view->client = $client;
				$this->view->errors = $e;
			}
		}
	}

	/**
	 *  Deletes an existing client
	 */
	public function delete()
	{
		Auto_Modeler_ORM::factory('client', $this->input->post('id'))->delete();
		url::redirect('client/view_all');
	}
}