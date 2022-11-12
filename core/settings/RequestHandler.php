<?php

namespace boca\core\settings;

abstract class RequestHandler
{
    public  $headers;
    public   $json;
    public   $body;
    public   $query;
    public   $param;
    public   $input;
    public function __construct()
    {
        $this->param = [];
        $this->query = $_GET;
        $this->body = $_POST;
        $this->input = $_REQUEST;
        $this->json = file_get_contents("php://input");
        $this->headers = apache_request_headers();
    }
    abstract  function query();

    abstract  function param();

    abstract  function input();

    abstract  function headers();

    abstract  function json();

    abstract  function body();
}
