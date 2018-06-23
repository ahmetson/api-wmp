<?php

class Delivery_session_model extends CI_Model {

	public function __construct () {
		$this->config->load ( 'notifier' );
	}

	public function Create ( $courier_id ) {

		$data = array(
			'courier_id' => $courier_id
		);
		$this->db->insert( 'session', $data );

		return $this->db->insert_id ();
	}
}