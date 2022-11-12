<?php

namespace boca\mvc\core\settings;

use boca\mvc\core\settings\RequestHandler;

class Request extends RequestHandler
{
    public static function uri()
    {
        return self::$uri;
    }

    public static function host()
    {
        return self::$host;
    }

    public static function http()
    {
        return self::$http;
    }

    public static function query()
    {
        return self::$query;
    }

    public static function param()
    {
        return self::$param;
    }

    public static function input()
    {
        return self::$input;
    }

    public static function headers()
    {
        return self::$headers;
    }

    public static function json()
    {
        return self::$json;
    }

    public static function body()
    {
        return self::$body;
    }
}
