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

	public function orders() {
		// Check whether or not the request is in POST method.
		if ( 'get' != $this->input->method () ) {
			json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'POST METHOD IS REQUIRED!' ) );
		}

		$elemeShopId		= $this->input->get ('elemeShopId', true);
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
}
