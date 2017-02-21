<?php

    header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json");

require_once 'bootstrap.php';

use RestApi\CarmudiApi;

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new CarmudiApi($_REQUEST, $_SERVER);

    $result = $API->processApi();

    header('Status:', TRUE, $result->getStatusCode());

    echo $result;
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}