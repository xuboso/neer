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
        ob_start();
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($this->content);
    }

    public function terminate()
    {
        ob_end_flush();
    }
}