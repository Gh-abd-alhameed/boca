<?php
use boca\core\settings\App;
use boca\core\settings\Locale;
function strip_all_tags($string, $remove_breaks = false)
{
    $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
    $string = strip_tags($string);
    if ($remove_breaks) {

        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
    }

    return trim($string);
}

function _token_app_meta()
{
    if (!isset($_SESSION['_token_app'])) {
        return "";
    }

    echo '<meta  name="_token" content="' .  $_SESSION['_token_app'] . '">';
}

function url_site($path = "")
{
    if ($_SESSION["locale"] == "ar") {
        return   URL_ROOT . "ar" . $path;
    }
    return   URL_ROOT . $path;
}
function get_locale()
{
    if (isset($_SESSION['lang']) && $_SESSION['lang'] == "ar") {
        return $_SESSION['lang'];
    }
    return "en";
}
function app(string $key = "")
{
    if (!is_string($key)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: app key Most be string");
        }
    }
    $app = App::$app;
    $key = empty($key) ?  $app  : $app[$key];
    return $key;
}



function _trans(string $Keyword, string $default = "")
{

    if (!is_string($Keyword)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: _trans \$Keyword Most be String");
        }
    }
    if (!strpos($Keyword, ".")) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: _trans \$Keyword error handle");
        }
    }
    $Keyword = explode(".", $Keyword);
    $root = LANGUAGE . "/" . Locale::get();
    $key_trans = end($Keyword);
    if (empty($key_trans)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: _trans Key array empty");
        }
    }
    unset($Keyword[count($Keyword) - 1]);
    if (!file_exists($root . "/" . join("/", $Keyword)  . ".php")) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: _trans file Not Found");
        }
    }

    $traans_file = require $root . "/" . join("/", $Keyword)  . ".php";
    if (!array_key_exists($key_trans, $traans_file)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: _trans Key Not Fount ");
        }
    }
    return  $traans_file[$key_trans];
}


function component(string $name, array $data = [])
{
    $name = str_replace(".php", "", $name);
    if (empty($name)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: component most be not empty");
        }
    }
    if (!file_exists(components . "/" . $name . ".php")) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: component Not Found");
        }
    }
    if (count($data) > 0) {
        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
    }
    require components . "/" . $name . ".php";
}
function view(string $view, array $data = [])
{
    if (!is_string($view)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: (view) \$view Most be String");
        }
    }
    $view = explode(".", $view);
    $view =  views . "/" .  join("/", $view) . ".php";
    if (!file_exists($view)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: (view) file Not Found");
        }
    }
    if (count($data) > 0) {
        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
    }

    $view = require  $view;
    return;
}

function request()
{
    return new \lightphp\core\settings\Request();
}

function route($name, $data = [])
{
    global $Route;
    $routeUrl = $Route::nameUrl($name);
    $array_route_url = explode("/", $routeUrl);
    foreach ($array_route_url  as $key => $value) {
        if (strpos($value, "}")) {
            $value = str_replace(array("{", "}"), "",  $value);
            if (!key_exists($value, $data)) {
                if (debug) {
                    die(__FILE__ . "|Line:" . __LINE__ . "|Message: (route) Key Not Found");
                }
            }
            $array_route_url[$key] = str_replace(key($data), $data[$value], $value);
            next($data);
            continue;
        }
    }

    return implode("/", $array_route_url);
}


function assets($path)
{

    if (!is_string($path)) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: (assets) \$path most be string");
        }
    }
    if (!file_exists(ROOT . "/assets$path")) {
        if (debug) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: (assets) " . ROOT  . "/assets$path" . " File Not Found");
        }
    }
    echo URL_ROOT . "/assets$path";
}
