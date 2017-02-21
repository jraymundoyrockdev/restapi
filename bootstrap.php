<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$entityPath = array("src/Entity");
$isDevMode = false;

$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'carmudi',
);

$config = Setup::createAnnotationMetadataConfiguration($entityPath, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);