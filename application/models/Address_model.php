<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model {

	private $long_lat = array();
	private $addr_cache_table = 'addr_cache';

	public function __construct () {
	    parent::__construct();
		$this->load->model('amap_model');
	}
	

	public function Get_Lat_long ( $addr ) {
		$this->long_lat = $this->Get_address_cache ( $addr );

		if ( empty ($this->long_lat)  ) {
			$this->long_lat = $this->amap_model->Get_suggestions ( $addr );
		} 
		
		// Binded by IS_ADDRESS_CACHE or from AMAP library
		return $this->long_lat;
	}

	private function Get_address_cache ( $addr ) {
		$this->db->like ( 'addr', $addr );
		$result = $this->db->get ( $this->addr_cache_table );

		if ( $result->num_rows() == 0 ) {
			return array ();
		}

		$addrRow = $result->row();

		return array ( 'response' => $this->config->item ( 'response_success' ),
						 'suggestions' => array ( array ('longitude' => $addrRow->longitude, 'latitude' => $addrRow->latitude, 'address' => $addr) ) );
	}

	public function Set_address_cache( $address_cache_data ) {
		$this->db->insert ( $this->addr_cache_table, $address_cache_data );
	}
}