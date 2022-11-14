<?php

namespace boca\mvc\core\Traits;

trait RouteHand

{
	public static function check($url, $path)
	{

		return count($url) == count($path);
	}

	public static function RequestCheck($method)
	{
		if (strtolower($_SERVER['REQUEST_METHOD']) !== $method) :

			return true;

		endif;

	}

	public static function addSlashes($path)
	{
		return $path . "/";
	}

	public static function checkSlashes($path)
	{
		return preg_match("/\/$/", $path);
	}
}
