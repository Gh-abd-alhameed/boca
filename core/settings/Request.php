<?php

namespace boca\core\settings;

use boca\core\settings\RequestHandler;

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
