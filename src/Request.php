<?php
namespace CF;
use CF\Interfaces\IRequest;

class Request Implements IRequest {

	const GET = 'GET';
	const POST = 'POST';
	const DELETE = 'DELETE';
 	const PUT = 'PUT';
 	
	private $requestUri;
	private $requestMethod;
	private $post;

	function __construct(string $requestUri, string $requestMethod, array &$post)
	{
		$this->requestUri = $requestUri;
		$this->requestMethod = $requestMethod;
		$this->post = $post;
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