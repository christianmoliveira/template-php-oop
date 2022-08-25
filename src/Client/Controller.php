<?php

declare(strict_types=1);

namespace App\Http\Client;

use Exception;
use League\Plates\Engine;

abstract class Controller
{
    /**
     * Return a view, if it exists.
     *
     * @throws Exception
     */
    protected function view(string $domain, string $view, array $data = []): void
    {
        $viewPath = "../templates/{$domain}/{$view}.php";

        if (!file_exists($viewPath)) {
            throw new Exception("The view {$view} does not exist.");
        }

        $templates = new Engine("../templates");
        echo $templates->render("{$domain}/$view", $data);
    }
}
