<?php

namespace App;

use App\Controllers\MedicineController;
use App\Controllers\UserController;
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

Route::post('/login', [UserController::class, 'login']);

Route::get('/medicines', [MedicineController::class, 'index']);
Route::post('/medicines', [MedicineController::class, 'store']);
Route::get('/medicines/(\w+)/show', [MedicineController::class, 'show']);
Route::delete('/medicines/(\w+)', [MedicineController::class, 'destroy']);
Route::post('/medicines/(\w+)', [MedicineController::class, 'update']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/(\w+)/show', [UserController::class, 'show']);
Route::delete('/users/(\w+)', [UserController::class, 'destroy']);
Route::post('/users/(\w+)', [UserController::class, 'update']);
Route::post('/users/(\w+)/email-verify', [UserController::class, 'emailVerify']);

Route::cleanup();
