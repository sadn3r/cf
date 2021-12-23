<?php

namespace CF;

use CF\Controllers\Home;
use CF\Controllers\Responses;

return [

    '/' => [
        Request::GET => [Home::class, 'Index']
    ],

    '/item/([a-z\-]+)' => [
        Request::GET => [Home::class, 'Item'],
        Request::POST => [Home::class, 'ItemPost'],
    ],
];
