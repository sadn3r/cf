<?php
namespace CF\Traits;

trait HtmlRender {

	public function render(string $tpl = 'default', array $data = []) {
		extract($data);
		require __DIR__ . "/../Views/{$tpl}.tpl";
	}

}