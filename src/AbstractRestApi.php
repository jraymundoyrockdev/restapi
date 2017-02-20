<?php

namespace RestApi;

use Exception;
use RestApi\Excetions\InvalidTokenException;

abstract class AbstractRestApi extends BaseClass
{
    use ItProvidesTokenValidation;

    protected $method = '';

    protected $endpoint = '';

    protected $verb = '';

    protected $args = [];

    protected $file = null;

    private $uri;

    /**
     * Constructor: __construct
     * Allow for CORS, assemble and pre-process the data
     */
    public function __construct($request)
    {
        parent::__construct();

        if (!$this->validateToken('sampleToken')) {
            throw new InvalidTokenException("Invalid Token");
        }
        $this->uri = explode('/', rtrim($request['REQUEST_URI'], '/'));
        $this->args = $this->getRequestArgs();
        $this->endpoint = $this->getRequestEndPoint();
        $this->verb = $this->getRequestVerb();
        $this->method = $this->getRequestMethod($_SERVER);
    }

    /**
     * @return array
     */
    private function getRequestArgs()
    {
        $uri = $this->uri;

        if (count($uri) > 3 && !is_numeric(end($uri))) {
            unset($uri[0]);
            unset($uri[1]);
            unset($uri[2]);
            return $uri;
        }

        return [];
    }

    /**
     * @return string
     */
    private function getRequestEndPoint()
    {
        if (array_key_exists(1, $this->uri) && !is_numeric($this->uri[1])) {
            return $this->uri[1];
        }

        return '';
    }

    /**
     * @return string
     */
    private function getRequestVerb()
    {
        if (array_key_exists(2, $this->uri) && !is_numeric($this->uri[2])) {
            return $this->uri[2];
        }

        return '';
    }

    /**
     * @param array $server
     * @return string
     * @throws Exception
     */
    private function getRequestMethod($server)
    {
        $requestMethod = $server['REQUEST_METHOD'];
        $httpXHttpMethod = ['DELETE', 'PUT'];

        $this->method = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $server)) {
            if (!array_key_exists($requestMethod, $httpXHttpMethod)) {
                throw new Exception("Unexpected Header");
            }

            return $server['HTTP_X_HTTP_METHOD'];
        }

        return $requestMethod;
    }
}