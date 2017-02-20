<?php

namespace RestApi;
use RestApi\Entity\Vehicle;
use RestApi\Repositories\VehicleRepository;

class CarmudiApi extends AbstractRestApi
{
    const METHOD_ACTION = ['POST' => 'create', 'GET' => 'all'];

    private $dbh;

    public function __construct($request, $server)
    {
        parent::__construct($server);


        $product = new Vehicle();
        $product->setName('newestproductioname');
        $product->setEngineDisplacement('test2');
        $product->setPower('test3');

        $test = new VehicleRepository();
        $test->save($product);

        echo 'test'; die;
        if (method_exists($this, self::METHOD_ACTION[$this->method])) {

            $this->dbh = $this->connect();

            echo $this->method;
            echo $action = self::METHOD_ACTION[$this->method]; die;

            $this->{$action}();
        }
    }

    protected function create()
    {
        echo 'post';
    }

    protected function all()
    {
        $sth = $this->dbh->prepare("SELECT * FROM vehicle");
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        print_r($result);
    }
}
