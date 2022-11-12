<?php

$http = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";

$site_url =  $_SERVER["HTTP_HOST"];

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

define('views', ROOT . '/resource/views');

define('LANGUAGE', ROOT  .  "/resource/language");

define('components', ROOT . '/resource/views/components');

define('controller', ROOT . '/app/http/controller');

define('URL_ROOT', $http . $site_url);

