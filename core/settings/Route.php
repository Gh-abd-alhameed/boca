<?php

namespace boca\mvc\core\settings;


use boca\mvc\core\settings\RouteInit;
use boca\mvc\core\Traits\RouteHand;

class Route
{
    use RouteHand;

    public static $app;

    public function __construct()
    {
        self::$app = new RouteInit;
    }

    public static function get(string $routeName, $callback)
    {
        if (RouteHand::RequestCheck("get")) return self::$app;
        return self::$app->routeHundel($routeName, $callback);
    }

    public static function post(string $routeName, $callback)
    {
        if (RouteHand::RequestCheck("post")) return self::$app;
        return self::$app->routeHundel($routeName, $callback);
    }

    public static function put(string $routeName, $callback)
    {
        if (RouteHand::RequestCheck("put")) return self::$app;
        return self::$app->routeHundel($routeName, $callback);
    }

    public static function delete(string $routeName, $callback)
    {
        if (RouteHand::RequestCheck("delete")) return self::$app;
        return self::$app->routeHundel($routeName, $callback);
    }

    public static function any(string $routeName, $callback)
    {
        self::$app->routeHundel($routeName, $callback);
        return self::$app;
    }

    public static function nameUrl($nameUrl)
    {
        return self::$app->Route_Name[$nameUrl];
    }

}
