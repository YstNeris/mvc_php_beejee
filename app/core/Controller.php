<?php

namespace app\core;

abstract class Controller
{

	public $route;
	public $view;
	public $model;
	public $acl;

	public function __construct($route)
	{
		$this->route = $route;
		if (!$this->checkAcl()) View::errorCode(401);
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
	}

	public function loadModel($name)
	{
		$model = 'app\models\\' . ucfirst($name);
		if (class_exists($model)) return new $model;
	}

	public function checkAcl()
	{
		$path = __DIR__ . '/../acl/' . $this->route['controller'] . '.php';
		if (!file_exists($path)) View::errorCode(404);
		$this->acl = require_once $path;
		if ($this->isAcl('all')) return true;
		if (isset($_SESSION['user']['admin']) && $this->isAcl('admin')) return true;
		return false;
	}

	public function isAcl($key)
	{
		return in_array($this->route['action'], $this->acl[$key]);
	}
}
