<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'QcloudImage'.DIRECTORY_SEPARATOR.'index.php';
use QcloudImage\CIClient;

/**
 * Deal with Order. Record on logs about order. Retrieve order's location to the client and so on.
 */
class Order extends CI_Controller {
    
    public function __contruct() {
        parent::__construct();
    }

	/**
		Logs order on the Database. Also retrieves location based on address
	*/
	public function Define() {
		valid_only_single_method ( 'POST' );
		require_authorization ();

		// Check the Phone number and Telephone number, then call the Notier model
		$courier_id				= get_validated_courier_id ();
		$addr					= get_validated_address ();
		$phone_number			= get_validated_phone_number ();
		$delivery_session_id	= get_validated_delivery_session_id ( );
		$longitude				= get_validated_longitude ( false );
		$latitude				= get_validated_latitude ( false );
		
		// Retreive the location of order, based on address. Using 3rd party library if required
		if ( is_null ( $longitude ) || is_null ( $latitude ) ) {
			$this->load->model ( 'address_model' );

			$location_response = $this->address_model->Get_Lat_long ( get_validated_address () );
			
			if ( $this->config->item ( 'response_success' ) != $location_response [ 'response' ] ) {
				json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'Address parameter is wrong. Can not locate it!' ) );
			} else {
				$longitude = $location_response [ 'longitude' ];
				$latitude  = $location_response [ 'latitude' ];
			}
		}

		$this->load->model('order_model');
		$order_id = $this->order_model->Create ( array ( 'session_id' => $delivery_session_id, 'phone_number' => $phone_number, 'longitude' => $longitude, 'latitude' => $latitude ) );

		json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
				'order_id'				=> $order_id,
				'delivery_session_id'	=> $delivery_session_id,
				'longitude'				=> $longitude,
				'latitude'				=> $latitude ) );
	}
	
	public function Multi_define() {
		valid_only_single_method ( 'POST' );
		require_authorization ();

		// Check the Phone number and Telephone number, then call the Notier model
		$courier_id				= get_validated_courier_id ();
		$orders					= get_validated_orders ();
		$delivery_session_id	= get_validated_delivery_session_id ( false );
		
		if (count($orders) === 0 ){
		    json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
				'message'                => 'There are no any order information!' ) );
		}

		// First Order of delivery session?
		if ( is_null ( $delivery_session_id ) ) {
			$this->load->model ( 'delivery_session_model' );
			$delivery_session_id = $this->delivery_session_model->Create ( $courier_id );
		}
		
		// for each order
		//      get the location
		// Define the multi_order_create in model, and returns the same orders with filled order ids
		// Create the orders
		// return the result
		foreach ($orders as $i => $order) {
	        $this->load->model ( 'address_model' );
			$location_response = $this->address_model->Get_Lat_long ( $order['address'] );
			
			if ( $this->config->item ( 'response_success' ) != $location_response [ 'response' ] ) {
				json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
									'message' => 'Address parameter is wrong. Can not locate for '.$order['order_index'] ) );
			} else {
				$order['suggestions'] = $location_response [ 'suggestions' ];
			}
			$orders[$i] = $order;
		}

		$this->load->model('order_model');
		$orders = $this->order_model->Multi_Create ( $delivery_session_id, $orders );

		json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
				'delivery_session_id'	=> $delivery_session_id,
				'orders'                => $orders ) );
	}
	
	public function Multi_locations_update() {
		valid_only_single_method ( 'POST' );
		require_authorization ();

		// Check the Phone number and Telephone number, then call the Notier model
		$courier_id				= get_validated_courier_id ();
		$orders					= get_validated_orders ();
		//$delivery_session_id	= get_validated_delivery_session_id ( false );
		// orders { { order_id, longitute, latitude, address },..}
		
		if (count($orders) === 0 ){
		    json_response ( array ( 'response' => $this->config->item ( 'response_incorrect_request' ),
				'message'                => 'There are no any order informationas!' ) );
		}

		$this->load->model ( 'order_model' );
		json_response ( $this->order_model->multi_location_update ( $orders ));

	}

	/*	Update the order status on the Log at Database. We use it to synchronize with Courier's app
	*/
	public function Update_status() {
		valid_only_single_method ( 'GET' );
		require_authorization ();
        file_put_contents('update.txt', 'Order '.get_validated_order_id().' has status '.get_validated_order_status());
		$this->load->model('order_model');
		$query_status = $this->order_model->Update_status ( get_validated_order_id (), get_validated_order_status () );
        
		if ( $query_status !== true ) {

			json_response ( array ( 'response' => $this->config->item ( 'response_server_side_error' ),
									'message' => 'Failed to update the order status' ) );
		
		} else {
			json_response ( array ( 'response' => $this->config->item ( 'response_success' ) ) );
		}
	}

	/**
			Return the order status. This method is used to synchronize the log on Database with
			couriers app
	*/
	public function Get_status () {
		valid_only_single_method ( 'POST' );
		require_authorization ();

		$this->load->model ( 'order_model' );
		$status = $this->order_model->Get_status ( get_validated_order_id () );
		
		json_response ( array ( 'response'  => $this->config->item ( 'response_success' ),
								'status'    => $status ) );
	}

	/**
	 * Uploads Invoice Image and @return the name of image
	 */
	public function Upload() {
		valid_only_single_method ( 'POST' );
		require_authorization ();

		/// UPLOAD INVOICE IMAGE
		$config['upload_path']		= './files/tmp/';
		$config['allowed_types']	= 'jpg';
		$config['max_size']			= 4000;				// [KB]
		$config['max_width']		= 4024;
		$config['max_height']		= 2768;
		$config['file_name']		= get_validated_courier_id ().'_'.time();

		$this->load->library ( 'upload' , $config );

		if ( ! $this->upload->do_upload ( 'order_invoice_image' ) )
		{
			json_response ( array ( 'response' => $this->config->item ( 'response_server_side_error' ),
									'message' => 'Can not upload the file!' ) );
		}
		else
		{
			$files_path		= FCPATH.'files'.DIRECTORY_SEPARATOR;
			$tmp_path		= $file_path.'tmp'.DIRECTORY_SEPARATOR.$config['file_name'].'.jpg';
			$order_path		= $file_path.'orders'.DIRECTORY_SEPARATOR.$config['file_name'].'.jpg';

			/// MOVE UPLOADED FILE TO THE COLLECTION OF UPLOADED IMAGES
			if ( ! rename ( $tmp_path, $order_path ) )
			{
				json_response ( array ( 'response' => $this->config->item ( 'response_server_side_error' ),
										'message' => 'Can not move file to Orders Dir!' ) );
			}

			// Grab the information from Qcloud server
			// TODO

			json_response ( array ( 'response' => $this->config->item ( 'response_success' ),
										'order_address' => $config['file_name'].'.jpg' ) );
		}
		
	}

}
