<?php

namespace Neer\Foundation\Http;

interface ResponseInterface
{
    public function send();

    public function terminate();
}