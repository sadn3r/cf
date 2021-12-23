<?php

namespace CF;

use CF\Controllers\Api;

return [

    '/' => [
        Request::GET => [Api::class, 'Index']
    ],

    '/item/([a-z\-]+)' => [
        Request::GET => [Api::class, 'Item'],
        Request::POST => [Api::class, 'ItemPost'],
    ],
];
