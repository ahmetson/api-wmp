<?php

class Notifier_model extends CI_Model {
    
    private $order_id = null;
    private $time_limit = 60;   // [Seconds]
    private $delay_time = 5;    // [Seconds]

	public function __construct () {
		$this->config->load('notifier');
	}

	public function Call_To_Client ( $callto, $callback, $order_id ) {

		$query_data = array (
			'script_custom_data'	=> $callto.'|'.$callback.'|'.$order_id,
			'account_id'			=> $this->config->item ( 'voximplant_account_id' ),
			'api_key'				=> $this->config->item ( 'voximplant_api_key' ),
			'user_name'				=> $this->config->item ( 'voximplant_app_user' ),
			'rule_id'				=> $this->config->item ( 'voximplant_calling_client_command' )
		);
		
		
		$this->order_id = $order_id;

		$url = $this->config->item ( 'voximplant_start_scenario_url' ).http_build_query ( $query_data );
        file_put_contents('url.txt', $url);
		return $this->Contact_Cloud_Server ( $url );
	}

	protected function Contact_Cloud_Server ( $url ) {
		$response_string = file_get_contents ( $url );
		$response = json_decode ( $response_string, true );
		
		if ( array_key_exists ( 'result', $response ) == false ) {
		    return 0;
		}
		if ( 1 !== $response [ 'result' ] ) {
		    return 0;
		}

	    for ( $running_time = 0; $running_time < $this->time_limit; $running_time += $this->delay_time ) {
	        // Session has been deleted, means session was finished, thus order status had been updated
	        if ( 404 == get_http_code ( $response [ 'media_session_access_url' ] ) ) {
	            break;
	        }
	        sleep ( $this->delay_time );
	    }
		
		
		if ( is_null ( $this->order_id ) )
		    return 0;
		
		// Get the status of call
		$this->load->model( 'order_model' );
		$response_code = $this->order_model->Get_status ( $this->order_id );
		
		if ( empty ( $response_code )=== true) {
			$response_code = $this->config->item ( 'response_3rd_party_side_error' ); 
		} else {
			$response_code = ( int ) $response_code;
		}

		return $response_code;
	}
}