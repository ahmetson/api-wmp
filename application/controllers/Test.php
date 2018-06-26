<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function login()
	{
		$this->load->model('Eleme_merchant_model');
		$data = array();
		$data['authUrl'] = $this->Eleme_merchant_model->GetAuthUrl();
		$this->load->view('test/login', $data);
	}

	public function callback()
	{
		$data = array('state' => 'success', 'shopId' => 123123, 'token' => 'asdaszxfkjlfjaskn19123klsahdeufo8u2ewqlhdn');
		//$data = array('state' => 'neutral');
		//$data = array('state' => 'failure', 'message' => 'Something happened');
		$this->load->view('test/callback', $data);
	}
}
