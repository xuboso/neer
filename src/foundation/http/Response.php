<?php

namespace Neer\Foundation\Http;

class Response implements ResponseInterface
{
    protected $content;

    public function __construct($input)
    {
        $this->content = $input;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function send()
    {
        ob_start();
        echo $this->content;
    }

    public function withCookie($name, $value, $seconds = null, $path = null, $domain = null)
    {
        setcookie($name, $value, time() + $seconds, $path, $domain);
        return $this;
    }

    public function terminate()
    {
        ob_end_flush();
    }

    public function expires($seconds)
    {
        $expires_at = gmdate("D, d M Y H:i:s", time() + $seconds) . " GMT";
        header("Expires: ". $expires_at);
        header("Cache-Control: max-age=". $seconds);
        return $this;
    }
}