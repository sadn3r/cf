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
	
	'/type/([a-z]+)' => [
		'controller'=> 'Home',
		'action'	=> 'Type',
	],

	'/property/([0-9]+)' => [
		'controller'	=> 'Home',
		'action'		=> 'Property',
	],

	'/properties-sort' => [
		'controller' => 'Admin',
		'action'	=> 'propertiesSort',
		'action'	=> [
			Request::GET => 'propertiesSort',
			Request::POST => 'propertiesSortPost'
		],
	],
];