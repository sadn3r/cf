<?php
namespace CF;

class Router {

	private $request;
	private $routes;
	private $notFoundRoute = [
		'controller'	=> 'Responses',
		'action'		=> 'NotFound',
		'arguments'		=> [],
	];

	function __construct(Request $request, array $routes) {
		$this->routes = $routes;
		$this->request = $request;
	}

	public function resolve() {

		foreach ($this->routes as $rule => $handler) {
			
			if (preg_match('#^'.$rule.'$#u', urldecode($this->request->getRequestUri()), $matches)) {
				
				if (is_array($handler['action'])) {
					if (!isset($handler['action'][$this->request->getRequestMethod()])) {
						continue;
					}
					
					$action = $handler['action'][$this->request->getRequestMethod()];
				} else {
					$action = $handler['action'];
				}

				array_shift($matches);
				return [
					'controller' => $handler['controller'],
					'action'	=> $action,
					'arguments'	=> $matches,
				];
			}
		}

		return $this->notFoundRoute;
	}
}