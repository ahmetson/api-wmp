<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//use ElemeOpenApi\Config\Config;
//use ElemeOpenApi\Api\OrderService;

require('ElemeOpenApi/Config/Config.php');
require('ElemeOpenApi/Api/OrderService.php');
require('ElemeOpenApi/OAuth/OAuthClient.php');


class Openeleme {

	private $CI;

	private $appKey;
	private $appSecret;
	private $config;
	private $token;

	private $temporaryGetCodeUrl = "http://wmp-api.ahmetson.com/merchant/get-code";
	private $temporarySetCodeUrl = "http://wmp-api.ahmetson.com/merchant/set-code";

	public function __construct() {
		$this->CI =& get_instance();

		$this->CI->config->load('merchant');

		$this->appKey 		= $this->CI->config->item('eleme_app_key');
		$this->appSecret 	= $this->CI->config->item('eleme_app_secret');
		$this->config 		= new Config($this->appKey, $this->appSecret, $this->CI->config->item('eleme_is_sandbox'));
	}

	public function Auth() {
	    //使用config对象，实例化一个授权类

	    $client = new OAuthClient($this->config);

	    $state 			= "123321";
	    $scope 			= "all";
	    $callback_url 	= "";
	    
	    
	    //根据OAuth2.0中的对应state，scope和callback_url，获取授权URL
	    $auth_url = $client->get_auth_url($state, $scope, $this->temporarySetCodeUrl);
        echo $auth_url;
	    $code 			= file_get_contents($this->temporaryGetCodeUrl);

	    $this->token = $client->get_token_by_code($code, $callback_url);
	    echo $token;
	}

	/// Returns the longitude and latitude of given address
	public function GetOrders( $shopId, $shopAccount, $shopPassword ) {
		if ( null === $this->token ) {
			$this->Auth();
		}
		$pageNo = 1;
    
	    //使用config和token对象，实例化一个服务对象
	    $orderService = new OrderService($this->token, $this->config);

	    $shop = $orderService->get_all_orders($shopId, $pageNo, $this->CI->config->item('elemePageSize'), date("Y-m-d"));
	}
}
