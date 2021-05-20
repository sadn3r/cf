<?php 
declare(strict_types=1);
namespace CF;

error_reporting(E_ALL);
ini_set('display_errors', "1");


require __DIR__ . './../vendor/autoload.php';

$router = Container::getInstance(require __DIR__ . './../dependencies.php')
	->make(Router::class);


$action = $router->resolve();

$controller = Container::getInstance()->make($action['controller']);
call_user_func_array([$controller, $action['action']], $action['arguments']);
