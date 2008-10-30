<?php

class Non_hourly_Controller extends Website_Controller {

	public function view_project($project_id)
	{
		$this->template->body = new View('non_hourly/view_project');
		$this->template->body->non_hourlies = Auto_Modeler_ORM::factory('non_hourly')->fetch_some(array('project_id' => $project_id));
	}
}