<?php
namespace CF\Models;
use CF\Db\Db;
class Model {

	private $db;

	public function __construct(Db $db) {
		$this->db = $db;
	}

	public function exec(string $sql, array $data = []) {
		return $this->db->exec($sql, $data);
	}
}