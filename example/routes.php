<?php

namespace CF;

use CF\Controllers\Api;
use CF\Controllers\Responses;

return [

    '/' => [
        Request::GET => [Api::class, 'Index']
    ],

    '/item/([a-z\-]+)' => [
        Request::GET => [Api::class, 'Item'],
        Request::POST => [Api::class, 'ItemPost'],
    ],
];
