<?php

namespace Neer\Web\Controllers;

use Neer\Foundation\Http\JsonResponse;
use Neer\Foundation\Http\Response;

class HelloController
{
    public function indexAction()
    {
        return new JsonResponse(['name' => 'jack']);
        $response = (new Response("<h1>Hello</h1>"))->withCookie("server", true, 60)->expires(60);
        return $response;
    }

    public function homeAction()
    {

    }
}