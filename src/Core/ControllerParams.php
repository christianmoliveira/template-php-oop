<?php

declare(strict_types=1);

namespace App\Core;

use App\Routes\Routes;
use App\Support\RequestType;
use App\Support\Uri;

class ControllerParams
{
    /**
     * Get route params and return them as an array.
     *
     * @param string $router
     * @return array
     */
    public static function get(string $router): array
    {
        $uri = Uri::get();
        $routes = Routes::get();
        $requestMethod = RequestType::get();

        $router = array_search($router, $routes[$requestMethod]);

        $explodeUri = explode('/', $uri);
        $explodeRouter = explode('/', $router);

        $params = [];
        foreach ($explodeRouter as $index => $routerSegment) {
            if ($routerSegment !== $explodeUri[$index]) {
                $params[$index] = $explodeUri[$index];
            }
        }

        return array_values($params);
    }
}
