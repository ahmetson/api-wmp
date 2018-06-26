<?php

require_once(dirname(__FILE__)."\\..\\..\\ElemeOpenApi\\Config\\Config.php");
require_once(dirname(__FILE__)."\\..\\..\\ElemeOpenApi\\Protocol\\RpcClient.php");

class RpcService
{
    protected $client;

    public function __construct($token, Config $config)
    {
        $this->client = new RpcClient($token, $config);
    }
}