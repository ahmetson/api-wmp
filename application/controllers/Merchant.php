<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Works with the merchants.

 	Returns information list of orders.
 */
class Merchant extends CI_Controller {


	public function index()
	{

		$this->load->view('welcome_message');
	}

	public function get_orders() {
		// Check whether or not the request is in POST method.
		if ( 'get' != $this->input->method () ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'POST METHOD IS REQUIRED!' ) );
		}

		$merchantType		= $this->input->get ('merchantType', true);
		$elemeShopId		= $this->input->get ('shopId', true);
		$elemeShopPassword	= $this->input->get ('elemeShopPassword', true);
		$elemeShopAccount	= $this->input->get ('elemeShopAccount', true);

		// Since we are in the development part, we can use the demo shop data
		if ( 'development' == ENVIRONMENT ) {
			$this->config->load ( 'merchant' );

			$elemeShopId		= $this->config->item ( 'eleme_demo_shop_id' );
			$elemeShopPassword	= $this->config->item ( 'eleme_demo_shop_password' );
			$elemeShopAccount	= $this->config->item ( 'eleme_demo_shop_account' );
		} 

		if (null !== $elemeShopId && null !== $elemeShopAccount && null !== $elemeShopPassword) {
			$this->load->model('Eleme_merchant_model');

			$orders = $this->Eleme_merchant_model->getOrders($elemeShopId, $elemeShopAccount, $elemeShopPassword);

			json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
									'orders' => $orders ) );
		}

		json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED SOME PARAMETERS' ) );
			
	}

	public function auth() {
		header('Access-Control-Allow-Origin', '*');
		// Check whether or not the request is in POST method.
		if ( 'get' != $this->input->method () ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'POST METHOD IS REQUIRED!' ) );
		}

		// Check whether or not the user have authentication
		if ( true != true ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'Failed to validate user!' ) );
		}

		// Check the Phone number and Telephone number, then call the Notier model
		$callto		= $this->input->post ( 'callto_phonenumber' );
		$callback	= $this->input->post ( 'callback_phonenumber' );

		if ( is_null ( $callto ) || is_null ($callback) ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED REQUIRED PARAMETERS!' ) );
		}

		if ( 1 !== preg_match ( '/^[+][0-9]{13}$/', $callto ) ||
			 1 !== preg_match ( '/^[+][0-9]{13}$/', $callback ) ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'Failed to validate parameters' ) );
		}

		$this->load->model('notifier_model');

		$notification_status = $this->notifier_model->Call_To_Client ( $callto, $callback );

		json_response ( array ( 'response' => $notification_status ) );
	}

	/** This is an AJAX method, called from the Callback method

	*/
	public function set_eleme_token() {
		header('Access-Control-Allow-Origin', '*');
		// Check whether or not the request is in POST method.
		if ( 'get' != $this->input->method () ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'GET METHOD IS REQUIRED!' ) );
		}

		$code				= $this->input->get ('code', true);

		if (null !== $code) {
			$this->load->model('Eleme_merchant_model');

			try {
				$response = $this->Eleme_merchant_model->SetToken($code);
				json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
									'shopId' => $response['shopId'],
									'token'	=> $response['token'], 
									'refreshToken' => $response['refresh_token'] ) );
			} catch (Exception $e) {
				json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => $e->getMessage() ) );
			}

			
		}

		json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'MISSED SOME PARAMETERS' ) );
	}

	/* This method is requested by Ele.me side. It is the only method on the WaimaiPay, that is requested from the Ele.me's side!
		It can be called by Ele.me in three cases:
		1) Authorization success - @returns Code
		2) Authorization fail    - @returns Error
		3) Neutral			     - When user presses WaiMaiPay link on his Eleme account
	*/
	public function eleme_server_bridge () {
		header('Access-Control-Allow-Origin', '*');
		// Check the request case
		$code				= $this->input->get ('code', true);
		$error				= $this->input->get ('error', true);
		$errorDescription	= $this->input->get ('error_description', true);
		$data = array('state' => 'neutral');

		if ( null != $code ) {
			$data['state'] = 'auth_succeed';
			$data['code'] = $code;
		} else if ( null != $error && null != $errorDescription ) {
			$data['state'] = 'auth_failed';
			$data['error'] = $error;
			$data['errorDescription'] = $errorDescription;
		}

		//$data = array('state' => 'neutral');
		//$data = array('state' => 'failure', 'message' => 'Something happened');
		$this->load->view('merchant/eleme/callback', $data);
	}
}
