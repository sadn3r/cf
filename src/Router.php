<?php

namespace CF;

use Exception;

class Router
{

    public function __construct(private Request $request, private array $routes)
    {
    }

    public function resolve()
    {

        foreach ($this->routes as $rule => $handler) {

            if (preg_match('#^' . $rule . '$#u', urldecode($this->request->requestUri), $matches)) {

                if (!array_key_exists($this->request->requestMethod->value, $handler)) {
                    continue;
                }

                [$controller, $action] = $handler[$this->request->requestMethod->value];

                array_shift($matches);
                return [
                    'controller' => $controller,
                    'action' => $action,
                    'arguments' => $matches,
                ];
            }
        }

        throw new Exception("Action Unhandled", 1);
    }
}
