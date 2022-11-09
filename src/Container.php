<?php

namespace CF;

use Exception;

class Container {

	private static ?Container $_instance = null;


	private function __construct(private array $dependencies = []) {
	}


	/**
	 * @param array $dependencies
	 * @return Container
	 */
	public static function getInstance(array $dependencies = []): Container {
		return match (self::$_instance) {
			null => self::$_instance = new self($dependencies),
			default => self::$_instance
		};
	}


	/**
	 * @param string $id
	 * @return bool
	 */
	public function has(string $id): bool {
		return isset($this->dependencies[$id]);
	}


	/**
	 * @param string $id
	 * @return mixed
	 * @throws Exception
	 */
	public function get(string $id): mixed {
		if ($this->has($id)) {
			return $this->resolve($id);
		}

		throw new Exception("Dependency {$id} not found");
	}


	/**
	 * @param string $id
	 * @param $resolve
	 * @return void
	 */
	public function set(string $id, $resolve): void {
		$this->dependencies[$id] = $resolve;
	}


	/**
	 * @param string $id
	 * @return mixed
	 */
	public function make(string $id): mixed {
		try {
			return $this->get($id);
		} catch (Exception) {
			return new $id();
		}
	}


	/**
	 * @param string $id
	 * @return mixed
	 */
	private function resolve(string $id): mixed {
		return call_user_func($this->dependencies[$id], $this);
	}
}