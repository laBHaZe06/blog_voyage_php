<?php

namespace App\Router;

class Route {
    private static $routes = [];
    private static $cacheDir = __DIR__ . '/../../cache/';

    // Méthode pour enregistrer une route GET
    public static function get($uri, $callback)
    {
        self::$routes['GET'][$uri] = $callback;
    }

    // Méthode pour enregistrer une route POST
    public static function post($uri, $callback)
    {
        self::$routes['POST'][$uri] = $callback;
    }

    // Méthode pour dispatcher la route et exécuter le callback associé
    public static function dispatch($uri, $method)
    {
        // Vérifier si la route existe pour la méthode HTTP spécifiée
        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $route => $callback) {
                // Utiliser une expression régulière pour faire correspondre la route avec l'URI
                $pattern = preg_replace('/\/:[^\/]+/', '/([^/]+)', $route);
                if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                    // Si la route correspond, vérifier si le callback est une fonction valide avant de l'appeler
                    if (is_callable($callback)) {
                        array_shift($matches); // Retirer le premier élément (correspondant à l'URI complète)
                        call_user_func_array($callback, $matches);
                        return;
                    } else {
                        // Si le callback n'est pas une fonction valide, retourner une erreur 500
                        http_response_code(500);
                        echo 'Internal Server Error';
                        return;
                    }
                }
            }
        }

        // Si aucune route correspond, retourner une erreur 404
        http_response_code(404);
        echo 'Page not found';
    }
}

