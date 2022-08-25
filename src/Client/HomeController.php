<?php

declare(strict_types=1);

namespace App\Http\Client;

use Exception;

class HomeController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view('Home', 'home', ['title' => 'Home']);
    }
}
