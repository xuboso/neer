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
        static::getUrlParameters($method, $url);
        var_dump(self::$routes[$method]); exit;
        $namespace_path = "\\Neer\\Web\\Controllers\\";
        if (!isset(self::$routes[$method][$url])) {
            throw new \Exception("路由不存在", 404);
        }

        $map = self::$routes[$method][$url];
        $map_arr = explode('@', $map);

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

        return $controller->$action();

    }

    private static function getUrlParameters($method, $url)
    {
        $matched = false;
        $routes = self::$routes[$method];
        foreach ($routes as $pattern => $route) {
            if (preg_match_all('/{(.*?)}/', $pattern, $matches)) {
                $matched = true;
            }
        }

        if (!$matched) {
            throw new \Exception("路由不存在".$url, 404);
        }

        var_dump($matches, $routes, $url); exit;
    }
}