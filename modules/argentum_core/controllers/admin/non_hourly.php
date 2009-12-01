<?php
/**
 * Admin Non-hourly Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Non_hourly_Controller extends Website_Controller {

	/**
	 * Adds a non-hourly item to a project
	 */
	public function add($project_id)
	{
		$this->template->body = new View('admin/non_hourly/form');
		$this->template->body->title = 'Create';
		$non_hourly = new Non_hourly_Model();
		$non_hourly->project_id = $project_id;

		if ( ! $_POST) // Display the form
		{
			$this->template->body->errors = '';
			$this->template->body->non_hourly = $non_hourly;
		}
		else
		{
			$non_hourly->set_fields($this->input->post());
			$non_hourly->creation_date = time();

			try
			{
				$non_hourly->save();
				url::redirect('non_hourly/view_project/'.$non_hourly->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->non_hourly = $non_hourly;
				$this->template->body->errors = $e;
			}
		}
	}

	/**
	 * Updates a non-hourly item for a project
	 */
	public function edit($id)
	{
		$this->template->body = new View('admin/non_hourly/form');
		$this->template->body->title = 'Edit';
		$non_hourly = new Non_hourly_Model($id);

		if ( ! $_POST) // Display the form
		{
			$this->template->body->errors = '';
			$this->template->body->non_hourly = $non_hourly;
		}
		else
		{
			$non_hourly->set_fields($this->input->post());

			try
			{
				$non_hourly->save();
				url::redirect('non_hourly/view_project/'.$non_hourly->project_id);
			}
			catch (Kohana_User_Exception $e)
			{
				$this->template->body->non_hourly = $non_hourly;
				$this->template->body->errors = $e;
			}
		}
	}

	/**
	 *  Deletes a ticket
	 */
	public function delete($non_hourly_id)
	{
		$non_hourly = new Non_Hourly_Model($non_hourly_id);

		if ( ! $non_hourly->id)
			Event::run('system.404');

		if (isset($_POST['confirm']))
		{
			$non_hourly->delete();
			Event::run('argentum.non_hourly_delete', $non_hourly);
			url::redirect('non_hourly/view_project/'.$non_hourly->project_id);
		}
		elseif(isset($_POST['cancel']))
			url::redirect('non_hourly/view_project/'.$non_hourly->project_id);

		$this->template->body = new View('admin/confirm');
	}
}