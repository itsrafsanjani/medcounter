<?php

namespace App;

use App\Controllers\PostController;
use App\Route\Route;

Route::get('/', function () {
    echo "Welcome";
});

Route::get('/hello/world', function () {
    echo "Hello World";
});

Route::get('/greet/(\w+)', function ($name) {
    echo "Hello {$name}";
});

Route::get('/greet/(\w+)/title/(\w+)', function ($name, $title) {
    echo "Hello {$title} {$name}";
});

Route::get('/verb', function () {
    echo $_SERVER['REQUEST_METHOD'];
});

Route::post('/verb', function () {
    echo $_SERVER['REQUEST_METHOD'];
});

Route::delete('/verb', function () {
    echo $_SERVER['REQUEST_METHOD'];
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts2', 'PostController@index');

//Route::get('/hello/world', 'HelloController@sayHelloWorld');

Route::cleanup();
