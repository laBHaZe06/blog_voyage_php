<?php

use App\Router\Route;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Router/Route.php';

// Routes 
Route::add('/', 'GET', function () {
    $controller = new \App\Controllers\HomeController();
    echo $controller->index();
});

Route::add('/posts', 'GET', function () {
    $controller = new \App\Controllers\PostController();
    echo $controller->index();
});

Route::add('/posts/:id', 'GET', function () {
    $controller = new \App\Controllers\PostController();
    echo $controller->show($_GET['id']);
});

// Exécutez le routeur
Route::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>