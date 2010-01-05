<?php
/**
 * Controller actions for the Live Timer events
 *
 * @package    Argentum
 * @author     Argentum Team
 * @copyright  (c) 2008-2010 Argentum Team
 * @license    http://www.argentuminvoice.com/license.txt
 */

class Live_Timer_Controller extends Website_Controller {

	public function _nav_links_display()
	{
		View::factory('live_timer/nav_links_display')->render(TRUE);
	}

	public function effects()
	{
		View::factory('js/effects', NULL, 'js')->render(TRUE);
		die();
	}

	public function style()
	{
		View::factory('css/live_timer', NULL, 'css')->render(TRUE);
		die();
	}

	public function index()
	{
		$this->template->body = new View('live_timer/index');
		$this->template->body->timers = Auto_Modeler_ORM::factory('live_timer')->fetch_all();
	}

	/**
	 * Displays the main timer page
	 */
	public function window()
	{
		$this->template->set_filename('empty');
		$this->template->body = View::factory('live_timer/window');
		$this->template->title = 'Live Timer';
		$this->template->body->projects = Auto_Modeler_ORM::factory('project')->select_list('id', array('id', 'name'), 'id', array('complete' => FALSE));
	}

	/**
	 * Displays an image
	 * @param string $image
	 */
	public function image($image)
	{
		$image = MODPATH.'argentum/live_timer/views/images/'.$image;
		header('Content-Description: File Transfer');
		header('Content-Type: image/png');
		header('Content-Disposition: attachment; filename='.basename($image));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($image));
		ob_clean();
		flush();
		readfile($image);
		exit;
	}

	/**
	 * Starts a live timer for a ticket
	 * @param int $ticket_id
	 */
	public function start($ticket_id)
	{
		$timer = new Live_Timer_Model();
		$timer->ticket_id = $ticket_id;
		$timer->user_id = $_SESSION['auth_user']->id;
		$timer->start_time = time();
		$timer->save();

		die(json_encode(array('success' => (bool) $timer->id)));
	}

	/**
	 * Stops a live timer for a ticket
	 * @param int $ticket_id
	 */
	public function stop($ticket_id)
	{
		$timer = Auto_Modeler_ORM::factory('live_timer')->fetch_where(array('ticket_id' => $ticket_id))->current();

		$time = new Time_Model();
		$time->user_id = $timer->user_id;
		$time->ticket_id = $timer->ticket_id;
		$time->start_time = $timer->start_time;
		$time->end_time = time();
		$time->save();

		die(json_encode(array('success' => (bool) $timer->delete())));
	}

	public function find_tickets()
	{
		$tickets = Auto_Modeler_ORM::factory('project', $this->input->post('project_id'))->find_related('tickets', array('complete' => FALSE));
		$html = '<option value="--">- Choose a ticket -</option>'."\n";
		foreach ($tickets as $ticket)
			$html.='<option value="'.$ticket->id.'">'.$ticket->id."</option>\n";
		echo $html;
		die();
	}

	public function find_ticket_status()
	{
		$timers = Auto_Modeler_ORM::factory('live_timer')->fetch_where(array('ticket_id' => $this->input->post('ticket_id')));
		echo count($timers) ? 'ON' : 'OFF';
		die();
	}
}