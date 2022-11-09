<?php

namespace CF\Controllers;

use CF\Interfaces\IRequest;
use CF\Interfaces\Renderable;

abstract class Controller implements Renderable {

	public function __construct(protected IRequest $request) {
	}

	public function __invoke($action, $args) {
		call_user_func_array([$this, $action], $args);
	}
}