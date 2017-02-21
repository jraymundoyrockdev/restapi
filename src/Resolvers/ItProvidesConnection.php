<?php

namespace RestApi\Resolvers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

trait ItProvidesConnection
{
    public $em;

    private $connections = [
        'default' => [
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => '',
            'dbname' => 'carmudi',
        ]
    ];

    /**
     * @param string $connectionName
     */
    public function connect($connectionName = 'default')
    {
        $config = Setup::createAnnotationMetadataConfiguration(["src/Entity"]);
        $this->em = EntityManager::create($this->connections[$connectionName], $config);
    }
}
