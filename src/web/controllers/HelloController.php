<?php

namespace Neer\Web\Controllers;

use Neer\Foundation\Http\JsonResponse;
use Neer\Foundation\Http\Response;

class HelloController
{
    public function indexAction()
    {
        return new JsonResponse(['name' => 'jack']);
        return new Response("<h1>Hello</h1>");
    }

    public function homeAction()
    {

    }
}