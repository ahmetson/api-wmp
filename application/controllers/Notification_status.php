<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Status of notification to client
 */
class Notification_status extends CI_Controller {

	public function Set () {
		$response_code	= $this->input->get ( 'response_code' );

		if ( is_null ( $response_code ) || empty ( $response_code ) ) 
			$response_code = $this->config->item ( 'response_3rd_party_side_error' );
		else 
			$response_code = $response_code;

		file_put_contents(VIEWPATH.'response.txt', $response_code);
	}

	public function Get () {
		if ( !file_exists ( VIEWPATH.'response.txt' ) )
			$response_code = $this->config->item ( 'response_3rd_party_side_error' );
		else
			$response_code = file_get_contents(VIEWPATH.'response.txt');

		if ( false === $response_code )
			$response_code = $this->config->item ( 'response_3rd_party_side_error' );

		echo $response_code;
	}
}
