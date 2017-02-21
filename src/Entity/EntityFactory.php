<?php

namespace RestApi\Entity;

class EntityFactory
{
    /**
     * @param $name
     * @param $engineDisplacement
     * @param
     *
     * @return Vehicle
     */
    public static function factory($name, $engineDisplacement, $power)
    {
        $vehicle = new Vehicle;
        $vehicle->setName($name)->setEngineDisplacement($engineDisplacement)->setPower($power);

        return $vehicle;
    }
}