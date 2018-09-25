<?php

namespace vendor\Manticora\core;


class Router
{
    /*
     * Parameters from the matched route
     */
    protected $param = array();
    /*
     * Array of created routes
     */
    protected $routes = array();

    /*
     * Add new route
     */
    public function add($url, $controller, $method = 'GET')
    {
        $url = trim($url, '/');
        $url = preg_replace('#[{]id[}]$#', '[1-9][0-9]*', $url, 1);
        $url = '#^' . $url . '$#';

        $controller = $this->parseController($controller);

        if (!array_key_exists($url, $this->routes)) {
            $this->routes[$url] = [
                'controller' => $controller[0],
                'action' => $controller[1],
                'method' => strtoupper($method),
            ];
        }
    }

    /*
     * Parsing controller and method
     */
    public function parseController($controller)
    {
        $controller = explode('@', $controller, 2);
        $controller[0] = ucfirst($controller[0]);
        $controller[1] = lcfirst($controller[1]);
        return $controller;
    }

    /*
     * Checking existence of this route
     */
    public function math()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = parse_url($url, PHP_URL_PATH);
        if ($url === null) {
            $url = '';
        }

        foreach ($this->routes as $key => $route) {
            if (preg_match($key, $url, $matches) and $route['method'] == $_SERVER['REQUEST_METHOD']) {
                $this->param['id'] = $matches[0];
                return $key;
            }
        }
        return false;
    }


    /*
     * Running routing and connection of a controller and method
     */
    public function run()
    {
        $url = $this->math();
        if ($url) {
            $path = 'app\Controllers\\' . $this->routes[$url]['controller'];
            if (class_exists($path)) {
                $action = $this->routes[$url]['action'];
                if (method_exists($path, $action)) {
                    $controller = new $path($this->param);
                    $controller->$action();
                } else {
                    throw new \Exception("Method $action in controller $path cannot be found.");
                }
            } else {
                throw new \Exception("Controller class $path not found.");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }
}