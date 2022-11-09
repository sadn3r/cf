<?php

namespace CF;

use CF\Controllers\HttpRequestMethod;
use CF\Interfaces\IRequest;

class Request implements IRequest {
	public readonly HttpRequestMethod $requestMethod;

	public function __construct(public readonly string $requestUri, string $requestMethod, public readonly array $post) {
		$this->requestMethod = HttpRequestMethod::from($requestMethod);
	}


	/**
	 * @param string|null $key
	 * @return mixed
	 */
	public function getJson(string $key = null): mixed {

		$jsonData = json_decode(file_get_contents('php://input'), true);

		return is_null($key) ? $jsonData : $jsonData[$key];
	}
}