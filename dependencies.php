<?php
namespace CF;
use CF\Db\{CFMysql, Db};
return [
	Router::class => function($container) {
		return new Router($container->get(Request::class), require './../routes.php');
	},
	Request::class => function($container) {
		return new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_POST);
	},
	Models\Item::class => function($container) {
		return new Models\Item($container->get(Db::class));
	},
	Controllers\Home::class => function($container) {
		return new Controllers\Home($container->get(Request::class));
	},
	Controllers\Admin::class => function($container) {
		return new Controllers\Admin($container->get(Request::class));
	},
	User::class => function($container) {
		return new User($container->get(Db::class));
	},
	CFMysql::class => function($container) {
		extract(require './../dbconfig.php');
		return new CFMysql($db_addr, $db_user, $db_pass, $db_name, $db_sock?0:$db_port, $db_sock);
	},
	Db::class => function($container) {
		return Db::instance($container->get(CFMysql::class));
	},
];