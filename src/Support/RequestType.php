<?php

declare(strict_types=1);

namespace App\Support;

class RequestType
{
    /**
     * Returns the request method.
     */
    public static function get(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
