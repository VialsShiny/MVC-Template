<?php

namespace App\router;
class Router
{
    private $routes = [
        '/' => "HomeController@index",
    ];


    public function dispatch($request_uri)
    {
        if (!preg_match("/^\/chambre\/\d+$/", $request_uri)) {
            if (!array_key_exists($request_uri, $this->routes)) {
                http_response_code(404);
                include './src/views/errors/page404.php';
                exit;
            }
            $valueRoutes = explode('@', $this->routes[$request_uri]);
            $controller = $valueRoutes[0];
            $action = $valueRoutes[1];
        }

        $segment1 = "";
        if (preg_match("/^\/chambre\/\d+$/", $request_uri)) {
            $controller = 'RoomController';
            $action = 'reservation';
            $uriSegment = explode('/', $request_uri);

            $segment1 = $uriSegment[2];
        }

        $directory = '/controllers/' . $controller . '.php';
        if (!file_exists(__DIR__ . "../../$directory")) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit;
        }
        $controllerPass = "App\\Controllers\\$controller";
        $controlerInstance = new $controllerPass();
        if (!class_exists($controllerPass)) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit;
        }

        if ($segment1) {
            echo $controlerInstance->$action($segment1);
            return;
        }
        echo $controlerInstance->$action();
    }


}
