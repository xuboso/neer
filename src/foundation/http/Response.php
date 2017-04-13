<?php

namespace Neer\Foundation\Http;

class Response implements ResponseInterface
{
    protected $content;

    public function __construct($input)
    {
        $this->content = $input;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function send()
    {
        echo $this->content;
    }
}