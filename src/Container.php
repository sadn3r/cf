<?php
namespace CF;
use Exception;
class Container {
	private static $_instance;
	private $dependencies = [];

	private function __construct(array $dependencies = []) {
		$this->dependencies = $dependencies;
	}

	public static function getInstance(array $dependencies = []) {
		if(is_null(self::$_instance)) {
			self::$_instance = new self($dependencies);
		}

		return self::$_instance;
	}

	public function has(string $id): bool {
		return isset($this->dependencies[$id]);
	}

	public function get(string $id) {
		if ($this->has($id)) {
			return $this->resolve($id);
		}

		throw new Exception("Dependency {$id} not found");
	}

	public function make(string $id) {
		try {
			return $this->get($id);
		} catch (Exception $e) {
			return new $id();
		}
	}

	private function resolve(string $id) {
		return call_user_func($this->dependencies[$id], $this);
	}
}