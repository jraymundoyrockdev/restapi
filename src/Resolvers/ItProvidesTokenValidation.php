<?php

namespace RestApi\Resolvers;

trait ItProvidesTokenValidation
{
    /**
     * @param string $token
     * @return bool
     */
    public function validateToken($token)
    {
        return true;
    }
}
