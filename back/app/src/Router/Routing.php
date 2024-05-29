<?php
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Router\Route;


// Routes 
Route::get('/api', function () {
    $controller = new HomeController();
    echo $controller->index();
});

Route::get('/api/articles', function () {
    $controller = new PostController();
    echo $controller->index();
});

Route::get('/api/article/:id', function (int $id) {
    $controller = new PostController();
    echo $controller->show($id);
});

Route::post('/api/articles/create', function () {
    $controller = new PostController();
    echo $controller->create();
});

Route::post('/api/register', function () {
    $controller = new RegisterController();
    echo $controller->register();
});

Route::post('/api/login', function () {
    $controller = new LoginController();
    echo $controller->login();
});

// Exécutez le routeur
Route::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>