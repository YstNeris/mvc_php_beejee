<?php

namespace app\core;

class View
{

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'] . '/' . $route['action'];
	}

	public function render($title = "Заголовок страницы", $data = [])
	{
		$viewPath = __DIR__ . '/../views/' . $this->path . '.php';
		$layoutPath = __DIR__ . '/../views/layouts/' . $this->layout . '.php';

		if (file_exists($viewPath) && file_exists($layoutPath)) {
			if (is_array($data)) extract($data);
			ob_start();
			require_once $viewPath;
			$content = ob_get_clean();
			require_once $layoutPath;
		} else $this::errorCode(404);
	}

	public function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}

	public static function errorCode($code)
	{
		http_response_code($code);
		$path = __DIR__ . '/../views/errors/index.php';

		if (file_exists($path)) {
			require_once $path;
			exit;
		}
	}
}
