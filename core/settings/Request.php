<?php

namespace boca\mvc\core\settings;

use boca\mvc\core\settings\RequestHandler;

class Request extends RequestHandler
{
    public   function query()
    {
        return $this->query;
    }
    public   function param()
    {
        return $this->param;
    }
    public   function input()
    {
        return $this->input;
    }
    public   function headers()
    {
        return  $this->headers;
    }
    public   function json()
    {
        return $this->json;
    }
    public   function body()
    {
        return $this->body;
    }
}
