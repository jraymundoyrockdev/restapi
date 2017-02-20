<?php

namespace RestApi;

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
