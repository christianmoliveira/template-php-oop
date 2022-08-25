<?php

declare(strict_types=1);

namespace App\Support;

class Redirect
{
    /**
     * @param string $url
     * @return void
     */
    public static function redirectTo(string $url): void
    {
        header('Location:' . $url);
        exit;
    }

    /**
     * @param string $url
     * @param array $items
     * @return void
     */
    public static function redirectWith(string $url, array $items): void
    {
        foreach ($items as $key => $value) {
            $_SESSION[$key] = $value;
        }

        self::redirectTo($url);
    }

    /**
     * @param string $url
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function redirectWithMessage(string $url, string $message, string $type = 'success'): void
    {
        Flash::flash('flash_' . uniqid(), $message, $type);
        self::redirectTo($url);
    }
}
