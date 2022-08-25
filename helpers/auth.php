<?php

use App\Support\Redirect;

function current_user(): string|null
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

/**
 * @return bool
 */
function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

/**
 * @return void
 */
function require_login(): void
{
    if (!is_user_logged_in()) {
        Redirect::redirectTo('/login');
    }
}
