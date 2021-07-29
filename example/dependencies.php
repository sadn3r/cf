<?php

namespace CF;

use CF\Db\{CFMysql, Db};
use AwesomeProject\Controllers\{
    Home
};
use AwesomeProject\Models\{
    Item
};

return [
    Router::class => function ($container) {
        return new Router($container->get(Request::class), require __DIR__ . '/routes.php');
    },
    Request::class => function ($container) {
        return new Request($_SERVER['REQUEST_URI'] ?? '', $_SERVER['REQUEST_METHOD'] ?? '', $_POST);
    },

    Home::class => function ($container) {
        return new Home($container->get(Request::class));
    },
    Item::class => function ($container) {
        return new Item($container->get(Db::class));
    },

    CFMysql::class => function ($container) {
        return new CFMysql(... require __DIR__ . '/db.config.php');
    },

    Db::class => function ($container) {
        return Db::instance($container->get(CFMysql::class));
    },
];
