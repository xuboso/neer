<?php

namespace Neer\Foundation\Http;

class Request implements RequestInterface
{
    protected $request = array();

    public function __construct()
    {
        $this->request = $this->getRequest();
    }

    public function getRequest()
    {
        $request['get'] = $_GET;
        $request['post'] = $_POST;
        $request['cookie'] = $_COOKIE;
        $request['server'] = $_SERVER;
        $request['file'] = $_FILES;

        return $request;
    }

    public function input($name, $default = '')
    {
        if ($this->isMethod('get')) {
            $contents = $this->request['get'];
        } else {
            $contents = $this->request['post'];
        }

        return isset($contents[$name]) ? $contents[$name] : $default;
    }

    public function all()
    {
        if ($this->isJson()) {
            return $this->getJson();
        }

        if ($this->isMethod('get')) {
            return $this->request['get'];
        } else {
            return $this->request['post'];
        }
    }

    /**
     * @param $method
     * @return bool
     */
    public function isMethod($method)
    {
        return $this->request['server']['REQUEST_METHOD'] == strtoupper($method) ? true : false;
    }

    /**
     * 获取HTTP请求方法
     * @return string
     */
    public function getMethod()
    {
        return strtolower($this->request['server']['REQUEST_METHOD']);
    }

    public function getJson()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function isJson()
    {
        $json_content_types = ['application/json'];
        if (in_array($this->request['server']['HTTP_CONTENT_TYPE'], $json_content_types)) {
            return true;
        }

        return false;
    }

    public function getUrl()
    {
        $request_url = $this->request['server']['REQUEST_URI'];
        $route_url = strpos($request_url, '?') ? substr($request_url, 0, strpos($request_url, '?')) : $request_url;
        $this->request['route_url'] = $route_url;

        return $route_url;
    }

    public function getQuery()
    {

    }

    public function getRoutePath()
    {

    }
}