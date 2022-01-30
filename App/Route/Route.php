<?php

namespace App\Route;

class Route
{
    private static $noMatch = true;

    //private static $namespace = 'App\Controllers\\';

    static function get($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return;
        }
        self::process($pattern, $callback);
    }

    private static function process($pattern, $callback)
    {
        $pattern = "~^{$pattern}/?$~";
        $params = self::getMatches($pattern);
        if ($params) {
            $functionArguments = array_slice($params, 1);
            self::$noMatch = false;
            if (is_callable($callback)) {
                if (is_array($callback)) {
                    $className = $callback[0];
                    $methodName = $callback[1];
                    $instance = $className::getInstance();
                    $instance->$methodName(...$functionArguments);
                } else {
                    $callback(...$functionArguments);
                }
            } else {
                $callback = implode('@', $callback);
                $parts = explode('@', $callback);
                $className = $parts[0];
                $methodName = $parts[1];
                $instance = $className::getInstance();
                $instance->$methodName(...$functionArguments);
            }
        }
    }

    private static function getMatches($pattern)
    {
        $url = self::getUrl();
        if (preg_match($pattern, $url, $matches)) {
            return $matches;
        }
        return false;
    }

    private static function getUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    static function post($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        self::process($pattern, $callback);
    }

    static function put($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
            return;
        }
        parse_str(file_get_contents('php://input'), $_PUT);
        self::process($pattern, $callback);
    }

    static function patch($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PATCH') {
            return;
        }
        self::process($pattern, $callback);
    }

    static function delete($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
            return;
        }
        self::process($pattern, $callback);
    }

    static function cleanup()
    {
        if (self::$noMatch) {
            echo "No routes matched";
        }
    }
}
