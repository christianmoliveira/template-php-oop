<?php

declare(strict_types=1);

namespace App\Core;

use Throwable;

class Router
{
    /**
     * If the route passed exist, the correspondent controller will be executed.
     */
    public static function run(): void
    {
        try {
            $routerRegistered = new RoutersFilter();
            $router = $routerRegistered->get();

            $controller = new Controller();
            $controller->execute($router);
        } catch (Throwable $th) {
            echo $th->getMessage();
        }
    }
}
