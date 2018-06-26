<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'ElemeOpenApi'.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Config.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'ElemeOpenApi'.DIRECTORY_SEPARATOR.'Protocol'.DIRECTORY_SEPARATOR.'RpcClient.php');

class RpcService
{
    protected $client;

    public function __construct($token, Config $config)
    {
        $this->client = new RpcClient($token, $config);
    }
}