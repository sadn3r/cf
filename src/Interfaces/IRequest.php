<?php

namespace CF\Interfaces;

interface IRequest
{

    public function getRequestUri(): string;

    public function getRequestMethod(): string;
}