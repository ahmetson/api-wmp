<?php

class Eleme_merchant_model extends CI_Model {

	public function __construct () {
		$this->config->load ( 'merchant' );
		$this->load->database();
		$this->load->library('Openeleme');
	}

	public function GetOrders ( $shopId, $shopAccount, $shopPassword ) {
		
		return $this->openeleme->GetOrders($shopId, $shopAccount, $shopPassword);
	}

	public function SetToken($code) {
		$response = $this->openeleme->SetToken($code);

		// Need the Shop Id of the user
		$shopId		= $this->openeleme->GetShopId($response);

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
}