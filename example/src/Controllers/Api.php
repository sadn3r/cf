<?php

namespace CF\Controllers;

use CF\Request;
use CF\Controllers\Controller;
use CF\Exceptions\NotFoundException;
use CF\Traits\JsonRender;

use Throwable;

class Api extends Controller
{

    use JsonRender;

    public function Index()
    {
        echo 123;
    }

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $driver = new \mysqli_driver();
        $driver->report_mode = MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX;
    }

    public function __invoke($action, $args)
    {
        try {

            parent::__invoke($action, $args);

        } catch (NotFoundException $th) {
            $this->render([
                'error' => $th->getMessage(),
                'errorCode' => $th->getCode(),
            ], 404);
        } catch (Throwable $throwable) {

            $this->render([
                'error' => $throwable->getMessage(),
                'errorCode' => $throwable->getCode(),
            ], 500);

        }
    }
}