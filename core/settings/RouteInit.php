<?php

namespace boca\mvc\core\settings;

use boca\mvc\core\Traits\RouteHand;
use boca\mvc\core\settings\Response;
use boca\mvc\core\settings\Request;
class RouteInit
{
	use RouteHand;

	private bool $handled = false;

	public $storege;
	public $param = [];
	public $Route_Name = [];
	public $urlRoute;

	function __construct()
	{
		$uri = parse_url(strip_all_tags($_SERVER["REQUEST_URI"]))["path"];
		if (Init::$app["url"] != "/") {
			$uri = str_replace(Init::$app["url"], "", $uri);
		}
		foreach (Init::$app["static_file"] as $key => $value) {
			$prefix = str_replace("/", "\/", $value["prefix"]);
			if (preg_match("/^$prefix(.*)\.(" . join("|", $value["extension"]) . ")$/", $uri)) {
				if (file_exists($_SERVER["DOCUMENT_ROOT"] . Init::$app["url"] . preg_replace("/\/$/", "", $uri))) {
					$this->handled = true;
					echo file_get_contents($_SERVER["DOCUMENT_ROOT"] . Init::$app["url"] . $uri);
					return "";
				}
			}
		}
	}

	public function routeHundel(string $routeName, $callback)

	{
		$this->urlRoute = $routeName;
		$uri = parse_url(strip_all_tags($_SERVER['REQUEST_URI']))["path"];

		if (Init::$app["url"] != "/") {
			$uri = str_replace(Init::$app["url"], "", $uri);
		}

		$url = $uri;

		if (!RouteHand::checkSlashes($url)) {

			$url = RouteHand::addSlashes($url);
		} else {
			$url = $url;
		}

		if (!RouteHand::checkSlashes($routeName)) {
			$routeName = RouteHand::addSlashes($routeName);
		}

		$url = explode("/", $url);

		$routeName = explode("/", $routeName);

		if (RouteHand::check($url, $routeName)) {

			foreach ($routeName as $key => $value) {

				if (strpos($value, "}")) {
					if (empty($url[$key])) {
						break;
					}
					$routeName[$key] = $url[$key];

					$key_param = str_replace(array("{", "}"), "", $value);

					$this->param[$key_param] = $url[$key];

					continue;
				}

				if ($value != $url[$key]) {

					return $this;
				}
			}
		};

		$routeName = join("/", $routeName);

		$url = join("/", $url);

		if ($url == $routeName) :

			if (is_string($callback)) :

				$this->string_handler($callback);
				return $this;

			elseif (is_array($callback)) :

				$this->handel_array_class($callback);
				return $this;
			else :

				$this->handled = true;

				$callback(...array_values($this->param));

				return $this;
			endif;

		endif;

		return $this;
	}


	public function handel_array_class($callback)
	{
		${$callback[1]} = new $callback[0];

		$function = $callback[1];

		$this->handled = true;

		${$callback[1]}->$function(...array_values($this->param));
		return;
	}

	public function string_handler($string)

	{
		if (strpos($string, '@')) {

			$this->handled = true;

			return $this->class_handeler($string);
		} else {

			$this->handled = true;

			return $string;
		}
	}

	public function class_handeler($callback)

	{
		$exp = explode('@', $callback);

		$className = $exp[0];

		$fanction = $exp[1];

		$this->handled = true;

//        require __DIR__ . "/../../../../../app/http" . $className . '.php';

		$class = new $className;

		$class->$fanction(...array_values($this->param));
		return;
	}

	function name($routeName)
	{
		$this->Route_Name[$routeName] = $this->urlRoute;
		return $this;
	}

	public function maddleware($middleware, $callback = null)
	{
		if (is_string($middleware)) {
			$this->maddlewareIsString($middleware, $callback);
		}
		if (is_array($middleware)) {
			$this->maddlewareIsArray($middleware, $callback);
		}
		return $this;
	}

	public function maddlewareIsArray($middleware, $callback)
	{
		$kernal = new \app\http\Kernal;
		foreach ($middleware as $key => $value) {
			$middleware = $kernal->boot()["middleware"][$value];
			$check = new $middleware;
			$check->Check(Request() , Response());
			if ($callback != null) {
				$callback();
			}

		}
	}

	public function maddlewareIsString($middleware, $callback)
	{
		$kernal = new \app\http\Kernal;
		$middleware = $kernal->boot()["middleware"][$middleware];
		$check = new $middleware;
		$check->Check(Request() , Response() );
		if ($callback != null) {
			$callback();
		}
	}

	function __destruct()
	{
		if (!$this->handled) {
			return require __DIR__ . '/../../pages/404.php';
		}
	}
}
