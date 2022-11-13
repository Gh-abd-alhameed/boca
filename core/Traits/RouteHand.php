<?php

namespace boca\mvc\core\Traits;

trait RouteHand

{
    public function check($url, $path)
    {

        return count($url) == count($path);
    }

    public function RequestCheck($method)
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) !== $method) :

            return true;

        endif;
        
    }
    public function addSlashes($path){
        return $path . "/";
    }
    public function checkSlashes($path){
        return preg_match("/\/$/", $path);
    }
}
