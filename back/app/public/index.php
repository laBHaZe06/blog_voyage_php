<?php

use App\Router\Route;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Router/Route.php';

// Routes 
Route::get('/', function () {
    $controller = new \App\Controllers\HomeController();
    echo $controller->index();
});

Route::get('/posts', function () {
    $controller = new \App\Controllers\PostController();
    echo $controller->index();
});

Route::get('/posts/:id', function () {
    $controller = new \App\Controllers\PostController();
    echo $controller->show($_GET['id']);
});

// Exécutez le routeur
Route::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>