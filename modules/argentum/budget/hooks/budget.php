<?php
/**
 * Loads all budget events
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class budget {

	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	/**
	 * Adds all the events to the main Argentum application
	 */
	public function add()
	{
		// Only add the events if we are on that controller
		if (Router::$controller == 'project')
		{
			switch (Router::$method)
			{
				case 'index':
					Event::add('argentum.project_index', array($this, 'project_index'));
					break;
				case 'view':
					Event::add('argentum.project_display', array($this, 'display_project_budget'));
					break;
				case 'add':
				case 'edit':
					Event::add('argentum.project_form', array($this, 'form_project_budget'));
					Event::add('argentum.project_edit_submit', array($this, 'submit_project'));
					break;
			}
		}
	}

	public function project_index()
	{
		$project = Event::$data;
		$project_budget = new Project_Budget_Model($project->id);
		View::factory('budget/project_index')->set(array('project' => $project, 'project_budget' => $project_budget))->render(TRUE);
	}

	public function display_project_budget()
	{
		$project = Event::$data;
		$project_budget = new Project_Budget_Model($project->id);
		View::factory('budget/display_project_budget')->set(array('project' => $project, 'project_budget' => $project_budget))->render(TRUE);
	}

	public function form_project_budget()
	{
		$project = Event::$data;
		$project_budget = new Project_Budget_Model($project->id);
		View::factory('budget/form_project_budget')->set(array('project_budget' => $project_budget))->render(TRUE);
	}

	public function submit_project()
	{
		$project = Event::$data['project'];
		$post = Event::$data['post'];

		$project_budget = new Project_Budget_Model($project->id);
		$project_budget->amount = $post['project_budget'];
		$project_budget->project_id = $project->id;
		$project_budget->save();
	}
}

new budget;