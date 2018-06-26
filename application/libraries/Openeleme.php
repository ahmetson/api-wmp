<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//use ElemeOpenApi\Config\Config;
//use ElemeOpenApi\Api\OrderService;

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'ElemeOpenApi'.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Config.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'ElemeOpenApi'.DIRECTORY_SEPARATOR.'Api'.DIRECTORY_SEPARATOR.'UserService.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'ElemeOpenApi'.DIRECTORY_SEPARATOR.'OAuth'.DIRECTORY_SEPARATOR.'OAuthClient.php');


class Openeleme {

	private $CI;

	private $appKey;
	private $appSecret;
	private $config;
	private $token;

	private $temporaryGetCodeUrl = "http://wmp-api.ahmetson.com/merchant/get-code";
	private $temporarySetCodeUrl = "http://wmp-api.ahmetson.com/merchant/set-code";
	private $callbackUrl 			= "http://wmp-api.ahmetson.com/merchant/eleme-server-bridge";

	public function __construct() {
		$this->CI =& get_instance();

		$this->CI->config->load('merchant');

		$this->appKey 		= $this->CI->config->item('eleme_app_key');
		$this->appSecret 	= $this->CI->config->item('eleme_app_secret');
		$this->config 		= new Config($this->appKey, $this->appSecret, $this->CI->config->item('eleme_is_sandbox'));
	}

	public function GetAuthUrl() {
	    //使用config对象，实例化一个授权类

	    $client = new OAuthClient($this->config);

	    $state 			= "0";
	    $scope 			= "all";
	    
	    
	    //根据OAuth2.0中的对应state，scope和callback_url，获取授权URLs
	    return $client->get_auth_url($state, $scope, $this->callbackUrl);
	}

	public function SetToken($code) {
		$client = new OAuthClient($this->config);

		return $client->get_token_by_code($code, $this->callbackUrl);
	}

	public function RefreshToken($refreshToken) {
		return $client->get_token_by_refresh_token($refreshToken, "all");
	}

	public function GetShopId($token) {
		$userService = new UserService($token, $this->config);

		$response = $userService->get_user();
		return $response->authorizedShops[0]->id;
	}
}
