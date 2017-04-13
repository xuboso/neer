<?php

namespace Neer\Foundation\Http;

class JsonResponse implements ResponseInterface
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
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($this->content);
    }
}