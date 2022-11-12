<?php

namespace boca\core\settings;

class Locale
{
    protected static $locale;
    public function __construct()
    {
        if (empty($this->locale)) {
            $this->locale = app("locale");
        }
        if (!isset($_SESSION['locale'])) {
            $_SESSION['locale'] =  $this->locale;
        }
    }
    public static function get()
    {
        return self::$locale;
    }
    public function set(string $locale)
    {
        if (!is_string($locale)) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: Locale Most be String");
        }
        if (!in_array($locale, app("available_locales"))) {
            die(__FILE__ . "|Line:" . __LINE__ . "|Message: Locale Not Found");
        }
        $this->locale = $locale;
        if ($_SESSION["locale"] != $locale) {
            $_SESSION["locale"] = $this->locale;
        }
    }
}
