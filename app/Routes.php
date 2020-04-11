<?php


namespace App;


class Routes
{
    static $route_tables;

    static function Request($method,$path,$controller)
    {
        $method = strtoupper($method);

        self::$route_tables[$path][$method] = $controller;
    }

    static function Get($path,$controller)
    {
        self::$route_tables[$path]["GET"] = $controller;
    }

    static function Post($path,$controller)
    {
        self::$route_tables[$path]["POST"] = $controller;
    }

    static function Explore()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri    = $_SERVER["REQUEST_URI"];
        $ruri   = null;

        preg_match_all("/(\/)(.*?)[a-zA-Z0-9]+/",$uri,$ruri);

        $controller = (self::$route_tables[$ruri[0][0]][$method]);

        if($controller == null)
        {
            $controller = (self::$route_tables[$ruri[0][0].$ruri[0][1]][$method]);
        }

        (!is_array($controller)) ? header("Location: /") : true;

        $path = key($controller). "::" . $controller[key($controller)];

        call_user_func('\MyControllers\\'.$path ,$ruri[0],$_REQUEST);

    }
}