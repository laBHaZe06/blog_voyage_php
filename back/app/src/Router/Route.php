<?php

namespace App\Router;


class Route {

    private static $routes = [];
    public static function add($url, $method, $handler)
    {
        self::$routes[] = [
            'url' => $url,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function dispatch($uri, $method)
    {
        foreach (self::$routes as $route) {
            if ($route['url'] === $uri && $route['method'] === $method) {
                $handler = $route['handler'];
                $handler();
                return;
            }
        }
        http_response_code(404);
        echo 'Page not found';
    }
    
}