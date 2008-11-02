<?php

/*
*  class:       Non_hourly_Controller
*  description: Provides application support for viewing non-hourly items for projects
*/
class Non_hourly_Controller extends Website_Controller {

	/*
	*  function:     view_project
	*  description:  Displays all non-hourly items for a project
	*  parameters:   $project_id: The project the view
	*/
	public function view_project($project_id)
	{
		$this->template->body = new View('non_hourly/view_project');
		$this->template->body->non_hourlies = Auto_Modeler_ORM::factory('non_hourly')->fetch_some(array('project_id' => $project_id));
		$this->template->body->project = new Project_Model($project_id);
	}
}