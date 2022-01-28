<?php

namespace App\Controllers;

class PostController
{
    private static $instance;

    static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function index()
    {
        echo json_encode([
            'message' => 'Posts retrieved successfully',
            'data' => [
                [
                    'title' => 'Hello World',
                    'description' => 'Test Post Description'
                ],
                [
                    'title' => 'Hello World',
                    'description' => 'Test Post Description'
                ],
                [
                    'title' => 'Hello World',
                    'description' => 'Test Post Description'
                ],
            ]
        ]);
    }

}