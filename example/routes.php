<?php

namespace CF;

use CF\Controllers\Api;
use CF\Controllers\HttpRequestMethod;

return [

	'/' => [
		HttpRequestMethod::GET->value => [Api::class, 'Index']
	],

	'/item/([a-z\-]+)' => [
		HttpRequestMethod::GET->value  => [Api::class, 'Item'],
		HttpRequestMethod::POST->value => [Api::class, 'ItemPost'],
	],
];
