<?php


namespace boca\core\settings;

use boca\core\settings\Route;


abstract class App
{
    public static array $app = [];
    public $Route;
    public array $initRotePath;

    public function __construct()
    {
    }

    public function setapp(array $app = [])
    {
        self::$app = $app;
    }

//    abstract public function providers();

    public function init()
    {

        require __DIR__ . "/../../init.php";
        $this->Route = new Route;
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