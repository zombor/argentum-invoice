<?php
/**
 * Parent website controller class
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

abstract class Admin_Website_Controller extends Website_Controller {
	public function __construct()
	{
		parent::__construct();

		$view_name = 'admin/'.Router::$controller.'/'.Router::$method;
		if (Kohana::find_file('views', $view_name))
			$this->template->content = $this->view = new View($view_name);
		else
			$this->template->content = $this->view = new View('no_view');
	}
}