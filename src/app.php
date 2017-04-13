<?php

namespace Neer;

use Neer\Foundation\Http\Request;
use Neer\Foundation\Http\ResponseInterface;
use Neer\Foundation\Http\Route;

class App
{
    private static $request = array();

    // 处理请求数据
    public function capture()
    {
        $request = new Request();
        return $request;
    }

    // 转发路由，获取response
    public function handle(Request $request)
    {
        $route_url = $request->getUrl();
        $method = $request->getMethod();

        try {
            $response = $this->dispatch($method, $route_url);
            if (! $response instanceof ResponseInterface) {
                throw new \Exception("必须返回Response类型");
            }
            return $response;
        } catch (\Exception $e) {
            echo $e->getMessage();
            die(1);
        }

    }

    public function dispatch($method, $route_url)
    {

        require __DIR__.'/web/routes.php';
        $response = Route::resolve($method, $route_url);

        return $response;
    }
}