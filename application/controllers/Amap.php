<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Amap is a chinese company that provides the access to the map services
 */
class Amap extends CI_Controller {

	/// Returns the longitude and latitude of given address
	public function Addr_2_loc(  ) {

		// Check whether or not the request is in POST method.
		if ( 'get' != $this->input->method () ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'GET METHOD IS REQUIRED!' ) );
		}

		// Correct address in Chinese
		$addr		= $this->input->get ( 'addr' );

		if ( is_null ( $addr ) || empty ($addr) ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS!' ) );
		}


		$this->load->model ( 'amap_model' );

		$response = $this->amap_model->Addr_2_loc ( $addr );

		json_response ( $response  );
	}
	
	public function Multi_specify() {
	    $return = array();
		valid_only_single_method ( 'POST' );
		require_authorization ();

		// Check the Phone number and Telephone number, then call the Notier model
		$addresses				= get_validated_addresses ();

		if (count($addresses) === 0 ){
		    json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
				'message'                => 'There are no any order information!' ) );
		}

		foreach ($addresses as $i => $address) {
	        $this->load->model ( 'address_model' );
			$location_response = $this->address_model->Get_Lat_long ( $address );
			
			if ( $this->config->item ( 'response_success' ) != $location_response [ 'response' ] ) {
				json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'Address parameter is wrong. Can not locate for '.$order['order_index'] ) );
			} else {
			    $return[] = array("address" => $address, 'suggestions' => $location_response [ 'suggestions' ]);
			}
		}

		json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
				'addresses'                => $return ) );
	}
}
