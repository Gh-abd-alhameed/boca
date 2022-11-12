<?php

namespace boca\mvc\core\settings;

use boca\mvc\core\settings\Request;

class Locale
{
    protected static $locale;

    public function __construct()
    {
    }

    public static function get()
    {
        return self::$locale;
    }

    public static function set(string $locale)
    {
        if (!is_string($locale)) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: Locale Most be String");
        }
        if (!key_exists($locale, Init::$app["available_locales"])) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: Locale Not Found");
        }
        self::$locale = $locale;
    }

    public static function Init()
    {
        $url = Request::http() . Request::host() . Request::uri();
        $pattern = "/^(http(s)?:\/\/)?(\w+.)?(\w+[\-]?\w+)(-\w+)?\.?\w+\/?((\w+)\/?)/";
        $check = preg_match($pattern, $url, $mache);
        $defult = "en";
        $locale = Init::$app["available_locales"];
        if ($check) {
            if (key_exists(end($mache), $locale)) {
                self::$locale = end($mache);
            } else {
                self::$locale = app("locale");
            }
        }
    }
}
