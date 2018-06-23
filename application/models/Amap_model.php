<?php

class Amap_model extends CI_Model {

	public function __construct () {
		$this->config->load('amap');
	}

	public function Addr_2_loc ( $addr ) {

		$url = $this->config->item ( 'amap_url' ). $addr;

		return $this->Get_geodata ( $url );
	}
	
	// Returns data in array:
	//      array ( array('address'=>'', 'longitude'=>'', 'latitude'=>''),
	//              array()... )
	public function Get_suggestions ( $address ) {
	    $url = $this->config->item ( 'amap_search_url' ).$address;
	    
	    return $this->Get_suggestiondata( $url );
	}

	protected function Get_geodata ( $url ) {
		$resultString = file_get_contents ( $url );

		$result = json_decode( $resultString, true );

		// Parse and return the longtitude and latitude,
		// otherwise responde about error
		$response = array ( $result [ 'status' ] );

		if ( empty ( $result [ 'status' ] ) || $result [ 'status' ] == 0 ) {
			$response = array ( 'response' => $this->config->item ( 'response_3rd_party_side_error' ) ); 
		} else {
			if (null == $result['geocodes']) {
				$response = array ( 'response' => $this->config->item ( 'response_3rd_party_side_error' ) ); 
			} else {
				$locatonString = $result [ 'geocodes' ][ 0 ][ 'location' ];
				$location = explode  ( ',', $locatonString );

				$response = array ( 'response' => $this->config->item ( 'response_success' ),
									'longitude' => $location[0], 'latitude' => $location[1] ); 
			}
		}

		return $response;
	}
	
	protected function Get_suggestiondata ( $url ) {
	    $suggestions = array();
	    
	    $result_string = file_get_contents ( $url );

		$result = json_decode( $result_string, true );

		// Parse and return the longtitude and latitude,
		// otherwise responde about error
		$response = array ( $result [ 'status' ] );

		if ( empty ( $result [ 'status' ] ) || $result [ 'status' ] != 1 ) {
			$response = array ( 'response' => $this->config->item ( 'response_3rd_party_side_error' ) ); 
		} else {
		    if ( count($result [ 'pois' ]) == 0 ) {
		        $response = array ( 'response' => $this->config->item ( 'response_3rd_party_side_error' ) );
		    } else {
		        foreach ( $result[ 'pois' ] as $i=>$poi ) {
		            if ( is_null ( $poi['name'] ) || is_null ( $poi['location'] ) ) {
		                $response = array ( 'response' => $this->config->item ( 'response_3rd_party_side_error' ) );
		            } else {
			            $locatonString = $poi['location'];
			            $location = explode  ( ',', $locatonString );
			            
			            $suggestion = array ( 
			                'address' => $poi['name'], 
			                'longitude' => $location[0], 
			                'latitude' => $location[1]
			            );
                        
                        $suggestions[] = $suggestion;
		            }
		        }
		    }
		}
		
		return array ( 'response' => $this->config->item ( 'response_success' ),
								'suggestions' => $suggestions ); ;
	}
}