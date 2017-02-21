<?php

namespace RestApi\Validation;

interface ValidationInterface
{
    public function validate($fields = []);
}