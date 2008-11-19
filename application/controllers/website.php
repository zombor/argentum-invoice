<?php
/**
 * Project Controller
 *
 * @package		Argentum
 * @author		Argentum Team
 * @copyright 	(c) 2008 Argentum Team
 * @license		http://www.argentuminvoice.com/license.txt
 */

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
			
			if (IN_PRODUCTION === FALSE)
			{
				//$this->profiler = new Profiler;
			}
		}

		$this->session = new Session;
	}
}