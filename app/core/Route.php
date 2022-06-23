<?php

namespace App\Native\Core;

class Route
{

    private static $routes = [];

    public static function add(string $method, string $url, $controller, string $function)
    {
        self::$routes[] = [
            'method'     => $method,
            'url'        => $url,
            'controller' => $controller,
            'function'   => $function
        ];
    }

    public static function run()
    {
        $url = "/";

        if (isset($_SERVER['REQUEST_URI'])) {
            $url = $_SERVER['REQUEST_URI'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route['url'] . "$#";
            if (preg_match($pattern, $url, $variables) && $route['method'] == $method) {
                $controller = new $route['controller'];
                $function = $route['function'];
                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);
                return;
            }
        }
        http_response_code(404);
        echo "CONTROLLER NOT FOUND";
    }
}
