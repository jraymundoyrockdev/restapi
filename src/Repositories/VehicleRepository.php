<?php
namespace RestApi\Repositories;

use Doctrine\ORM\EntityManager;
use RestApi\Entity\Vehicle;

class VehicleRepository extends AbstractBaseRepository implements VehicleInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(Vehicle $vehicle)
    {
        $this->em->persist($vehicle);
    }

    public function getAll()
    {
        // TODO: Implement findAll() method.
    }

    public function findById($vehicleId)
    {
        // TODO: Implement findAll() method.


    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }
}

