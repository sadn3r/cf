<?php

namespace CF;

use CF\Db\{CFMysql, Db};
use CF\Controllers\{
    Api
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

    Api::class => function ($container) {
        return new Api($container->get(Request::class));
    },


    CFMysql::class => function ($container) {
        return new CFMysql(... require __DIR__ . '/db.config.php');
    },

    Db::class => function ($container) {
        return Db::instance($container->get(CFMysql::class));
    },
];
