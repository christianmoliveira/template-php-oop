<?php

declare(strict_types=1);

namespace App\Support;

class Uri
{
    /**
     * Returns the request URI.
     */
    public static function get(): string
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
}
