<?php
namespace App\Core;

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute($method, $uri, $action)
    {
        $this->routes[] = [$method, trim($uri, '/'), $action];
    }

    public function dispatch()
    {
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            list($method, $uri, $action) = $route;
            if ($method === $requestMethod && $uri === $requestUri) {
                return $this->callAction($action);
            }
        }

        http_response_code(404);
        echo "Page not found";
    }

    private function callAction($action)
    {
        list($controller, $method) = explode('@', $action);
        $controller = "App\\Controllers\\{$controller}";

        if (!class_exists($controller) || !method_exists($controller, $method)) {
            throw new \Exception("Controller or method not found");
        }

        $instance = new $controller;
        return $instance->$method();
    }
}
