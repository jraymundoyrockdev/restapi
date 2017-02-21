<?php
namespace RestApi\Repositories;

use RestApi\Entity\Vehicle;

class VehicleRepository extends AbstractBaseRepository implements VehicleInterface
{
    /**
     * VehicleRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Vehicle $vehicle
     * @return Vehicle
     */
    public function save(Vehicle $vehicle)
    {
        $this->em->persist($vehicle);
        $this->em->flush();

        return $vehicle;
    }

    public function findById($vehicleId)
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->em->getRepository('RestApi\Entity\Vehicle')->findAll();
    }
}

