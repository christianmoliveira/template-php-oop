<?php

declare(strict_types=1);

namespace App\Routes;

class Routes
{
    /**
     * Return all registered routes.
     *
     * @return array<array<string>>
     */
    public static function get(): array
    {
        return [
            'GET' => [
                '/' => 'Http/Client/HomeController@index',
            ],
            'POST' => [
            ],
        ];
    }
}
