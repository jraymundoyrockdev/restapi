<?php

/*header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");*/

namespace RestApi\Repositories;

use RestApi\Resolvers\ItProvidesConnection;

class AbstractBaseRepository
{
    use ItProvidesConnection;

    /**
     * AbstractBaseRepository constructor.
     */
    public function __construct()
    {
        $this->connect();
    }
}