<?php

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{
	public function indexAction()
	{
		$this->model->addAdmin();
		$limit = 3;
		$count = (int) $this->model->getTaskCount();
		$maxPage = (int) ceil($count / $limit);
		if (@$_GET['page'] < 1) $_GET['page'] = 1;
		else if (@$_GET['page'] > $maxPage) $_GET['page'] = $maxPage;
		else $_GET['page'] = (int) $_GET['page'];
		if (@$_GET['sort'] != "id" && @$_GET['sort'] != "email" && @$_GET['sort'] != "name" && @$_GET['sort'] != "done") $_GET['sort'] = "id";
		if (@$_GET['order'] != "DESC") $_GET['order'] = "ASC";
		$arr = [
			'id' => 'ID',
			'email' => 'Email',
			'name' => 'Имя',
			'done' => 'Статус',
		];
		$result = $this->model->getTasks($_GET['page'], $limit, $_GET['order'], $_GET['sort']);
		$data = is_array($result) ? $result : [];
		$this->view->render('Главная', [
			'tasks' => $data,
			'taskCount' => $count,
			'maxPage' => $maxPage,
			'sortArr' => $arr
		]);
	}
}
