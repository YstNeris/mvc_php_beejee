<?php

namespace app\core;

class Router
{

	protected $routes = [];
	protected $params = [];

	public function __construct()
	{
		$arr = require_once __DIR__ . '/../config/routes.php';
		foreach ($arr as $k => $v) $this->add($k, $v);
		$this->run();
	}

	public function add($route, $params)
	{
		$route = '#^' . $route . '$#';
		$params = explode('@', $params);
		$params = [
			'controller' => $params[0],
			'action' => $params[1],
		];
		$this->routes[$route] = $params;
	}

	public function match()
	{
		$url = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $matches)) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	public function run()
	{
		if (!$this->match()) View::errorCode(404);

		$controller = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
		$action = $this->params['action'] . 'Action';

		if (!class_exists($controller)) View::errorCode(404);

		$ClassController = new $controller($this->params);

		if (!method_exists($ClassController, $action)) View::errorCode(404);

		$ClassController->$action($_POST);
	}
}
