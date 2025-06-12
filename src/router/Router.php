<?php

namespace App\Router;

/**
 * Router Template.
 *
 * This class is responsible for routing incoming requests to the appropriate controller and action.
 */
class Router
{
    // Define the routes mapping request URIs to controller actions.
    private $routes = [
        '/' => "HomeController@index",
        '/chambre/{id}' => "RoomController@reservation", // Route for room reservation (example)
    ];

    /**
     * Dispatch the request URI to the appropriate controller and action.
     *
     * @param string $request_uri The current request URI.
     */
    public function dispatch($request_uri)
    {
        // Check if the request URI matches any defined routes
        foreach ($this->routes as $route => $action) {
            $pattern = preg_replace('/\{(\w+)\}/', '(\d+)', $route);
            $pattern = "#^" . $pattern . "$#";
            if (preg_match($pattern, $request_uri, $matches)) {
                list($controller, $action) = explode('@', $action);
                array_shift($matches);
                $params = $matches;
                break;
            }
        }

        // If no matching route was found, return a 404 error
        if (!isset($controller)) {
            http_response_code(404);
            include './src/views/errors/page404.php';
            exit;
        }

        // Construct the path to the controller file
        $directory = '/controllers/' . $controller . '.php';
        if (!file_exists(__DIR__ . "../../$directory")) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit;
        }

        // Check if the controller class exists
        $controllerClass = "App\\Controllers\\$controller";
        if (!class_exists($controllerClass)) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit;
        }

        // Create an instance of the controller
        $controllerInstance = new $controllerClass();

        // Call the action method with parameters if available
        echo $params ? $controllerInstance->$action(...$params) : $controllerInstance->$action();
    }
}
