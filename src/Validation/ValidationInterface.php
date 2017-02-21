<?php

namespace RestApi\Validation;

interface ValidationInterface
{
    /**
     * @param array $fields
     * @return mixed
     */
    public function validate($fields = []);
}