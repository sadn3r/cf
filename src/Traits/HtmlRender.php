<?php

namespace CF\Traits;

trait HtmlRender
{

    public function render(string $tpl = 'default', array $data = [])
    {
        extract($data);
        require $this->dir . "/../Views/{$tpl}.tpl";
    }

}