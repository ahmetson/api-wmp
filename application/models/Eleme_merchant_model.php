<?php

class Eleme_merchant_model extends CI_Model {

	public function __construct () {
		$this->config->load ( 'merchant' );
		$this->load->database();
		$this->load->library('Openeleme');
	}

	public function GetOrders ( $token, $shopId, $pageNo, $pageSize, $deliveryDay ) {
		return $this->GenerateFullOrdersUntil ( 5, $pageNo );
		
		//$orderList = $this->openeleme->GetOrders( $token, $shopId, $pageNo, $pageSize, $deliveryDay );
		//return $this->CreateOrderJSONList ( $orderList );
	}

	public function SetToken($code) {
		$response = $this->openeleme->SetToken($code);

		// Need the Shop Id of the user
		$shopId		= $this->openeleme->GetShopId( $response );

		/*$this->InsertOrUpdateTokenOnDatabase( array ( 'shop_id' => $shopId, 
												  'token' => $response [ 'access_token' ],
												  'created_time' => time(),
												  'refresh_token' => $response['refresh_token'] ));*/

		return array('shopId' => $shopId, 'token' => $response->access_token, 'refresh_token' => $response->refresh_token );
	}

	private function GetTokenOnDatabase($shopId) {
		$query = $this->db->get_where('merchant_eleme', array('shop_id' => $id), $limit, $offset);

		$row = $query->row_array();

		if (isset($row))
		{
		   return $row;
		}
		return NULL;
	}

	private function InsertOrUpdateTokenOnDatabase($params) {
		$this->db->replace('merchant_eleme', $params);
	}

	public function GetAuthUrl() {
		return $this->openeleme->GetAuthUrl();
	}

	/** For Test purpose only
	*/
	public function GenerateFullOrdersUntil( $pageNo, $currentPageNo ) {
		$amount = 50;

		if ( $currentPageNo >= $pageNo ) {
			$amount = rand ( 1, 50 );
		}

		return $this->GenerateOrders ( $amount );
	}

	/** For Test purpose only
	*/
	public function GenerateOrders ( $amount ) {
		if ( $amount > 50 || $amount < 1 ) {
			return array();
		}

		$orders = array();

		for ( $i = 0; $i < $amount; $i++ ) {
			$id 			= time () . '' . $i;
			$address 		= 'address' . $i;
			$phone 			= '13262533217';
			$invoice		= true;
			$deliverable	= ( rand ( 0, 1 ) == 1 ) ? true : false;
			$location		= '123.31231,32.123123';

			$order = array ( 'id' => $id, 'address' => $address, 'phone' => $phone, 'invoce' => $invoice, 'deliverable' => $deliverable, 'location' => $location );
			$orders[] = $order;
		}

		return $orders;
	}

	private function CreateOrderJSONList( $ordersList ) {
		if ( $ordersList->total == 0 ) {
			return array();
		}
		return $orderList->list;
	}
}