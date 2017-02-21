<?php
namespace RestApi\Validation;

class VehicleValidation implements ValidationInterface
{
    /**
     * @param array $fields
     *
     * @return bool
     */
    public function validate($fields = [])
    {
        if (empty($fields['name']) || empty($fields['engine_displacement']) || empty($fields['power'])) {
            return false;
        }

        return true;
    }
}