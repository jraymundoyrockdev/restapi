<?php

namespace RestApi\Transformers;

class VehicleTransformer
{
    /**
     * @param $vehicles
     *
     * @return array
     */
    public function transform($vehicles)
    {
        $result = [];

        foreach ($vehicles as $vehicle) {
            $result[] = [
                'id' => $vehicle->getId(),
                'name' => $vehicle->getName(),
                'engine_displacement' => $vehicle->getEngineDisplacement(),
                'power' => $vehicle->getPower()
            ];
        }

        return $result;
    }
}