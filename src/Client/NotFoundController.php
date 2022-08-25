<?php

declare(strict_types=1);

namespace App\Http\Client;

class NotFoundController extends Controller
{
    public function index()
    {
        $this->view('NotFound', '404', ['title' => '404 - Not Found']);
    }
}
