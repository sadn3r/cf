# cf

clean framework

install:
> mkdir AwesomeProject
>
>cd AwesomeProject
>
>touch composer.json

```
{
    "name": "awesomeproject/awesomeproject",
    "description": "AwesomeProject",
    "type": "project",
    "autoload": {
        "psr-4": {"AwesomeProject\\": "src/"}
    },
    "require": {
    	"cf/base": "dev-main",
    	"cf/db": "dev-main"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/sadn3r/cf"
        },
        {
            "type": "vcs",
            "url": "https://github.com/sadn3r/cfdb"
        }
    ]
}
```

> composer install


touch public/index.php

```
<?php declare(strict_types=1);
namespace AwesomeProject;

use CF\{Container, Router};
use Exception;
use ErrorException;
use AwesomeProject\Controllers\Api;

error_reporting(E_ALL);
ini_set('display_errors', "1");

define("APP_ENV", "dev"); // production

set_error_handler(function ($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
});

set_exception_handler(function($th) {
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

call_user_func_array($controller, $action);

```
