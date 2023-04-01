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
    "require-dev": {
        "phpstan/phpstan": "^1.10"
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
>
> mkdir public
>
> touch public/index.php

```
<?php

namespace AwesomeProject;

use CF\Container;
use CF\Router;
use AwesomeProject\Controllers\Api;
use ErrorException;

error_reporting(E_ALL);
ini_set('display_errors', "1");

define("APP_ENV", "dev"); // production
//define('PUBLIC_JWT', require __DIR__ . '/../public.key.php');

set_error_handler(fn($severity, $message, $filename, $lineno) => throw new ErrorException($message, 0, $severity, $filename, $lineno));

set_exception_handler(fn($th) => Api::render([
	'error'     => $th->getMessage(),
	'errorCode' => $th->getCode(),
	'line'      => "{$th->getFile()} : {$th->getLine()}",
], 500));

require __DIR__ . './../vendor/autoload.php';


$router = Container::getInstance(require __DIR__ . './../dependencies.php')
	->make(Router::class);

$action = $router->resolve();

$controller = Container::getInstance()->get(array_shift($action));

call_user_func_array($controller, array_values($action));

```
> mkdir src
> 
> mkdir src/Controllers
> 
> mkdir src/Traits


```
<?php

namespace TestCF\Controllers;

use TestCF\Traits\JsonRender;
use CF\Controllers\Controller;

class Api extends Controller
{

    use JsonRender;

    public function Index()
    {
        echo 'HelloWorld';
    }
}
?>


<?php

namespace TestCF\Traits;

trait JsonRender
{

    public static function render(array $data = [], int $httpStatus = 200): never
    {

        http_response_code($httpStatus);
        header('Content-Type: application/json');

        die(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
?>
```
