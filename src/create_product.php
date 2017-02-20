<?php
// create_product.php
require_once "Entity/Vehicle.php";
require_once "../bootstrap.php";

$newProductName = 'test';

$product = new Vehicle();
$product->setName($newProductName);
$product->setEngineDisplacement('test2');
$product->setPower('test3');

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";