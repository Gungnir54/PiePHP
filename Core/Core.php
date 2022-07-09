<?php

namespace Core;

include "src/routes.php";

class Core {

    public function run() {

        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        $uri[2] = '/'.$uri[2];
        $route = Router::get($uri[2]);

        $namespace = ucfirst(key($route));
        next($route);
        $action = $route['action'].ucfirst(key($route));
        $className = ucfirst($route['controller']).$namespace;
        $pathClass = $namespace.'\\'.$className;

        $class = new $pathClass;
        $class->$action();
    }

    public function dynamicRun() {

        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);

        if (empty($uri[2])) {
            $controllerName = 'app';
        } else {
            $controllerName = $uri[2];
        }

        $pathClass = 'Controller\\'.ucfirst($controllerName).'Controller';

        if (empty($uri[3])) {
            $actionName = 'index';
        } else {
            $actionName = $uri[3];
        }
        
        $action = $actionName.'Action';
        
        try {
            $class = new $pathClass;
            $class->$action();

        } catch (\Throwable $th) {
            echo "404 ".$th;
            die();
        }
    }
}
