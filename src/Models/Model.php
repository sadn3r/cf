<?php

namespace CF\Models;

use CF\Db\Db;

class Model
{

    public function __construct(protected Db $db)
    {
    }

    public function exec(string $sql, array $data = [])
    {
        return $this->db->exec($sql, $data);
    }
}