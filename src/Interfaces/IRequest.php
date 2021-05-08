<?php
namespace CF\Interfaces;

Interface IRequest {
	
	public function getRequestUri():string;
	public function getRequestMethod():string;
}