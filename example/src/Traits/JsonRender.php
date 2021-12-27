<?php

namespace CF\Traits;

trait JsonRender
{

    public static function render(array $data = [], int $httpStatus = 200): never
    {

        http_response_code($httpStatus);
        header('Content-Type: application/json');

        die(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
