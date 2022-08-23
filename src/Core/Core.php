<?php

declare(strict_types=1);

namespace App\Core;

use Exception;

class Controller
{
    /**
     * Verifies if the controller and the passed method exist.
     * In case true, instantiate the controller and run the method.
     *
     * @throws Exception
     */
    public function execute(string $router): void
    {
        if (!str_contains($router, '@')) {
            throw new Exception("The route is registered with the wrong format.");
        }

        $routerSegments = explode('/', $router);

        if (count($routerSegments) == 2) {
            [$sub, $class] = $routerSegments;
            [$controller, $method] = explode('@', $class);

            $namespace = "App\\{$sub}\\";
        } else {
            [$sub, $level, $class] = $routerSegments;
            [$controller, $method] = explode('@', $class);

            $namespace = "App\\{$sub}\\{$level}\\";
        }

        $controllerNamespace = $namespace . $controller;

        if (!class_exists($controllerNamespace)) {
            throw new Exception("The controller {$controller} does not exist.");
        }

        $controller = new $controllerNamespace();

        if (!method_exists($controller, $method)) {
            throw new Exception("The method {$method} does not exist.");
        }

        $params = ControllerParams::get($router);

        $controller->$method($params);
    }
}
