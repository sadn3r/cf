<?php
namespace CF\Controllers;

abstract class ControllerHtml extends Controller{

	public function render(string $tpl, array $data = []) {
		extract($data);
		require __DIR__ . "/../Views/{$tpl}.tpl";
	}
}