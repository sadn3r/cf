<?php

namespace CF;

use Exception;

class Container
{

    private static ?Container $_instance = null;


    private function __construct(private array $dependencies = [])
    {
    }

    public static function getInstance(array $dependencies = []): Container
    {
        return match (self::$_instance) {
            null => self::$_instance = new self($dependencies),
            default => self::$_instance
        };
    }

    public function has(string $id): bool
    {
        return isset($this->dependencies[$id]);
    }

    public function get(string $id)
    {
        if ($this->has($id)) {
            return $this->resolve($id);
        }

        throw new Exception("Dependency {$id} not found");
    }

    public function set(string $id, $resolve)
    {
        $this->dependencies[$id] = $resolve;
    }

    public function make(string $id)
    {
        try {
            return $this->get($id);
        } catch (Exception) {
            return new $id();
        }
    }

    private function resolve(string $id)
    {
        return call_user_func($this->dependencies[$id], $this);
    }
}