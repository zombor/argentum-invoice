<?php
/**
 * Non-Hourly Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

class Non_hourly_Controller extends Website_Controller {

	/**
	 * Views all non-hourly items for a project
	 * @param int $project_id
	 */
	public function view_project($project_id)
	{
		$this->template->body = new View('non_hourly/view_project');
		$this->template->body->non_hourlies = Auto_Modeler_ORM::factory('non_hourly')->fetch_some(array('project_id' => $project_id));
		$this->template->body->project = new Project_Model($project_id);
	}
}