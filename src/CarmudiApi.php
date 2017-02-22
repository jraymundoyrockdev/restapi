<?php

namespace RestApi;

use RestApi\Entity\EntityFactory;
use RestApi\Repositories\VehicleRepository;
use RestApi\Response\ErrorResponse;
use RestApi\Response\HttpResponsesService;
use RestApi\Response\ValidResponse;
use RestApi\Transformers\VehicleTransformer;
use RestApi\Validation\VehicleValidation;

class CarmudiApi extends AbstractRestApi
{
    private $request;
    private $server;
    private $validation;
    private $vehicleRepository;
    protected $response;

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
        $this->vehicleRepository = new VehicleRepository;
        $this->response = new HttpResponsesService(new ValidResponse(), new ErrorResponse());
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response|ErrorResponse
     */
    public function processApi()
    {
        if (!Route::validateRoutes($this->endpoint, $this->method, $this->verb)) {
            return $this->response->error()->respondErrorNotFound();
        }

        $method = Route::getFunctionInRoutes($this->endpoint, $this->method);

        if (!method_exists($this, $method)) {
            return $this->response->error()->respondUnprocessableEntity('Invalid Operation');
        }

        return $this->{$method}($this->request);
    }

    /**
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response|ErrorResponse|ValidResponse
     */
    protected function create($request)
    {
        if (!$this->validation->validate($this->request)) {
            return $this->response->error()->respondUnprocessableEntity('All fields are required.');
        }

        $vehicle = EntityFactory::factory($request['name'], $request['engine_displacement'], $request['power']);

        $this->vehicleRepository->save($vehicle);

        return $this->response->fractal()->respondCreated('Inserted new vehicle.');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response|ValidResponse
     */
    protected function all()
    {
        $result = $this->vehicleRepository->findAll();

        $transformer = new VehicleTransformer();
        $this->response->fractal()->setData($transformer->transform($result));

        return $this->response->fractal()->respondSuccess();
    }
}
