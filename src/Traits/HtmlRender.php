<?php

namespace CF\Traits;

trait HtmlRender {

	/**
	 * @param string $tpl
	 * @param array $data
	 * @return void
	 */
	public function render(string $tpl = 'default', array $data = []): void {
		extract($data);
		require $this->dir . "/../Views/{$tpl}.tpl";
	}

}