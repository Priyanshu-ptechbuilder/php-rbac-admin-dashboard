<?php
// core/Router.php

class Router
{
    private $routes = [];

    public function add($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method'     => strtoupper($method),
            'path'       => $path,
            'controller' => $controller,
            'action'     => $action,
        ];
    }

    public function get($path, $controller, $action)
    {
        $this->add('GET', $path, $controller, $action);
    }

    public function post($path, $controller, $action)
    {
        $this->add('POST', $path, $controller, $action);
    }

    public function dispatch($uri, $method)
    {
        // Strip query string
        $uri = strtok($uri, '?');

        // Remove base path
        $basePath = '/metronic_project/public';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Default to /
        if (empty($uri)) $uri = '/';

        foreach ($this->routes as $route) {
            $pattern = $this->pathToRegex($route['path']);
            if (
                $route['method'] === strtoupper($method)
                && preg_match($pattern, $uri, $matches)
            ) {

                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $controllerFile = __DIR__ . '/../app/controllers/'
                    . $route['controller'] . '.php';

                if (!file_exists($controllerFile)) {
                    $this->notFound();
                    return;
                }
                require_once $controllerFile;
                $obj = new $route['controller']();
                $action = $route['action'];
                $obj->$action($params);
                return;
            }
        }
        $this->notFound();
    }

    private function pathToRegex($path)
    {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }

    private function notFound()
    {
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }
}
