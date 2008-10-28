<?php

abstract class Website_Controller extends Template_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->auth = new Auth;

		if (request::is_ajax())
		{
			$this->template = new View('blank');
		}
		else
		{
			$this->template->title = 'ArgentumInvoice';
			$this->profiler = new Profiler;
		}

		$this->session = new Session;
	}
}