<?php

namespace App\Router;

/**
 * Router Template.
 *
 * Note: This is a template and can be customized for your needs.
 */
class Router
{
    private $routes = [
        '/' => "HomeController@index",
    ];

    /**
     * Dispatch the request URI to the appropriate controller and action.
     *
     * @param string $request_uri The current request URI.
     */
    public function dispatch($request_uri)
    {
        if (!preg_match("/^\/chambre\/\d+$/", $request_uri)) {
            if (!array_key_exists($request_uri, $this->routes)) {
                http_response_code(404);
                include './src/views/errors/page404.php';
                exit;
            }
            list($controller, $action) = explode('@', $this->routes[$request_uri]);
        }

        $segment1 = "";
        /**
         * If the request URI matches '/chambre/{id}', set the controller to RoomController,
         * the action to 'reservation', and extract the room ID.
         *
         * @param string $request_uri The incoming request URI.
         */
        if (preg_match("/^\/chambre\/\d+$/", $request_uri)) {
            $controller = 'RoomController';
            $action = 'reservation';
            $uriSegments = explode('/', $request_uri);
            $segment1 = $uriSegments[2];
        }


        $directory = '/controllers/' . $controller . '.php';
        if (!file_exists(__DIR__ . "../../$directory")) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit;
        }

        $controllerClass = "App\\Controllers\\$controller";
        if (!class_exists($controllerClass)) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit;
        }

        $controllerInstance = new $controllerClass();
        echo $segment1 ? $controllerInstance->$action($segment1) : $controllerInstance->$action();
    }
}
