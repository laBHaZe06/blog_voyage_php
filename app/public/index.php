<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    var_dump($relative_class);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Route de l'application avec switch case 
$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
    case '/':
        $controller = new \App\Controllers\HomeController();
        echo $controller->index();
        break;
    case '/posts':
        $controller = new \App\Controllers\PostController();
        echo $controller->index();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
?>