<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['response_success'] 					= 1;		// Success request
$config['response_server_side_error'] 			= 2;		// There are occured server side errors
$config['response_3rd_party_side_error'] 		= 3;		// There are occured server side errors
$config['response_incorrect_request'] 			= 4;		// Failed to validate the request
$config['response_out_of_server_continuation'] 	= 5;		// Request has being transformed to direct talking
