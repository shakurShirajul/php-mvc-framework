<?php

namespace Router;

class Router
{

    private $uri, $method, $response, $routes = [];
    public function __construct($uri, $method)
    {
        $uri = explode('?', $uri)[0];
        $this->uri = $uri;
        $this->method = $method;
        $this->response = $GLOBALS['response'];
    }

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
        ];
    }
    public function get($uri, $controller)
    {
        return $this->add("GET", $uri, $controller);
    }
    public function post($uri, $controller)
    {
        return $this->add("POST", $uri, $controller);
    }
    public function delete($uri, $controller)
    {
        return $this->add("DELETE", $uri, $controller);
    }
    public function patch($uri, $controller)
    {
        return $this->add("PATCH", $uri, $controller);
    }
    public function put($uri, $controller)
    {
        return $this->add("PUT", $uri, $controller);
    }
    public function route()
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $this->uri && $route['method'] === $this->method) {
                $controller = $route['controller'];
                $controllerInstance = new $controller[0]();
                $method = $controller[1];
                if (is_callable([$controllerInstance, $method])) {
                    return $controllerInstance->$method($_GET);
                }
            }
        }
    }
}
