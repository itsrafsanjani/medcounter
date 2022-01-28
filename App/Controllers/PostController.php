<?php

namespace App\Controllers;

use App\DB;

class PostController
{
    private static $instance;
    public $tableName = "posts";

    static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function index()
    {
        $db = DB::getInstance();
        $qry = $db->query('SELECT * FROM ' . $this->tableName);
        $posts = $qry->fetch_all(MYSQLI_ASSOC);

        echo json_encode([
            'message' => 'Posts retrieved successfully',
            'data' => $posts
        ]);
    }

}