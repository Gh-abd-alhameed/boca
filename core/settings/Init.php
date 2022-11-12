<?php


namespace boca\mvc\core\settings;

use boca\mvc\core\settings\Route;


abstract class Init
{
    public static array $app = [];
    public $Route;
    public array $initRotePath;


    public function setapp(array $app = [])
    {
        self::$app = $app;
    }


    public function init()
    {
        $this->Route = new Route;
        $this->routeFile();
    }

    public function routeFile()
    {
        $path = [];
        foreach ($this->initRotePath as $key => $value) {

            if (!key_exists("path", $value)) {

                if (self::$app["debug"]) {
                    die(__FILE__ . "  |Line:" . __LINE__ . "  |Message: $key Route Key Is Not Exists ");
                }
            }
            if (!file_exists($value["path"])) {
                if (self::$app["debug"]) {
                    die(__FILE__ . "  |Line:" . __LINE__ . "  |Message: $key Route Path Is Not Exists ");
                }
            }

            $path[] = $value["path"];
        }
        foreach ($path as $value) {
            require $value;
        }
    }

}