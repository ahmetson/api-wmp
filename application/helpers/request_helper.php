<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helper

 	This helper is used to validate requested data as well as request parameters such as
 	request method, authorized or not the user and so on.
 *
 * @author		Ahmetson
 */

// ------------------------------------------------------------------------

if ( ! function_exists('valid_only_single_method'))
{
	/**
	 * Indicates that method is available from only one request method
	 *
	 * @return	nothing
	 */
	function valid_only_single_method ( $method )
	{
		$ci =& get_instance ();
		if ( 0 !== strcasecmp  ( $method, $ci->input->method () ) ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'POST METHOD IS REQUIREDs!' ) );
		}
	}

}
if ( ! function_exists('require_authorization') )
{
	/**
	 * Indicates that method is avaialable for authorized users
	 *
	 * @return	nothing
	 */
	function require_authorization () {
		$ci =& get_instance ();

		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'Only authorized users may call this method!' ) );
		}
	}
}

if ( ! function_exists('get_validated_order_id') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_order_id ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$order_id	= $ci->input->post_get ( 'order_id' );

		// Validate Order ID
		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'Only authorized users may call this method!' ) );
		}
		return $order_id;
	}
}

if ( ! function_exists('get_validated_courier_id') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_courier_id ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$order_id	= $ci->input->post_get ( 'courier_id' );

		// Validate Order ID
		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'Only authorized users may call this method!' ) );
		}
		return $order_id;
	}
}

if ( ! function_exists('get_validated_address') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_address ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$address	= $ci->input->post_get ( 'address' );

		// Validate Order ID
		if ( is_null ( $address ) || empty ( $address ) ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'Missed address!' ) );
		}
		return $address;
	}
}
if ( ! function_exists('get_validated_phone_number') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_phone_number ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$phone_number	= $ci->input->post_get ( 'phone_number' );

		// Validate Order ID
		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS: phone number' ) );
		}
		return $phone_number;
	}
}

if ( ! function_exists('get_validated_order_status') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_order_status ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$status	= $ci->input->post_get ( 'status' );

		// Validate Status
		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS: phone number' ) );
		}
		return $status;
	}
}

if ( ! function_exists('get_validated_delivery_session_id') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_delivery_session_id ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$session_id	= $ci->input->post_get ( 'delivery_session_id' );

		if ( is_null ( $session_id ) || empty ( $session_id ) ) {
			if ( $SHOW_ERROR ) {
				json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS: session ID' ) );
			} else {
				return null;
			}
		}

		// Check the existance in database
		if ( true != true ) {
			
		}
		return $session_id;
	}
}


if ( ! function_exists('get_validated_longitude') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_longitude ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$longitude	= $ci->input->post_get ( 'longitude' );

		// Check the existance in database
		if ( true != true ) {
			
		}
		return $longitude;
	}
}

if ( ! function_exists('get_validated_latitude') )
{
	/**
	 * Validate the existance of order id

	  If @parameter Show Error is true, then in case of failed validation,
	  Server will response back the RESPONSE JSON,
	  otherwise nothing will be send
	 *
	 * @return	nothing
	 */
	function get_validated_latitude ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$latitude	= $ci->input->post_get ( 'latitude' );

		// Check the existance in database
		if ( true != true ) {
			
		}
		return $latitude;
	}
}

if ( ! function_exists('get_validated_orders') )
{
	/**
	 * Returns from String the array of undefined orders array
	 *
	 * @return	nothing
	 */
	function get_validated_orders ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$orders	= $ci->input->post_get ( 'orders' );

		// Check the existance in database
		if ( true != true ) {
			
		}
		return json_decode($orders, true);
	}
}

if ( ! function_exists('get_validated_addresses') )
{
	/**
	 * Returns from String the array of undefined orders array
	 *
	 * @return	nothing
	 */
	function get_validated_addresses ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$addresses	= $ci->input->post_get ( 'addresses' );

		return json_decode($addresses, true);
	}
}

if ( ! function_exists('get_validated_callto') )
{
	function get_validated_callto ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$phone_number	= $ci->input->post_get ( 'callto_phonenumber' );

		// Validate Order ID
		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS: phone number' ) );
		}
		return $phone_number;
	}
}
if ( ! function_exists('get_validated_callback') )
{
	function get_validated_callback ( $SHOW_ERROR = true ) {
		$ci =& get_instance ();

		$phone_number	= $ci->input->post_get ( 'callback_phonenumber' );

		// Validate Order ID
		if ( true != true ) {
			json_response ( array ( 'response' => $ci->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS: phone number' ) );
		}
		return $phone_number;
	}
}

if ( ! function_exists('get_http_code') )
{
	function get_http_code ( $url ) {
        $headers = get_headers ( $url );
        return substr ( $headers [ 0 ], 9, 3 );
	}
}
