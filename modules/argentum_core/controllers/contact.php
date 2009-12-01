<?php
/**
 * Contact Controller
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2009 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Contact_Controller extends Website_Controller {

	public function view($id = NULL)
	{
		$contact = new Contact_Model($id);

		if ( ! $contact->id)
			Event::run('system.404');

		$this->template->body = new View('contact/view');
		$this->template->body->contact = $contact;
	}
}