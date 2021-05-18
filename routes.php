<?php
namespace CF;

return [
	'/' => [
		'controller'=> 'Home',
		'action'	=> 'Index',
	],

	'/item/([a-z\-]+)' => [
		'controller'=> 'Home',
		'action' => [
			Request::GET => 'Item',
			Request::POST => 'ItemPost',
		]
	],
	
];