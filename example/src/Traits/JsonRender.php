<?php
namespace AwesomeProject\Traits;

trait JsonRender {

    public static function render(array $data = [], int $httpStatus = 200) {

        http_response_code($httpStatus);
        header('Content-Type: application/json');

        die(json_encode($data));
    }
}
