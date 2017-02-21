<?php

namespace RestApi;

use RestApi\Entity\EntityFactory;
use RestApi\Repositories\VehicleRepository;
use RestApi\Response\ErrorResponse;
use RestApi\Response\HttpResponsesService;
use RestApi\Response\ValidResponse;
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
        $this->response = new HttpResponsesService(new ValidResponse(), new ErrorResponse());
    }

    public function processApi()
    {
        $action = self::METHOD_ACTION[$this->method];

        if (!method_exists($this, $action)) {
            return $this->response->error()->respondUnprocessableEntity('Method does not exist');
        }

        return $this->{$action}($this->request);
    }

    /**
     * @param $request
     *
     * @return Entity\Vehicle
     */
    protected function create($request)
    {
        if (!$this->validation->validate($this->request)) {
            return $this->response->error()->respondUnprocessableEntity('All fields are required.');
        }
        
        $vehicle = EntityFactory::factory($request['name'], $request['engine_displacement'], $request['power']);

        $repository = new VehicleRepository();
        $repository->save($vehicle);

        return $this->response->fractal()->respondCreated('Inserted new vehicle.');
    }

    protected function all()
    {
        $sth = $this->dbh->prepare("SELECT * FROM vehicle");
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        print_r($result);
    }
}
