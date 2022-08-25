<?php

declare(strict_types=1);

namespace App\Core;

use App\Routes\Routes;
use App\Support\RequestType;
use App\Support\Uri;

class RoutersFilter
{
    private string $uri;
    private string $method;
    private array $routesRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequestType::get();
        $this->routesRegistered = Routes::get();
    }

    /**
     * Verifies if the requested route exists.
     */
    public function simpleRouter(): string|null
    {
        if (array_key_exists($this->uri, $this->routesRegistered[$this->method])) {
            return $this->routesRegistered[$this->method][$this->uri];
        }

        return null;
    }

    /**
     * Verifies if the requested dynamic route exists.
     */
    public function dynamicRouter(): string|null
    {
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            if ($index !== '/' && preg_match("/^$regex$/", ltrim($this->uri, '/'))) {
                return $route;
            }
        }
        return null;
    }

    /**
     * Returns the requested route.
     */
    public function get(): string
    {
        $router = $this->simpleRouter();

        if ($router) {
            return $router;
        }

        $router = $this->dynamicRouter();

        if ($router) {
            return $router;
        }

        return 'Client/NotFoundController@index';
    }
}
