<?php

namespace Neer\Foundation\Http;

class Route
{
    public static  $routes;

    public static function get($path, $controller)
    {
        self::$routes['get'][$path] = $controller;
    }

    public static function post($path, $controller)
    {
        self::$routes['post'][$path] = $controller;
    }

    public static function put($path, $controller)
    {
        self::$routes['put'][$path] = $controller;
    }

    public static function delete($path, $controller)
    {
        self::$routes['delete'][$path] = $controller;
    }

    public static function resolve($method, $url)
    {
        $route_info = static::getUrlParameters($method, $url);
        $map = $route_info['map'];
        $map_arr = explode('@', $map);

        $namespace_path = "\\Neer\\Web\\Controllers\\";
        if (!class_exists($namespace_path.$map_arr[0], true)) {
            throw new \Exception($map_arr[0]."不存在", 404);
        }

        if (!method_exists($namespace_path.$map_arr[0], $map_arr[1]."Action")) {
            throw new \Exception($map_arr[1]."Action不存在", 404);
        }

        $reflection = new \ReflectionClass($namespace_path.$map_arr[0]);
        $controller_name = $reflection->getName();
        $controller = new $controller_name();

        $action = $map_arr[1]."Action";
        if (!is_callable([$controller, $action])) {
            throw new \Exception($action."不可调用", 800);
        }

//        var_dump($route_info['parameters']); exit;
        extract($route_info['parameters']);

        return $controller->$action($name);

    }

    private static function getUrlParameters($method, $url)
    {
        $matched = false;
        $routes = self::$routes[$method];
        $route_info = [];
        foreach ($routes as $pattern => $route) {
            $pattern_constant = explode('/', $pattern);
            if (preg_match("~^[/]?(?|$pattern_constant[1]/([^/]+))$~", $url, $matches)) {
                $matched = true;
                $params = $pattern_constant[2];
                $params = substr($params, 1, strlen($params) - 2);
                $temp[$params] = $matches[1];
                $route_info['parameters'][$params] = $matches[1];
                $route_info['map'] = self::$routes[$method][$pattern];
                extract($temp);
                break;
            }
        }

        if (!$matched) {
            throw new \Exception("路由不存在".$url, 404);
        }

        return $route_info;
    }
}