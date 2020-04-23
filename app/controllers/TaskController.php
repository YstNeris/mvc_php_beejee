<?php

namespace app\controllers;

use app\core\Controller;

class TaskController extends Controller
{

	public function addAction($data = [])
	{
		if (!@$data['name'] || !@$data['email'] || !@$data['content']) $this->view->redirect('/');
		$res = $this->model->add($data);
		$url = '/?success=add';
		$saved = ['page', 'sort', 'order'];
		foreach ($saved as $s) if ($data[$s]) $url .= "&$s=$data[$s]";
		$this->view->redirect($url);
	}

	public function updateAction($data = [])
	{
		if (!@$data['id'] || !@$data['content'] || !@$data['oldContent']) $this->view->redirect('/');
		$task = $this->model->update($data);
		$url = '/?success=update';
		$saved = ['page', 'sort', 'order'];
		foreach ($saved as $s) if ($data[$s]) $url .= "&$s=$data[$s]";
		$this->view->redirect($url);
	}

	public function editAction()
	{
		$task = $this->model->get((int) $_GET['task']);
		if (!$task) $this->view->errorCode(404);
		$this->view->render('Изменение задачи ' . $task['id'], [
			'task' => $task
		]);
	}
}
