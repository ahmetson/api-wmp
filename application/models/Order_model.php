<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function __construct () {
	    parent::__construct();
		$this->config->load ( 'notifier' );
	}

	public function Create ( $order_data ) {
		$this->db->insert( 'orders', $order_data );

		return $this->db->insert_id ();
	}
	
	public function Multi_Create ( $session_id, $orders ) {
	    foreach ($orders as $i => $order) {
	        $insert_data = array(
	            'session_id' => $session_id,
	            'phone_number' => $order['phone_number'],
	            //'longitude' => $order['longitude'],
	            //'latitude'  => $order['latitude']
	           );
	       if ( count($order['suggestions']) == 1 ) {
	           $insert_data['longitude'] = $order['suggestions'][0]['longitude'];
	           $insert_data['latitude'] = $order['suggestions'][0]['latitude'];
	       }
	           
		    $this->db->insert( 'orders', $insert_data );
		    $order['id'] = $this->db->insert_id ();
		    unset($order['address']);
		    unset($order['phone_number']);
		    $orders[$i] = $order;
	    }

		return $orders;
	}

	public function Update_status ( $order_id, $status ) {
		$data = array(
			'status' 		=> $status
		);
		$this->db->where( 'id', $order_id );
		$this->db->update( 'orders', $data );

		if ( $this->db->affected_rows () !== 1 ) {
			return false;
		}
		return true;
	}
	
	public function multi_location_update($orders) {
	    $this->load->model('address_model');
	    
	    $this->db->close();
	    $this->db->initialize();
	    // Update the orders location
	    foreach ($orders as $i=>$order ) {
	        $data = array(
			    'longitude' 		=> $order['longitude'],
			    'latitude'          => $order['latitude']
		    );
	    
	        $this->db->where('id', $order['id']);
	        $this->db->update('orders', $data);

    		/*if ( $this->db->affected_rows () !== 1 ) {
    		    echo "Order is not returned";
    			return 0;
    		}*/
    		try {
    		$this->address_model->Set_address_cache(array(
    		    'addr' => $order['address'],
    		    'longitude' 		=> $order['longitude'],
			    'latitude'          => $order['latitude']
			   ));
    		} catch (Exception $e) {
    		    
    		}
	    }
	    
	    // Update the location
		return  array ( 'response' => $this->config->item ( 'response_success' ) );    
	}
	
	public function Get_status ( $order_id ) {
	    //$this->load->database();
	    $this->db->close();
	    $this->db->initialize();
		$res = $this->db->get_where( 'orders', array ( 'id' => $order_id ) );

		if ( $this->db->affected_rows () !== 1 ) {
		    echo "Order is not returned";
			return 0;
		}
		return ( int ) $res->row()->status;     
	}
}