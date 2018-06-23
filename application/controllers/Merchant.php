<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

	/// Returns the longitude and latitude of given address
	public function set_code(  ) {

	
		// Correct address in Chinese
		$code		= $this->input->get_post ( 'code' );

		file_put_contents('code.txt', $code);
	}
	
	public function get_code() {
	    echo file_get_contents('code.txt');
	}
}
