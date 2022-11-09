<?php

namespace CF\Controllers;

use CF\Request;
use CF\Controllers\Controller;
use CF\Traits\JsonRender;

use Throwable;

class Api extends Controller {

	use JsonRender;

	public function Index() {
		echo 'HelloWorld';
	}

	public function __construct(Request $request) {
		parent::__construct($request);

		$driver = new \mysqli_driver();
		$driver->report_mode = MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX;
	}

}
