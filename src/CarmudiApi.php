<?php

namespace RestApi;

use RestApi\Entity\EntityFactory;
use RestApi\Repositories\VehicleRepository;
use RestApi\Validation\VehicleValidation;

class CarmudiApi extends AbstractRestApi
{
    const METHOD_ACTION = ['POST' => 'create', 'GET' => 'all'];

    private $dbh;
    private $request;
    private $server;
    private $validation;

    /**
     * CarmudiApi constructor.
     * @param $request
     * @param $server
     */
    public function __construct($request, $server)
    {
        parent::__construct($server);

        $this->request = $request;
        $this->server = $server;
        $this->validation = new VehicleValidation();
    }

    public function processApi()
    {
        if (!$this->validation->validate($this->request)) {
            return false;
        }

        if (method_exists($this, self::METHOD_ACTION[$this->method])) {
            $action = self::METHOD_ACTION[$this->method];
            $this->{$action}($this->request);
        }
    }

    /**
     * @param $request
     *
     * @return Entity\Vehicle
     */
    protected function create($request)
    {
        $vehicle = EntityFactory::factory($request['name'], $request['engine_displacement'], $request['power']);

        $repository = new VehicleRepository();
        $repository->save($vehicle);

        return $vehicle;
    }

    protected function all()
    {
        $sth = $this->dbh->prepare("SELECT * FROM vehicle");
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        print_r($result);
    }
}
