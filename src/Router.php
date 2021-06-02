<?php
namespace CF;
use CF\Controllers\Responses;
use Exception;
class Router {

	private $request;
	private $routes;

	function __construct(Request $request, array $routes) {
		$this->routes = $routes;
		$this->request = $request;
	}

	public function resolve() {

		foreach ($this->routes as $rule => $handler) {

			if (preg_match('#^'.$rule.'$#u', urldecode($this->request->getRequestUri()), $matches)) {
				
				if (!array_key_exists($this->request->getRequestMethod(), $handler)) {
					continue;
				}
								
				list($controller, $action) 
					= $handler[$this->request->getRequestMethod()];
				

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
