<?php

namespace CF;

use CF\Container;
use CF\Router;
use ErrorException;
use CF\Controllers\Api;

error_reporting(E_ALL);
ini_set('display_errors', "1");

define("APP_ENV", "dev"); // production
define('PUBLIC_JWT', require __DIR__ . '/../public.key.php');

set_error_handler(function ($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
});

set_exception_handler(function ($th) {
    Api::render([
        'error' => $th->getMessage(),
        'errorCode' => $th->getCode(),
    ], 500);
});

require __DIR__ . './../vendor/autoload.php';


$router = Container::getInstance(require __DIR__ . './../dependencies.php')
    ->make(Router::class);

$action = $router->resolve();

$controller = Container::getInstance()->get(array_shift($action));

call_user_func_array($controller, array_values($action));
