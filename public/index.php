<?php


require __DIR__ . '/../bootstrap.php';

use App\Core\Router;
use App\Core\Request;

$router = new Router();
require __DIR__ . '/../routes.php';

try {

    $response = $router->dispatch(Request::capture());
    echo $response;
} catch (\Throwable $e) {

    http_response_code(500);
    error_log($e->getMessage() . "\n" . $e->getTraceAsString());
    echo view('errors/500', ['message' => 'Internal Server Error']);
    var_dump($e->getTraceAsString());
    die();
}
