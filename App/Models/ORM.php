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

    public function save($data)
    {
        $arr_exception = ['NOW()', 'CURDATE()'];

        $query = "INSERT INTO `" . $this->tableName . "` (";
        $counter = 0;
        foreach ($data as $key => $value) {
            if ($counter < (count($data) - 1)) {
                $query .= "`" . $key . "`, ";
            } else {
                $query .= "`" . $key . "`) ";
            }
            $counter++;
        }
        $query .= "VALUES (";
        $counter = 0;
        foreach ($data as $value) {
            if ($counter < (count($data) - 1)) {
                if (in_array(strtoupper($value), $arr_exception)) {
                    $query .= $value . ", ";
                } else {
                    $query .= "'" . $this->escapeString($value) . "', ";
                }
            } else {
                if (in_array(strtoupper($value), $arr_exception)) {
                    $query .= $value . ")";
                } else {
                    $query .= "'" . $this->escapeString($value) . "')";
                }
            }
            $counter++;
        }

        return $this->db->query($query);
    }

    public function escapeString($str)
    {
        return mysqli_real_escape_string($this->db, $str);
    }

    public function show($id)
    {
        return $this->db->query('SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $id)->fetch_assoc();
    }

    public function update($data, $id, $tableId = 'id', $customWhere = NULL)
    {
        $counter = 0;
        $arr_exception = ['NOW()', 'CURDATE()'];

        $query = "UPDATE " . $this->tableName . " SET ";
        foreach ($data as $key => $value) {
            if ($counter < (count($data) - 1)) {
                if (in_array(strtoupper($value), $arr_exception)) {
                    $query .= $key . " = " . $value . ", ";
                } else {
                    $query .= $key . " = '" . $this->escapeString($value) . "', ";
                }
            } else {
                if (in_array(strtoupper($value), $arr_exception)) {
                    $query .= $key . " = " . $value . " ";
                } else {
                    $query .= $key . " = '" . $this->escapeString($value) . "' ";
                }
            }
            $counter++;
        }

        if ($customWhere == NULL) {
            $query .= "WHERE " . $tableId . " = '" . $id . "'";
        } else {
            $query .= $customWhere;
        }

        return $this->db->query($query);
    }

    public function delete($id)
    {
        return $this->db->query('DELETE FROM ' . $this->tableName . ' WHERE id = ' . $id);
    }
}