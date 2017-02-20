<?php

/*header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");*/

namespace RestApi;

use RestApi\Resolvers\ItProvidesConnection;

class BaseClass
{
    use ItProvidesConnection;

    public function __construct()
    {
        $this->connect();
    }
}