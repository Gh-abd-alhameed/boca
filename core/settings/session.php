<?php

namespace boca\mvc\core\settings;


class session
{

    public function set(array $keys)
    {
        if (!is_array($keys)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session Set Key Most be Array");
            }
        }
        if (!(count($keys) > 0)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session Set Key Most be Not Empty");
            }
        }
        foreach ($keys as $key => $value) {
            $_SESSION[$key] = $value;
        }
        return;
    }
    public function get(string $key)
    {
        if (!is_string($key)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session Get Key Most be String");
            }
        }
        if (empty($key)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session Get Key Most be Not Empty");
            }
        }
        return  $_SESSION[$key];
    }
    public function has(string $session_key)
    {
        if (!is_string($session_key)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session has Key Most be String");
            }
        }
        if (empty($session_key)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session has Key Most be Not Empty");
            }
        }
        if (array_key_exists($session_key, $_SESSION)) {
            return true;
        }
        return false;
    }

    public function Flash(string $session_key)
    {
        if (!is_string($session_key)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session Flash Key Most be String");
            }
        }
        if (empty($session_key)) {
            if (debug) {
                die(__FILE__ . "|Line:" . __LINE__ . "|Message: Session Flash Key Most be Not Empty");
            }
        }
        echo $_SESSION[$session_key];

        unset($_SESSION[$session_key]);
    }
}
