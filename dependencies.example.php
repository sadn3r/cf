<?php
namespace CF;
use CF\Db\{CFMysql, Db};
use CF\Controllers\{
	Admin,
	Home
};
use CF\Models\{
	Item
};
return [
	Router::class => function($container) {
		return new Router($container->get(Request::class), require './../routes.example.php');
	},
	Request::class => function($container) {
		return new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_POST);
	},
	Item::class => function($container) {
		return new Item($container->get(Db::class));
	},
	Home::class => function($container) {
		return new Home($container->get(Request::class));
	},
	Admin::class => function($container) {
		return new Admin($container->get(Request::class));
	},
	CFMysql::class => function($container) {
		extract(require './../db.example.php');
		return new CFMysql($db_addr, $db_user, $db_pass, $db_name, $db_sock?0:$db_port, $db_sock);
	},
	Db::class => function($container) {
		return Db::instance($container->get(CFMysql::class));
	},
];