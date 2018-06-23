<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Status of notification to client
 */
class Delivery_session extends CI_Controller {

    public function __contruct() {
        parent::__construct();
    }

	/**
		Logs order on the Database. Also retrieves location based on address
	*/
	public function Create() {
		valid_only_single_method ( 'POST' );
		require_authorization ();

		// Check the Phone number and Telephone number, then call the Notier model
		$courier_id				= get_validated_courier_id ();

		$this->load->model ( 'delivery_session_model' );
		$delivery_session_id = $this->delivery_session_model->Create ( $courier_id );


		json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
				'delivery_session_id'	=> $delivery_session_id ) );
	}
}
