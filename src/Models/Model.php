<?php

namespace CF\Models;

use CF\Db\Db;

class Model {

	public function __construct(protected Db $db) {
	}

	/**
	 * @param string $sql
	 * @param array $data
	 * @return mixed
	 */
	public function exec(string $sql, array $data = []): mixed {
		return $this->db->exec($sql, $data);
	}
}