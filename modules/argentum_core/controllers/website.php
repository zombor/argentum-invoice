<?php
/**
 * Parent website controller class
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

abstract class Website_Controller extends Template_Controller {

	public function __construct()
	{
		parent::__construct();

		if (Kohana::config('argentum.installed'))
			$this->auth = new Auth;

		if (request::is_ajax())
		{
			$this->template = new View('blank');
		}
		else
		{
			$this->template->title = 'ArgentumInvoice';
		}

		if (Kohana::config('argentum.installed') AND (Router::$controller != 'settings' OR Router::$method != 'install'))
		{
			$view_name = Router::$controller.'/'.Router::$method;
			if (Kohana::find_file('views', $view_name))
				$this->template->content = $this->view = new View($view_name);
			else
			{
				Kohana::log('info', 'No view found: '.$view_name);
				$this->template->content = $this->view = new View('no_view');
			}
		}
		else
			$this->template->set_filename('install');
		include_once Kohana::find_file('vendor', 'Markdown');
	}
}