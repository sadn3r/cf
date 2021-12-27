<?php

namespace CF;

use CF\Db\CFMysql;
use CF\Db\Db;
use CF\Controllers\Api;

return [
    Router::class => fn($dc) => new Router($dc->get(Request::class), require __DIR__ . '/routes.php'),
    Request::class => fn($dc) => new Request($_SERVER['REQUEST_URI'] ?? '', $_SERVER['REQUEST_METHOD'] ?? '', $_POST),
    Api::class => fn($dc) => new Api($dc->get(Request::class)),
    CFMysql::class => fn($dc) => new CFMysql(... require __DIR__ . '/db.config.php'),
    Db::class => fn($dc) => Db::instance($dc->get(CFMysql::class)),
];
