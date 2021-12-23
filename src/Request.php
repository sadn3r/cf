<?php

namespace CF;

use CF\Interfaces\IRequest;

class Request implements IRequest
{

    const GET = 'GET';
    const POST = 'POST';
    const DELETE = 'DELETE';
    const PUT = 'PUT';

    public function __construct(public readonly string $requestUri, public readonly string $requestMethod, public readonly array $post)
    {
    }

    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function getJson(string $key = null)
    {

        $rawData = file_get_contents('php://input');
        $jsonData = json_decode($rawData, true);

        $result = null;

        if (is_null($key)) {
            $result = $jsonData;
        } else {
            $result = $jsonData[$key];
        }

        return $result;
    }
}