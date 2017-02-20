<?php
namespace RestApi\Repositories;

use RestApi\Entity\Vehicle;

interface VehicleInterface
{
    /**
     * @param Vehicle $vehicle
     * @return mixed
     */
    public function save(Vehicle $vehicle);

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param $vehicleId
     * @return mixed
     */
    public function findById($vehicleId);
}