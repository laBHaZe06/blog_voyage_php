<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Router\Route;
// Inclure l'autoloader manuel
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Routes 
Route::get('/', function () {
    $controller = new HomeController();
    echo $controller->index();
});

Route::get('/posts', function () {
    $controller = new PostController();
    echo $controller->index();
});

Route::get('/posts/:id', function (int $id) {
    $controller = new PostController();
    echo $controller->show($id);
});

Route::post('/posts', function () {
    $controller = new PostController();
    echo $controller->create();
});

Route::post('/register', function () {
    $controller = new RegisterController();
    echo $controller->register();
});

Route::post('/login', function () {
    $controller = new LoginController();
    echo $controller->login();
});

// Exécutez le routeur
Route::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


?>