<?php

namespace Neer\Web\Controllers;

use Neer\Foundation\Http\JsonResponse;

class TestController
{
    public function sayHelloAction($name)
    {
        return new JsonResponse(['hi' => "Hello $name"]);
    }
}