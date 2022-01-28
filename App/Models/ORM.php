<?php

namespace App\Models;

use App\DB;

class ORM
{
    public $db;
    public $tableName = '';

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function all()
    {
        return $this->db->query('SELECT * FROM ' . $this->tableName)->fetch_all(MYSQLI_ASSOC);
    }
}