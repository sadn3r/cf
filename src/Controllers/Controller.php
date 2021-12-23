<?php

namespace CF\Controllers;

use CF\Interfaces\IRequest;
use CF\Interfaces\Renderable;

abstract class Controller implements Renderable
{

    protected $request;

    function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    function __invoke($action, $args)
    {
        call_user_func_array([$this, $action], $args);
    }
}