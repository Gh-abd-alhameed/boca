<?php

namespace boca\mvc\core\settings;

abstract class RequestHandler
{
    public static $headers;
    public static $json;
    public static $body;
    public static $query;
    public static $param;
    public static $input;
    public static $uri;
    public static $http;
    public static $host;

    public function __construct()
    {

    }

    public static function Init()
    {
        self::$body = $_POST;
        self::$uri = $_SERVER["REQUEST_URI"];
        self::$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https://" : "http://";
        self::$host = $_SERVER["HTTP_HOST"];
        self::$query = $_GET;
        self::$param = [];
        self::$json = file_get_contents("php://input");
        self::$headers = apache_request_headers();
    }

    abstract static function query();

    abstract static  function host();

    abstract static  function http();

    abstract static  function uri();

    abstract static  function param();

    abstract static  function input();

    abstract static  function headers();

    abstract static  function json();

    abstract static  function body();
}
