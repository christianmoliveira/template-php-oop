<?php

declare(strict_types=1);

namespace App\Support;

class Session
{
    public static function sessionFlash(...$keys): array
    {
        $data = [];
        foreach ($keys as $key) {
            if (isset($_SESSION[$key])) {
                $data[] = $_SESSION[$key];
                unset($_SESSION[$key]);
            } else {
                $data[] = [];
            }
        }
        return $data;
    }
}
