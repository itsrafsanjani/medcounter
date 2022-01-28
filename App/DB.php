<?php

namespace App;

// a db class for connecting to the database
class DB
{
    private static $instance = NULL;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect("localhost", "root", "", "medcounter");
        }
        return self::$instance;
    }
}
