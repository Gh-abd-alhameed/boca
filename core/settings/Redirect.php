<?php

namespace boca\mvc\core\settings;

class Redirect
{
    public function __construct(string $from = "", string $to = "")
    {
        if (is_string($from)) {
            if (!empty($from)) {
                $pattern = "/" . str_replace("/", "\/", $from) . "$/";
                if (preg_match($pattern, $_SERVER["REQUEST_URI"])) {
                    header("Location: " . $to);
                }
            }
        }
        return $this;
    }

    public function back()
    {

        return $this;
    }

    public function with(array $Key = [])
    {
        return $this;
    }

    public function url(string $url = "")
    {
        header("Location: $url");
        return $this;
    }

    public function status(int $code = 200, string $message = "")
    {
        header("HTTP/2.0 $code $message");
        return $this;
    }
}
