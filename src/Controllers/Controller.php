<?php
namespace CF\Controllers;
use CF\Interfaces\IRequest;

abstract class Controller{

	protected $request;

	function __construct(IRequest $request) {
		$this->request = $request;
	}
}