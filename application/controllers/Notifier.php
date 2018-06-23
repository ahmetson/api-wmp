<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Client notifier
 */
class Notifier extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function Call_Client() {
	    valid_only_single_method ( 'POST' );
		require_authorization ();

		// Check the Phone number and Telephone number, then call the Notier model
		$callto		= get_validated_callto();
		$callback	= get_validated_callback();
		$order_id   = get_validated_order_id();

		$this->load->model('notifier_model');

		$notification_status = $this->notifier_model->Call_To_Client ( $callto, $callback, $order_id );
        
		json_response ( array ( 'response' => $notification_status ) );
		
	}
}
